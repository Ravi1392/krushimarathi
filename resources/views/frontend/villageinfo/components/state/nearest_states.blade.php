<!--<div class="bg-w card_radius">-->
<!--    <div class="card-body">-->
            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Nearest States</h2>
            <hr class="border-primary">
        <div style="display: grid;grid-gap: 5px;text-align: center;">
            @if ($nearest_states)
                @foreach (explode(', ', $nearest_states) as $nearest_state)
                    <div style="border: 1px solid #ddd;background-color: #fff;">
                        <a href="{{ route('in.state', ['state_slug' => str_replace(' ', '-', strtolower(trim($nearest_state)))]) }}" rel="tag" class="entry-data">
                            {{ trim($nearest_state) }}
                        </a>
                    </div>
                @endforeach
            @else
                <p>No nearest states available.</p>
            @endif
        </div>
<!--    </div>-->
<!--</div>-->