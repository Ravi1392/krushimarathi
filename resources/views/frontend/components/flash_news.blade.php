@php
    if($is_language == 'marathi'){
        $error_title = "सध्या Live News उपलब्ध नाही. (मराठी)";
        $news_slug = 'latest-breaking-news-in-marathi-' . date('j-F-Y'); 
    }
    if($is_language == 'hindi'){
        $error_title = "कोई लाइव न्यूज़ उपलब्ध नहीं है। (हिन्दी)";
        $news_slug = 'latest-breaking-news-in-hindi-' . date('j-F-Y'); 
    }
    if($is_language == 'english'){
        $error_title = "Live News not available right now. (English)";
        $news_slug = 'latest-breaking-news-in-english-' . date('j-F-Y'); 
    }
@endphp

<div class="widget-container lv-update" data-tb-region="{{$title}}">
        <div class="hed-panel-common">
            <div class="widget-title1">
                <h2>{{$title}}</h2>
                
            </div>
            <div class="refresh-icon">
                <a href="{{ route('blog.view', ['blog_slug' => $news_slug]) }}" title="See more">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>
        </div>
        <div class="live-update-container showcase">
            <div class="live-update-body content" id="liveUpdateBody">
                <ul id="live-update-id-001">
                    @if(isset($data) && $data->newsflashsdata && $data->newsflashsdata->count() > 0)
                        @foreach($data->newsflashsdata as $news_data)
                            <li data-tb-region-item="">
                                <div class="live-list-group">
                                    <a href="{{ route('blog.view', ['blog_slug' => $news_slug]) }}" title="{{$news_data->title}}">
                                        <h4 class="live-list">{{date("h:i A", strtotime($news_data->created_at))}}</h4>
                                        <p>{{$news_data->title}}</p>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li data-tb-region-item="">
                            <div class="live-list-group">
                                <h4>{{date("h:i A")}}</h4>
                                <p>{{$error_title}}</p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>