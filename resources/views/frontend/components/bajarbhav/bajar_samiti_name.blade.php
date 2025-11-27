<div class="card">
    <div class="card-header">
        <h2 class="card-title">आजचा ताजा बाजारभाव (बाजार समिती नुसार)</h2>
    </div>

    <div class="card-body">
        <div class="row">
            @foreach ($samitis as $samiti)
                <div class="col-4 pl-1 mb-1">
                    <a href="{{ route('blog.view', ['blog_slug' => $samiti->slug]) }}" class="btn" title="आजचे {{$samiti->name}} बाजारभाव">{{$samiti->name}}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>