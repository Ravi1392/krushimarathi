<!--<div class="bg-w card_radius">-->
<!--    <div class="card-body">-->
            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Nearest Districts</h2>
            <hr class="border-primary">
        <div style="display: grid;grid-gap: 5px;text-align: center;">
            @if ($nearest_districts)
                @foreach (explode(', ', $nearest_districts) as $nearest_district)
                    <div style="border: 1px solid #ddd;background-color: #fff;">
                        <a href="{{ route('in.district', ['district_slug' => str_replace(' ', '-', strtolower(trim($nearest_district)))]) }}" rel="tag" class="entry-data">
                            {{ trim($nearest_district) }}
                        </a>
                    </div>
                @endforeach
            @else
                <p>No nearest districts available.</p>
            @endif
        </div>
<!--    </div>-->
<!--</div>-->