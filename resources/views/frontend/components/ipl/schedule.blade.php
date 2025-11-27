@php
    //     $groupedCompleteMatches = [];
    //     foreach ($complete_matches as $complete_match) {
    //         $completeMatchDate = \Carbon\Carbon::parse($complete_match['datetime_gmt'])->toDateString();
    //         $groupedCompleteMatches[$completeMatchDate][] = $complete_match;
    //     }

    //     echo "<pre>";
    // print_r($complete_matches);
    // exit;
@endphp
<!-- resources/views/matches-schedule.blade.php -->
<div class="matches-container">
    <!-- Tabs -->
    <div class="tabs">
        <div class="tab" data-tab="live">LIVE</div>
        <div class="tab active" data-tab="upcoming">UPCOMING</div>
        <div class="tab" data-tab="results">RESULT</div>
    </div>
    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Live Tab -->
        <div class="tab-pane" id="live">
            @if ($live_match)
                <div class="matches-grid">
                    <div class="match-card-wrapper">
                        <a href="#" class="match-card-link">
                            <div class="match-card" style="padding-top: 10px;">
                                <div class="match-header">
                                    <span>Indian Premier League, 2025, {{ ltrim(trim(strrchr($live_match->name, ',')), ',') }}</span>
                                    <div class="status">
                                        <span class="live">LIVE</span>
                                        <img src="{{asset('/public/assets/front/images/ipl/hotspot.gif')}}" style="max-width: 30px;">
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="match-details">
                                    @php
                                        $team1Score = $live_match->scores->firstWhere('inning', $live_match->team1 . ' Inning 1');
                                        $team2Score = $live_match->scores->firstWhere('inning', $live_match->team2 . ' Inning 1');
                                        $scoreCount = $live_match->scores->count();
                                    @endphp

                                    @if ($scoreCount === 0)
                                        <div class="team-row">
                                            <div class="team-info">
                                                <img src="{{ !empty($live_match->firstteam->img) ? $live_match->firstteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $live_match->team1 }}" class="team-logo">
                                                <span class="team-name">{{ $live_match->team1 }}</span>
                                            </div>
                                            <span class="match-time">Yet to bat</span>
                                        </div>
                                        <div class="team-row">
                                            <div class="team-info">
                                                <img src="{{ !empty($live_match->secondteam->img) ? $live_match->secondteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $live_match->team2 }}" class="team-logo">
                                                <span class="team-name">{{ $live_match->team2 }}</span>
                                            </div>
                                            <span class="match-time">Yet to bat</span>
                                        </div>
                                    @elseif ($scoreCount === 1)
                                        @if (isset($team1Score) && $team1Score->inning == ($live_match->team1 . ' Inning 1'))
                                            <div class="team-row">
                                                <div class="team-info">
                                                    <img src="{{ !empty($live_match->firstteam->img) ? $live_match->firstteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $live_match->team1 }}" class="team-logo">
                                                    <span class="team-name">{{ $live_match->team1 }}</span>
                                                </div>
                                                <span class="match-time">{{ $team1Score ? "{$team1Score->runs}/{$team1Score->wickets} ({$team1Score->overs})" : "Yet to bat" }}</span>
                                            </div>
                                            <div class="team-row">
                                                <div class="team-info">
                                                    <img src="{{ !empty($live_match->secondteam->img) ? $live_match->secondteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $live_match->team2 }}" class="team-logo">
                                                    <span class="team-name">{{ $live_match->team2 }}</span>
                                                </div>
                                                <span class="match-time">{{ $team2Score ? "{$team2Score->runs}/{$team2Score->wickets} ({$team2Score->overs})" : "Yet to bat" }}</span>
                                            </div>
                                        @elseif (isset($team2Score) && $team2Score->inning == ($live_match->team2 . ' Inning 1'))
                                            <div class="team-row">
                                                <div class="team-info">
                                                    <img src="{{ !empty($live_match->secondteam->img) ? $live_match->secondteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $live_match->team2 }}" class="team-logo">
                                                    <span class="team-name">{{ $live_match->team2 }}</span>
                                                </div>
                                                <span class="match-time">{{ $team2Score ? "{$team2Score->runs}/{$team2Score->wickets} ({$team2Score->overs})" : "Yet to bat" }}</span>
                                            </div>
                                            <div class="team-row">
                                                <div class="team-info">
                                                    <img src="{{ !empty($live_match->firstteam->img) ? $live_match->firstteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $live_match->team1 }}" class="team-logo">
                                                    <span class="team-name">{{ $live_match->team1 }}</span>
                                                </div>
                                                <span class="match-time">{{ $team1Score ? "{$team1Score->runs}/{$team1Score->wickets} ({$team1Score->overs})" : "Yet to bat" }}</span>
                                            </div>
                                        @endif
                                    @elseif ($scoreCount === 2)
                                        @foreach ($live_match->scores as $score)
                                            <div class="team-row">
                                                <div class="team-info">
                                                    <img src="{{ $score->inning == ($live_match->team1 . ' Inning 1') ? $live_match->firstteam->img : $live_match->secondteam->img }}" alt="{{ $score->inning }}" class="team-logo">
                                                    <span class="team-name">{{ str_replace(' Inning 1', '', $score->inning) }}</span>
                                                </div>
                                                <span class="match-time">
                                                    {{ $score->runs }}/{{ $score->wickets }} ({{ $score->overs }})
                                                </span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="match-footer">
                                    {{$live_match->status}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <p class="no-matches">No live match available.</p>
            @endif
        </div>

        <!-- Upcoming Tab -->
        <div class="tab-pane active" id="upcoming">
            @php
                $groupedMatches = [];
                foreach ($matches as $match) {
                    $matchDate = \Carbon\Carbon::parse($match['datetime_gmt'])->toDateString();
                    $groupedMatches[$matchDate][] = $match;
                }
            @endphp
            
            
            @foreach($groupedMatches as $date => $dateMatches)
                <div class="date-section">
                    <div class="date-header">
                        {{ date('Y-m-d', strtotime($date)) }}
                    </div>
                    
                    <div class="matches-grid">
                        @foreach($dateMatches as $match)
                            <div class="match-card-wrapper">
                                <a href="#" class="match-card-link">
                                    <div class="match-card">
                                        <div class="match-header">
                                            <span>Indian Premier League, 2025, {{ ltrim(trim(strrchr($match->name, ',')), ',') }}</span>
                                            <span class="status upcoming">UPCOMING</span>
                                            <!--<span class="status upcoming">Match Postponed</span>-->
                                        </div>
                                        <div class="divider"></div>
                                        <div class="match-details">
                                            <div class="team-row">
                                                <div class="team-info">
                                                    <img src="{{ !empty($match->firstteam->img) ? $match->firstteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $match->team1 }}" class="team-logo">
                                                    <span class="team-name">{{ $match->team1 }}</span>
                                                </div>
                                                <span class="match-time">
                                                    {{ Carbon\Carbon::parse($match->datetime_gmt)->format('D, d M') }}
                                                </span>
                                            </div>
                                            <div class="team-row">
                                                <div class="team-info">
                                                    <img src="{{ !empty($match->secondteam->img) ? $match->secondteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $match->team2 }}" class="team-logo">
                                                    <span class="team-name">{{ $match->team2 }}</span>
                                                </div>
                                                <span class="match-time">{{ Carbon\Carbon::parse($match->datetime_gmt)->addHours(5)->addMinutes(30)->format('h:i A') }}</span>
                                            </div>
                                        </div>
                                        <div class="match-footer">
                                            <!--Match Postponed-->
                                            Match Time {{ Carbon\Carbon::parse($match->datetime_gmt)->addHours(5)->addMinutes(30)->format('H:i') }} IST ({{ Carbon\Carbon::parse($match->datetime_gmt)->format('H:i') }} GMT)
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Results Tab -->
        <div class="tab-pane" id="results">
            @php
                $groupedCompleteMatches = [];
                foreach ($complete_matches as $complete_match) {
                    $completeMatchDate = \Carbon\Carbon::parse($complete_match['datetime_gmt'])->toDateString();
                    $groupedCompleteMatches[$completeMatchDate][] = $complete_match;
                }

            //     echo "<pre>";
            // print_r($complete_matches);
            // exit;
            @endphp
            @if ($groupedCompleteMatches)
                @foreach($groupedCompleteMatches as $date => $completeDateMatches)
                    <div class="date-section">
                        <div class="date-header">
                            {{ date('Y-m-d', strtotime($date)) }}
                        </div>
                        
                        <div class="matches-grid">
                            @foreach($completeDateMatches as $complete_match)
                                @php
                                    $team1Score = $complete_match->scores->firstWhere('inning', $complete_match->team1 . ' Inning 1');
                                    $team2Score = $complete_match->scores->firstWhere('inning', $complete_match->team2 . ' Inning 1');
                                @endphp

                                <div class="match-card-wrapper">
                                    <a href="#" class="match-card-link">
                                        <div class="match-card">
                                            <div class="match-header">
                                                <span>Indian Premier League, 2025, {{ ltrim(trim(strrchr($complete_match->name, ',')), ',') }}</span>
                                                <span class="status complete">COMPLETE</span>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="match-details">
                                                <div class="team-row">
                                                    <div class="team-info">
                                                        <img src="{{ !empty($complete_match->firstteam->img) ? $complete_match->firstteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $complete_match->team1 }}" class="team-logo">
                                                        <span class="team-name">{{ $complete_match->team1 ?? "NA" }}</span>
                                                    </div>
                                                    <span class="match-time">
                                                        {{ $team1Score->runs ?? 00 }}/{{ $team1Score->wickets ?? 0 }} ({{ $team1Score->overs ?? 0.00 }})
                                                    </span>
                                                </div>
                                                <div class="team-row">
                                                    <div class="team-info">
                                                        <img src="{{ !empty($complete_match->secondteam->img) ? $complete_match->secondteam->img : asset('public/assets/front/images/ipl/default-team-logo.png') }}" alt="{{ $complete_match->team2 }}" class="team-logo">
                                                        <span class="team-name">{{ $complete_match->team2 ?? "NA" }}</span>
                                                    </div>
                                                    <span class="match-time">{{ $team2Score->runs ?? 00 }}/{{ $team2Score->wickets ?? 0 }} ({{ $team2Score->overs ?? 0.00 }})</span>
                                                </div>
                                            </div>
                                            <div class="match-footer">
                                                {{ $complete_match->status}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <p class="no-matches">No results available.</p>
            @endif
        </div>
    </div>
</div>
