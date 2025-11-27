{{-- {{dd($sub_categories)}} --}}
@if (isset($categories) && !empty($categories))
        <div class="sdn_professionSlider owl-carousel" style="display: flex;overflow-x: auto;gap: 10px;">
            @foreach ($categories as $category_info)
                
                <?php
                    $CatpageUrl = url('/web-stories/' . $category_info->category_slug);
                    $Catactive = ((Request::url() === $CatpageUrl) || (Request::segment(1) === $category_info->category_slug)) ? 'active' : '';
                ?>
                <div class="sdn_professionItem" style="flex-shrink: 0;">
                    <a href='{{ route("webstory.category_wise_stories", ["category_slug" => $category_info->category_slug]) }}' class="contentRow contentRow--alignMiddle {{$Catactive}}">
                        <div class="contentRow-title">{{$category_info->name}}</div>
                    </a>
                </div>
                
            @endforeach
        </div>
@endif
