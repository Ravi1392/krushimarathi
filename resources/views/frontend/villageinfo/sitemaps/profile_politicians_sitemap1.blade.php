<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($profile_politicians as $profile_politician)
        <url>
            <loc>{{ url('/in/profile/'. $profile_politician->profile_slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($profile_politician->updated_at)) }}</lastmod>
            <changefreq>yearly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>