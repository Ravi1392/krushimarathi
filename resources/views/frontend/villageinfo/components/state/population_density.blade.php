<!--<div class="bg-w card_radius">-->
    <div>
        <h2 class="widget-title archive-heading" style="margin-bottom: 10px;"><strong>Population Density of {{$en_name}}</strong></h2>
        <hr>
        <p>As of the latest data, the population density of {{$en_name}} is approximately {{$population_density}}/ km² (people per square kilometer). The breakdown is as follows:</p>

        <figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="vict-title viwi25"><strong>Rural</strong></th>
                    <th class="vict-title viwi25"><strong>Urban</strong></th>
                    <th class="vict-title viwi25"><strong>Total</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <td> <span class="vi-minfo">{{$rural_density}}</span></td>
                    <td> <span class="vi-minfo">{{$urban_density}}</span></td>
                    <td> <span class="vi-minfo">{{$population_density}}/ km²</span></td>
                </tr>
            </tbody>
        </table>
        </figure>
    </div>
<!--</div>-->