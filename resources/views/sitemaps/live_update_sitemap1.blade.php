<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($live_updates as $live_update)
        <url>
            <loc>{{ url('/'. $live_update->slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($live_update->content_updated_at)) }}</lastmod>
            @if(strtotime($live_update->content_updated_at) > strtotime('-1 days'))
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            @else
                <changefreq>yearly</changefreq>
                <priority>0.5</priority>
            @endif
        </url>
    @endforeach
</urlset>