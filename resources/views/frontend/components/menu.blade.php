{{-- {{dd($sub_categories)}} --}}
@if (isset($sub_categories) && !empty($sub_categories))
        <div class="sdn_professionSlider owl-carousel" style="display: flex;overflow-x: auto;gap: 10px;">
            @foreach ($sub_categories as $sub_category)
                
                <div class="sdn_professionItem" style="flex-shrink: 0;">
                    <a href='{{ route("front.category_wise_view", ["slug" => $slug, "sub_category" => $sub_category->subcategory_slug]) }}' class="contentRow contentRow--alignMiddle">
                        <div class="contentRow-title">{{$sub_category->name}}</div>
                    </a>
                </div>
                
            @endforeach
        </div>
@endif
