<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GeminiController extends Controller
{

    public function generateAnswer(Request $request)
    {

        $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        $apiKey = config('constants.gemini_api_key');

        $userQuestion = $request->input('question');
        
        $client = new Client([
            'base_uri' => 'https://generativelanguage.googleapis.com/v1/'
        ]);

        try {
            
            $response = $client->post("models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $userQuestion
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            $generatedText = $body['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
            Log::info('Plain Text: ' . $generatedText);
            $generatedHtml = $this->convertMarkdownToHtml($generatedText);

            return response()->json([
                'status' => 'success',
                'answer' => $generatedHtml,
            ]);

        } catch (\Exception $e) {

            Log::error('Gemini API Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Sorry, we could not fetch an answer. Please try again later.'
            ], 500);
        }
    }

    private function convertMarkdownToHtml($markdownText)
    {
        $lines = explode("\n", $markdownText);
        $result = [];
        $stack = []; // ओपन टॅग्स ट्रॅक करण्यासाठी (level => tag)

        foreach ($lines as $line) {
            $trimmed = trim($line);
            $leadingSpaces = strlen($line) - strlen(ltrim($line, ' '));
            $level = (int) ($leadingSpaces / 4); // 4 spaces = 1 level

            // रिक्त ओळ वगळा (margin/padding हाताळेल)
            if (empty($trimmed)) {
                continue;
            }

            // हेडिंग्स
            if (preg_match('/^#{1,6}\s+(.+)/', $trimmed, $matches)) {
                $this->closeOpenTags($result, $stack, $level);
                $hLevel = strlen($matches[1]);
                $text = $this->formatInline(trim($matches[2] ?? $matches[1]));
                $result[] = '<h' . $hLevel . '>' . $text . '</h' . $hLevel . '>';
                continue;
            }

            // लिस्ट आयटम
            if (preg_match('/^(\s*)([-*]|\d+\.)\s+(.+)/', $line, $matches)) {
                $indent = strlen($matches[1]);
                $marker = $matches[2];
                $text = trim($matches[3]);
                $listType = is_numeric($marker) ? 'ol' : 'ul';
                $newLevel = (int) ($indent / 4);

                // जास्त लेव्हल बंद करा
                $this->closeOpenTags($result, $stack, $newLevel);

                // नवीन लेव्हल ओपन करा
                if (isset($stack[$newLevel]) && $stack[$newLevel] !== $listType) {
                    $result[] = '</li></' . $stack[$newLevel] . '>';
                    unset($stack[$newLevel]);
                }

                if (!isset($stack[$newLevel])) {
                    if ($newLevel > 0) {
                        $result[] = '<' . $listType . '><li>';
                        $stack[$newLevel] = $listType;
                    } else {
                        $result[] = '<' . $listType . '><li>';
                        $stack[$newLevel] = $listType;
                    }
                } else {
                    $result[] = '</li><li>';
                }

                $result[] = $this->formatInline($text) . '</li>';
                continue;
            }

            $this->closeOpenTags($result, $stack, 0);
            $result[] = '<p>' . $this->formatInline($trimmed) . '</p>';
        }

        $this->closeOpenTags($result, $stack, 0);

        return implode("\n", $result);
    }

    private function closeOpenTags(&$result, &$stack, $currentLevel)
    {
        krsort($stack);
        foreach ($stack as $lvl => $tag) {
            if ($lvl > $currentLevel) {
                $result[] = '</li></' . $tag . '>';
                unset($stack[$lvl]);
            }
        }
        ksort($stack);
    }

    private function formatInline($text)
    {

        $text = preg_replace('/\*\*(.+?)\*\*/', '<b>$1</b>', $text);
        $text = preg_replace('/_(.+?)_/', '<i>$1</i>', $text);
        $text = preg_replace('/\*(.+?)\*/', '<i>$1</i>', $text);
        return $text;
    }
}