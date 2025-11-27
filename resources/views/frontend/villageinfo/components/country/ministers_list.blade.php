<div class="row1 row-gap">
    @foreach ($profilepoliticians as $politician)
        <div class="col-md-4 singlebox col-one">
            <div class="box-1  whitebg border">
                <div class="khowMinisterBox">
                    <div class="khowMinisterBoxImg">
                        <a href="{{ route('in.profile', ['profile_slug' => $politician->profile_slug]) }}">
                            <img decoding="async" class="" src="{{$politician->photo}}" alt="{{$politician->name}}" title="{{$politician->name}}" style="width: 150px;border: 1px solid #82828275;">
                        </a>
                    </div>
                    <div class="MinisterProfile">
                        <span class="Pname">Hon'ble {{$politician->profileposition->position_name }} of {{$country_data->name}}</span>
                        <span class="Pdesg"><a href="{{ route('in.profile', ['profile_slug' => $politician->profile_slug]) }}">{{$politician->name}}</a></span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>