<!--<div class="bg-w card_radius">-->
    <a href="{{ url('/in') }}">Home</a>

    @if (isset($state_name) && !empty($state_name) && isset($state_slug) && !empty($state_slug))
        <span> &nbsp;>&nbsp; </span>
        <a href="{{ url('/in/state/'.$state_slug) }}">{{ $state_name }}</a>
    @endif

    @if (isset($district_name) && !empty($district_name) && isset($district_slug) && !empty($district_slug))
        <span> &nbsp;>&nbsp; </span>
        <a href="{{ url('/in/district/'.$district_slug) }}">{{ $district_name }}</a>
    @endif

    @if (isset($taluka_name) && !empty($taluka_name) && isset($taluka_slug) && !empty($taluka_slug))
        <span> &nbsp;>&nbsp; </span>
        <a href="{{ url('/in/taluka/'.$taluka_slug) }}">{{ $taluka_name }}</a>
    @endif

    @if (isset($title) && !empty($title))
        <span> &nbsp;>&nbsp; </span>
        <span style="font-weight: 100;">{{$title}}</span>
    @endif

<!--</div>-->