<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="card-title font-weight-semibold">Categories</span>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="nav nav-sidebar my-2">

            @foreach ($filtered_categories as $category)
                <li class="nav-item">
                    <a href="{{ route('ads.product.product_category', $category->slug) }}" class="nav-link">
                        <i class="icon-folder"></i>
                        {{$category->name }}
                        <span class="text-muted font-size-sm font-weight-normal ml-auto">
                            {{ $category->product_count ?? 0 }}
                        </span>
                    </a>
                </li>
            @endforeach
        </div>
    </div>
</div>