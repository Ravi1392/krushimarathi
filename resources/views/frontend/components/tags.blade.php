<footer class="entry-meta" aria-label="Entry meta">
    <span class="cat-links">
        <span class="gp-icon icon-categories">
            <svg viewBox="0 0 512 512" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
                <path d="M0 112c0-26.51 21.49-48 48-48h110.014a48 48 0 0143.592 27.907l12.349 26.791A16 16 0 00228.486 128H464c26.51 0 48 21.49 48 48v224c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V112z"></path>
            </svg>
        </span>
        <span class="screen-reader-text">Categories </span>
        <a href="{{url('/'. $category_slug .'/'. $sub_category_slug)}}" rel="category tag" class="entry-data">{{$sub_category_name}}</a>
    </span> 
    <span class="tags-links">
        <span class="gp-icon icon-tags">
            <svg viewBox="0 0 512 512" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
                <path d="M20 39.5c-8.836 0-16 7.163-16 16v176c0 4.243 1.686 8.313 4.687 11.314l224 224c6.248 6.248 16.378 6.248 22.626 0l176-176c6.244-6.244 6.25-16.364.013-22.615l-223.5-224A15.999 15.999 0 00196.5 39.5H20zm56 96c0-13.255 10.745-24 24-24s24 10.745 24 24-10.745 24-24 24-24-10.745-24-24z"></path>
                <path d="M259.515 43.015c4.686-4.687 12.284-4.687 16.97 0l228 228c4.686 4.686 4.686 12.284 0 16.97l-180 180c-4.686 4.687-12.284 4.687-16.97 0-4.686-4.686-4.686-12.284 0-16.97L479.029 279.5 259.515 59.985c-4.686-4.686-4.686-12.284 0-16.97z"></path>
            </svg>
        </span>
        <span class="screen-reader-text">Tags </span>
        @foreach ($tags as $tag)
        
            <a href="{{ route('tag.search', ['blog_tag' => str_replace(' ', '-', trim($tag))]) }}" rel="tag" class="entry-data">
                {{ trim($tag) }}
            </a>{{ !$loop->last ? ',' : '' }}
        @endforeach
    </span>
</footer>