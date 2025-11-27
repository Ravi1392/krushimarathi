<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    @foreach($blogs as $blog)
        <url>
            <loc>{{ url('/'. $blog->blog_slug) }}</loc>
            <news:news>
                <news:publication>
                    <news:name>Krushi Marathi</news:name>
                    @if(isset($blog->category) && $blog->category->category_slug == "english")
                        <news:language>en</news:language>
                    @elseif (isset($blog->category) && $blog->category->category_slug == "hindi")
                        <news:language>hi</news:language>
                    @else
                        <news:language>mr</news:language>
                    @endif
                </news:publication>
                <news:publication_date>{{ $blog->created_at->toAtomString() }}</news:publication_date>
                <news:title>{{ htmlspecialchars($blog->blog_title) }}</news:title>
            </news:news>
        </url>
    @endforeach
</urlset>