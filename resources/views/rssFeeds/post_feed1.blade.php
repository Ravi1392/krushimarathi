<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    xmlns:media="http://search.yahoo.com/mrss/">

    <channel>
        <title>Krushi Marathi</title>
        <atom:link href="{{ url('/feed') }}" rel="self" type="application/rss+xml"/>
        <link>{{ url('/') }}</link>
        <description>Krushi Marathi is a platform where you will get information on a variety of topics, whether they are trending subjects or matters related to people's interests.</description>
        <lastBuildDate>{{ now()->toRssString() }}</lastBuildDate>
        <language>en-US</language>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>

        @foreach ($blogs as $blog)

        <item>
            <title>{{ $blog->blog_title }}</title>
            <link>{{ url('/' . $blog->blog_slug) }}</link>
            <dc:creator><![CDATA[Krushi Marathi]]></dc:creator>
            <category><![CDATA[{{ $blog->category->name }}]]></category>
            <guid isPermaLink="false">{{ url('/' . $blog->blog_slug) }}</guid>
            <description><![CDATA[{!! $blog->meta_description !!}]]></description>
            <pubDate>{{ \Carbon\Carbon::parse($blog->updated_at)->format('D, d M Y H:i:s O') }}</pubDate>
            <media:content url="{{ $blog->blog_image }}" medium="image"/>
        </item>
        @endforeach
    </channel>
</rss>