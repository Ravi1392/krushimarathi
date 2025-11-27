<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach ($blogs as $blog)
        <url>
            <loc>{{ url('/'. $blog->blog_slug) }}</loc>
            <image:image>
                <image:loc>{{ $blog->blog_image }}</image:loc>
                <image:caption>{{ $blog->blog_title }}</image:caption>
                <image:title>{{ ucwords(str_replace('-', ' ', $blog->blog_slug)) }}</image:title>
            </image:image>
        </url>
    @endforeach
</urlset>