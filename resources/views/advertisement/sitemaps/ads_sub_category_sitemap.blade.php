<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    @foreach($ads_sub_categories as $sub_category)
        <url>
            <loc>{{ url('/ads/product/'. $sub_category->category->slug .'/'. $sub_category->slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($sub_category->updated_at)) }}</lastmod>
            <changefreq>yearly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

</urlset>