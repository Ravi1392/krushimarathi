<!--<div class="bg-w card_radius">-->
<!--    <div class="card-body">-->
            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Nearest Taluka's</h2>
            <hr class="border-primary">
        <div style="display: grid;grid-gap: 5px;text-align: center;">
            @if ($nearest_talukas)
                @foreach (explode(', ', $nearest_talukas) as $nearest_taluk)
                    <div style="border: 1px solid #ddd;background-color: #fff;">
                        <a href="{{ route('in.taluka', ['taluka_slug' => str_replace(' ', '-', strtolower(trim($nearest_taluk)))]) }}" rel="tag" class="entry-data">
                            {{ trim($nearest_taluk) }}
                        </a>
                    </div>
                @endforeach
            @else
                <p>No nearest taluk's available.</p>
            @endif
        </div>
<!--    </div>-->
<!--</div>-->