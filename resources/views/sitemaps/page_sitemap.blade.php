<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    
    @foreach($footercategories as $footercategory)
        <url>
            <loc>{{ url('/'. $footercategory->category_slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($footercategory->content_updated_at)) }}</lastmod>
            <changefreq>yearly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
</urlset>