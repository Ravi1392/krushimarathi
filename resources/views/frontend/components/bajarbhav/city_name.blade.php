<div class="card">
    <div class="card-header">
        <h2 class="card-title">आजचा ताजा बाजारभाव (जिल्हा नुसार)</h2>
    </div>

    <div class="card-body">
        <div class="row">
            @foreach ($cities as $city)
                <div class="col-4 pl-1 mb-1">
                    <a href="{{ route('blog.view', ['blog_slug' => $city->slug]) }}" class="btn" title="आजचे {{$city->name}} बाजारभाव">{{$city->name}}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>