<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($webstories as $webstory)
        <url>
            <loc>{{ url('/web-story/'. $webstory->slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($webstory->content_updated_at)) }}</lastmod>
            @if(strtotime($webstory->content_updated_at) > strtotime('-30 days'))
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            @else
                <changefreq>monthly</changefreq>
                <priority>0.5</priority>
            @endif
        </url>
    @endforeach
</urlset>