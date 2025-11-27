<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($states as $state)
        <url>
            <loc>{{ url('/in/state/'. $state->state_slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($state->content_updated_at)) }}</lastmod>
            <changefreq>yearly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>