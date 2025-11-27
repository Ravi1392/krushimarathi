<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Krushi Marathi</title>
        <link>{{ url('/') }}</link>
        <description>Krushi Marathi is a platform where you will get information on a variety of topics, whether they are trending subjects or matters related to people's interests. Our aim is to ensure you find everything you need on this website. Our content is designed to be informative and engaging.</description>
        <pubDate>{{ $blogs->max('updated_at') ? \Carbon\Carbon::parse($blogs->max('updated_at'))->toRssString() : now()->toRssString() }}</pubDate>

        @foreach ($blogs as $blog)
        <item>
            <title>{{ $blog->blog_title }}</title>
            <link>{{ url('/' . $blog->blog_slug) }}</link>
            <description>{{ $blog->meta_description }}</description>
            <pubDate>{{ \Carbon\Carbon::parse($blog->updated_at)->toRssString() }}</pubDate>
            <guid isPermaLink="true">{{ url('/' . $blog->blog_slug) }}</guid>
            @if ($blog->category->name)
            <category>{{ e($blog->category->name) }}</category>
            @endif
            @if ($blog->featured_image)
            <media:content url="{{ $blog->blog_image }}" medium="image" type="image/webp" />
            @endif
        </item>
        @endforeach
    </channel>
</rss>