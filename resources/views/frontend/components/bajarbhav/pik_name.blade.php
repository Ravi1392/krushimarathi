<div class="card">
    <div class="card-header">
        <h2 class="card-title" style="margin-bottom:unset;">आजचा ताजा बाजारभाव (पीक नुसार)</h2>
    </div>

    <div class="card-body">
        <div class="row">
            @foreach ($crops as $crop)
                <div class="col-4 pl-1 mb-1">
                    <a href="{{ route('blog.view', ['blog_slug' => $crop->slug]) }}" class="btn" title="आजचा {{$crop->name}} बाजारभाव">{{$crop->name}}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>