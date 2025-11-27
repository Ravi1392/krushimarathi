<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/">

    <channel>
        <title>{{$category->name . ' | Krushi Marathi'}}</title>
        <atom:link href="{{ url('/category/'.$category->category_slug.'/feed') }}" rel="self" type="application/rss+xml"/>
        <link>{{ url('/'. $category->category_slug) }}</link>
        <description>{{$category->meta_description}}</description>
        <lastBuildDate>{{ \Carbon\Carbon::parse($category->updated_at)->format('D, d M Y H:i:s O') }}</lastBuildDate>
        <language>en-US</language>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>

        <image>
            <url>{{ asset('public/assets/admin/images/profile/c7a1345f1120435985dcffd5d25e378e.png') }}</url>
            <title>{{$category->name . ' | Krushi Marathi'}}</title>
            <link>{{ url('/') }}</link>
            <width>32</width>
            <height>32</height>
        </image>
        @if($category->blogs)
            @foreach ($category->blogs as $blog)

            <item>
                <title>{{ $blog->blog_title }}</title>
                <link>{{ url('/' . $blog->blog_slug) }}</link>
                <dc:creator><![CDATA[Krushi Marathi]]></dc:creator>
                <category><![CDATA[{{ $category->name }}]]></category>
                <guid isPermaLink="false">{{ url('/' . $blog->blog_slug) }}</guid>
                <description><![CDATA[{!! $blog->meta_description !!}]]></description>
                <pubDate>{{ \Carbon\Carbon::parse($blog->updated_at)->format('D, d M Y H:i:s O') }}</pubDate>
                <media:content url="{{ $blog->blog_image }}" medium="image"/>
            </item>
            @endforeach
        @endif
    </channel>
</rss>