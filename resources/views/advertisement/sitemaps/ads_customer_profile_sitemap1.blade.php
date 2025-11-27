<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    @foreach($customers as $customer)
        <url>
            <loc>{{ url('/ads/profile/'. base64_encode($customer->id)) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($customer->updated_at)) }}</lastmod>
            <changefreq>yearly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

</urlset>