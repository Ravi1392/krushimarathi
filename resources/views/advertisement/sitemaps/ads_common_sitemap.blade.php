<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/ads') }}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime(now())) }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/ads/login/') }}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime(now())) }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/ads/register') }}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime(now())) }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/ads/post-advertisement') }}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime(now())) }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/ads/buy') }}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime(now())) }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/ads/sell') }}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime(now())) }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>
</urlset>