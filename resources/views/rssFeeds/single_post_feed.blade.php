<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:media="http://search.yahoo.com/mrss/">

    <channel>
        <title>{{ $blog->blog_title }}</title>
        <atom:link href="{{ url($blog->blog_slug. '/feed/') }}" rel="self" type="application/rss+xml"/>
        <link>{{ url('/' . $blog->blog_slug) }}</link>
        <description><![CDATA[{{ $blog->meta_description }}]]></description>
        <lastBuildDate>{{ now()->toRssString() }}</lastBuildDate>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>
    </channel>
</rss>
