<div class="sectionWrapper">
    <div class="sectionTitlebar sectionTitlebar--hasCta block">
        <a href="{{ route('front.show', ['slug' => 'visual-stories']) }}"> 
         <h2 class="sectionTitle archive-heading">{{isset($category_name) ? $category_name . ' - ' : "" }} वेब स्टोरीज़</h2></a>
         <div class="sectionTitle--opposite">
         <a href="{{ route("webstory.category_wise_stories", ["category_slug" => $category_slug]) }}" style="background: #55555e;color: #fff;padding: 2px 10px;border-radius: 25px;">View All</a>
         </div>
     </div>
    <div class="container">
        <div id="webstory-list" class="xpress_articleList virtual-story-home-grid">
            @if ($visual_stories->isNotEmpty())
                @foreach ($visual_stories as $visual_story)
                    <article>
                        <div class="sdn_aboutUs__Card card-shadow">
                            <div class="block-container">
                                <div class="media__object media--left">
                                    <div class="xpress_articleImage--full">
                                        <a title="{{$visual_story->title}}" href="{{ route('webstory.show', ['story_slug' => $visual_story->slug]) }}" target="_blank">
                                            <img width="250" height="280" src="{{$visual_story->file}}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{$visual_story->title}}" fetchpriority="high" decoding="async" loading="lazy">
                                        </a>
                                    </div>
                                </div>
                                <div class="web-stories-home-content">
                                    <ul class="entry-meta listInline webstory_ul_font">
                                        <li class="web-stories-date-font-size">
                                            {{Date('F j, Y', strtotime($visual_story->created_at))}}
                                        </li>
                                    </ul>
                                    <a title="{{$visual_story->title}}" href="{{ route('webstory.show', ['story_slug' => $visual_story->slug]) }}"  target="_blank">
                                        <h3 class="web-stories-home-font-size" style="">{{$visual_story->title}}</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="coming-soon-wrapper">
                    <h1>Coming Soon...</h1>
                </div>
            @endif
        </div>
    </div>
</div>