<!--<div class="bg-w card_radius">-->
    <div class="card-body">
            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Other Countries</h2>
            <hr class="border-primary">
        <div style="display: grid;grid-gap: 5px;text-align: center;">
            @if (!empty($other_countries) && isset($other_countries))
                @foreach ($other_countries as $other_country)
                    <div style="border: 1px solid #ddd;background-color: #fff;">
                        <a href="{{ route('in.country', ['country_slug' => $other_country->country_slug]) }}" rel="tag" class="entry-data">
                            {{ $other_country->name }}
                        </a>
                    </div>
                @endforeach
            @else
                <p>No Countries Found.</p>
            @endif
        </div>
    </div>
<!--</div>-->