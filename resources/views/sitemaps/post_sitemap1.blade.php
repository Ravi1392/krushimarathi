<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($blogs as $blog)
        <url>
            <loc>{{ url('/'. $blog->blog_slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($blog->content_updated_at)) }}</lastmod>
            @if(strtotime($blog->content_updated_at) > strtotime('-30 days'))
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            @else
                <changefreq>monthly</changefreq>
                <priority>0.5</priority>
            @endif
        </url>
    @endforeach
</urlset>