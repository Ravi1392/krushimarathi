<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   
    @foreach($sub_categories as $sub_category)
        <url>
            <loc>{{ url('/'. $sub_category->category->category_slug .'/'.$sub_category->subcategory_slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($sub_category->content_updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    
</urlset>