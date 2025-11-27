<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Categories</span>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>

    <div class="card-body border-0 p-0">
        <ul class="nav nav-sidebar mb-2">
            @foreach($filtered_categories as $category)
                <li class="nav-item nav-item-submenu {{ request()->segment(3) == $category->slug ? 'nav-item-open nav-item-expanded' : '' }}">
                    <div class="d-flex justify-content-between align-items-center px-3 py-2">
                        <a href="{{ route('ads.product.product_category', $category->slug) }}"
                           class="nav-link p-0 {{ request()->segment(3) == $category->slug ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>

                        @if($category->subcategories && $category->subcategories->count())
                            <a href="#" class="toggle-submenu"><i class="icon-arrow-down5"></i></a>
                        @endif
                    </div>

                    @if($category->subcategories && $category->subcategories->count())
                        <ul class="nav nav-group-sub {{ request()->segment(3) == $category->slug ? '' : 'd-none' }}"
                            data-submenu-title="{{ $category->name }}">
                            @foreach($category->subcategories as $subcategory)
                                <li class="nav-item">
                                    <a href="{{ route('ads.product.product_sub_category', [$category->slug, $subcategory->slug]) }}"
                                       class="nav-link {{ request()->segment(4) == $subcategory->slug ? 'active' : '' }}">
                                        {{ $subcategory->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
