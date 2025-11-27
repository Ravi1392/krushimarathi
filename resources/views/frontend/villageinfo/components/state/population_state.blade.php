<!--<div class="bg-w card_radius">-->
<!--    <div>-->
        <h2 class="widget-title archive-heading" style="margin-bottom: 10px;"><strong>Population of {{$en_name}}</strong></h2>
        <hr>
        <p>As per the 2011 Census, {{$en_name}} has a total population of {{$rural_total + $urban_total}} people, with {{$urban_total}} residing in urban areas and {{$rural_total}} in rural regions. The population density of {{$en_name}} is approximately {{$population_density}}/ km² (people per square kilometer), reflecting its high concentration of inhabitants across both urban and rural landscapes.</p>
        <figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
            <table>
            <thead>
                <tr>
                    <th>Particulars</th>
                    <th><strong>Rural</strong></th>
                    <th><strong>Urban</strong></th>
                    <th><strong>Total</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Population</td>
                    <td>{{$rural_total}}</td>
                    <td>{{$urban_total}}</td>
                    <td>{{$rural_total + $urban_total}}</td>
                </tr>
                <tr>
                    <td>Male Population</td>
                    <td>{{$male_rural}}</td>
                    <td>{{$male_urban}}</td>
                    <td>{{$male_rural + $male_urban}}</td>
                </tr>
                <tr>
                    <td>Female Population</td>
                    <td>{{$female_rural}}</td>
                    <td>{{$female_urban}}</td>
                    <td>{{$female_rural + $female_urban}}</td>
                </tr>
            </tbody>
        </table>
        </figure>
<!--    </div>-->
<!--</div>-->