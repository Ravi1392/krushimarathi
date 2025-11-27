<!--<div class="bg-w card_radius">-->
<!--    <div class="card-body">-->
            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Nearest Village's</h2>
            <hr class="border-primary">
        <div style="display: grid;grid-gap: 5px;text-align: center;">
            @if ($nearest_villages)
                @foreach (explode(', ', $nearest_villages) as $nearest_village)
                    <div style="border: 1px solid #ddd;background-color: #fff;">
                        <a href="{{ route('in.village', ['village_slug' => str_replace(' ', '-', strtolower(trim($nearest_village)))]) }}" rel="tag" class="entry-data">
                            {{ trim($nearest_village) }}
                        </a>
                    </div>
                @endforeach
            @else
                <p>No nearest village's available.</p>
            @endif
        </div>
<!--    </div>-->
<!--</div>-->