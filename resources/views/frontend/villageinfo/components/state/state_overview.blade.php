<!--<div class="bg-w card_radius">-->
    <figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
        <table class="table table-bordered">
        <tbody>
            <tr><th colspan="2">State Overview</th></tr>
            <tr>
                <td><strong>State/UT Name</strong></td>
                <td>{{$en_name . ' - (' . $mr_name .')'}}</td>
            </tr>
            <tr>
                <td><strong>Capital</strong></td>
                <td>{{$capital}}</td>
            </tr>
            <tr>
                <td><strong>Established</strong></td>
                <td>{{ date('j-M-Y', strtotime($established)) }}</td>
            </tr>
            <tr>
                <td><strong>Total Area</strong></td>
                <td>{{$total_area}} km²</td>
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
                <td><strong>High Court</strong></td>
                <td>{{$court}}</td>
            </tr>
        </tbody>
    </table>
    </figure>
<!--</div>-->