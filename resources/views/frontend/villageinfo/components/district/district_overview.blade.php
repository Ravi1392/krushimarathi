<!--<div class="bg-w card_radius">-->
    <figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
        <table class="table table-bordered">
        <tbody>
            <tr><th colspan="2">District Overview</th></tr>
            <tr>
                <td><strong>District</strong></td>
                <td>{{$en_name . ' - (' . $mr_name .')'}}</td>
            </tr>
            <tr>
                <td><strong>State/UT Name</strong></td>
                <td>{{$state_en_name . ' - (' . $state_mr_name .')'}}</td>
            </tr>
            <tr>
                <td><strong>Total Area</strong></td>
                <td>{{$total_area}} km²</td>
            </tr>
            <tr>
                <td><strong>Total Tehsils</strong></td>
                <td>{{$total_tahsils}}</td>
            </tr>
            <tr>
                <td><strong>Total Villages</strong></td>
                <td>{{$total_villages}}</td>
            </tr>
            <tr>
                <td><strong>Sex Ratio (2011)</strong></td>
                <td>{{$sex_ratio}}</td>
            </tr>
            <tr>
                <td><strong>Population Density</strong></td>
                <td>{{$population_density}}/ km²</td>
            </tr>
            <tr>
                <td><strong>Total Population (2011)</strong></td>
                <td>{{$total_population}}</td>
            </tr>
            <tr>
                <td><strong>Official Website</strong></td>
                <td>
                    @if(!empty($official_website))
                        <a href="{{ $official_website }}" target="_blank" style="color:#0a3bf7;">
                            {{ $official_website }}
                        </a>
                    @else
                        NA
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    </figure>
<!--</div>-->