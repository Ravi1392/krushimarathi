@foreach ($products as $product)
    <div class="col-sm-3 change-width">
        <div class="sidebar sidebar-light sidebar-component sidebar-component-right new-border">
            <div class="sidebar-content">

                <div class="card-img-actions" style="position: relative;">
                    <img class="card-img-top img-fluid"
                        src="{{ $product->photo ?? 'https://via.placeholder.com/300x200' }}"
                        alt="{{ $product->title }}">

                    {{-- Sale/Buy badge on image --}}
                    <span class="badge badge-pill {{ $product->lead_type == 0 ? 'bg-success' : 'bg-primary' }}"
                        style="position: absolute; top: 10px; left: 10px; z-index: 5; font-size: 13px; padding: 6px 12px 6px 12px;">
                        {{ $product->lead_type == 0 ? __('common.sell') : __('common.buy') }}
                    </span>

                    {{-- Existing header elements --}}
                    {{-- <div class="header-elements" style="position: absolute; bottom: 10px; right: 10px;">
                        <span class="badge bg-success badge-pill">{{ $product->active_ads_count ?? '0' }} active</span>
                    </div> --}}
                </div>

                <div class="card-body bg-light text-center new-border">
                    <div class="mb-1">
                        <h4 class="font-weight-semibold mb-1">
                            <a href="{{ route('ads.product.product_view', ['product_view' => $product->slug]) }}" class="text-default mb-0">{{ $product->title }}</a>
                        </h4>
                        <a href="{{ route('ads.product.product_sub_category', ['product_category' => $product->category->slug, 'product_sub_category' => $product->subcategory->slug ?? "xyz"]) }}" class="text-muted">{{ $product->subcategory->name ?? "" }}</a>
                    </div>
                    <h3 class="mb-2 font-weight-semibold">₹ {{ number_format($product->price, 2) }} /{{ __('common.per') }} {{ $product->unit->name }}</h3>
                    <div class="mb-2">
                        <i class="icon-user"></i>&nbsp;
                        {{ $product->customer->full_name ?? 'Krushi Marathi' }}
                    </div>
                    <div>
                        <i class="icon-location4"></i>&nbsp;
                        @php
                            if ($product->address_link == 1) {
                                $address = $product->address ?? '';
                                $state = $product->state->name ?? '';
                                $district = $product->district->name ?? '';
                            } elseif ($product->address_link == 2 && $product->customer) {
                                $address = $product->customer->address ?? '';
                                $state = $product->customer->state->name ?? '';
                                $district = $product->customer->district->name ?? '';
                            } else {
                                $address = $state = $district = '';
                            }

                            $locationParts = array_filter([$address, $district, $state]);
                            $location = implode(', ', $locationParts);
                        @endphp
                        {{ !empty($location) ? $location : __('Location not available') }}
                    </div>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between">
                   
                    <ul class="list-inline mb-0 mr-2">
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="text-pink-400 toggle-wishlist" data-product-id="{{ $product->id }}">
                                <i class="{{ in_array($product->id, $wishlistProductIds ?? []) ? 'icon-heart5' : 'icon-heart6 text-danger' }}"></i>
                            </a>
                        </li>
                    </ul>
                    <span class="text-muted"><i class="icon-calendar mr-2"></i> {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</span>
                    <span class="text-muted"><i class="icon-eye mr-2"></i> {{ $product->views ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>
@endforeach
