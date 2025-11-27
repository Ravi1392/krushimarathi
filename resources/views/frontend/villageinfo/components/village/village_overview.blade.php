<!--<div class="bg-w card_radius">-->
    <figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th colspan="2">{{$en_name}} Overview (Administrative & Basic Details)</th>
                </tr>
                <tr>
                    <td><strong>Village Name</strong></td>
                    <td>{{$en_name . ' - (' . $mr_name .')'}}</td>
                </tr>
                <tr>
                    <td><strong>Pincode</strong></td>
                    <td>{{$pincode}}</td>
                </tr>
                <tr>
                    <td><strong>Area</strong></td>
                    <td>{{$total_area}}</td>
                </tr>
                <tr>
                    <td><strong>Village Code</strong></td>
                    <td>{{$village_code}}</td>
                </tr>
                <tr>
                    <td><strong>Taluka Name</strong></td>
                    <td>{{$taluka_name}}</td>
                </tr>
                <tr>
                    <td><strong>District Name</strong></td>
                    <td>{{$district_name}}</td>
                </tr>
                <tr>
                    <td><strong>State/UT Name</strong></td>
                    <td>{{$state_name}}</td>
                </tr>
                <tr>
                    <td><strong>Gram Panchayat Name</strong></td>
                    <td>{{$gram_panchayat_name}}</td>
                </tr>
                <tr>
                    <td><strong>Gram Panchayat Code</strong></td>
                    <td>{{$panchayat_code}}</td>
                </tr>
                <tr>
                    <td><strong>Sex Ratio</strong></td>
                    <td>{{$sex_ratio}}</td>
                </tr>
                <tr>
                    <td><strong>Total Population (2011)</strong></td>
                    <td>{{$total_population}}</td>
                </tr>
                <tr>
                    <td><strong>Total Households</strong></td>
                    <td>{{$population_density}}</td>
                </tr>
            </tbody>
        </table>
    </figure>
<!--</div>-->