@foreach ($blogs as $blog)
    <div class="col-sm-3 change-width">
        <div class="sidebar sidebar-light sidebar-component sidebar-component-right new-border">
            <div class="sidebar-content">

                <div class="card-img-actions" style="position: relative;">
                    <img class="card-img-top img-fluid"
                        src="{{ $blog->blog_image ?? 'https://via.placeholder.com/300x200' }}"
                        alt="{{ $blog->blog_title }}">
                </div>
                <div class="card-body new-border">
                    <div class="mb-1">
                        <h4 class="font-weight-semibold mb-1">
                            <a href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}" class="text-default mb-0">{{ $blog->blog_title }}</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach