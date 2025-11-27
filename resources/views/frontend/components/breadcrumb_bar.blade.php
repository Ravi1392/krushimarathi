<a href="{{ url('/') }}">Home</a>

@if (isset($category_name) && !empty($category_name) && isset($category_slug) && !empty($category_slug))
    <span> &nbsp;|&nbsp; </span>
    <a href="{{ url('/'.$category_slug) }}">{{ $category_name }}</a>
@endif

@if (isset($sub_category_name) && !empty($sub_category_name))
    <span> &nbsp;|&nbsp; </span>
    <span style="font-weight: 100;">{{$sub_category_name}}</span>
@endif

@if (isset($blog_title) && !empty($blog_title))
    <span> &nbsp;|&nbsp; </span>
    <span style="font-weight: 100;">{{$blog_title}}</span>
@endif