<div class="container">
    <div class="row">
        <div class="col-md-2">
            {{-- <div class="breaking-news" style="color: white;padding: 5px 0px 5px 20px;"> --}}
            <div class="breaking-news" style="padding: 5px 6px 5px 6px;border-bottom: 1px solid #1ecf2e;
                background-color: #ffffff;color: #000000;">
                <!--{{ date('l, j F Y') }}-->
                <div>
                    <span><a class="postr" href="{{url('/ads')}}" title="Buy Product">BUY NOW</a></span>
                    <span> &thinsp; </span>

                    @if(!Auth::guard('customer')->check())
                        <span><a class="postr" href="{{route('ads.post-advertisement')}}" title="Sell Product">SELL</a></span>
                    @else
                        <span><a class="postr" href="{{route('ads.post-requirement')}}" title="Sell Product">SELL</a></span>
                    @endif  
                </div>
                <div>
                    @php
                        $flash_slug = 'latest-breaking-news-in-hindi-' . strtolower(date('d-F-Y'));
                    @endphp
                    <!--<span> <span class="live-indicator"></span><a href="{{ route('blog.view', ['blog_slug' => $flash_slug]) }}" title="Breaking News Live Updates">Live</a></span>-->
                    <!--<span> &thinsp; </span>-->
                    <span><a href="{{url('/in')}}" title="english">My Village</a></span>
                    <span> &thinsp; </span>
                    <span><a href="{{url('/english')}}" title="english">English</a></span>
                    <span> &thinsp; </span>
                    <span><a href="{{url('/hindi')}}" title="हिंदी">हिंदी</a></span>
                </div>
            </div>
        </div>
    </div>
</div>