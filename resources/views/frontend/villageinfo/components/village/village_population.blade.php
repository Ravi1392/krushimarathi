<!--<div class="bg-w card_radius">-->
<!--    <div>-->
        <h2 class="archive-heading" style="font-size: 24px;margin-bottom: 10px;"><strong>Population of {{$en_name}}</strong></h2>
        <hr>
        <p>As of the 2011 census, Population of {{$en_name}} has a population of approximately {{$population}} people, where the male population is {{ $villagestatistics[0]['male'] ?? 'N/A' }} and the female population is {{$villagestatistics[0]['female'] ?? 'N/A'}}.</p>

        <p>The population details of {{$en_name}} cover important figures like total population, male and female population, children aged 0–6 years, and the number of literate and illiterate people. It also shows how many residents belong to Scheduled Castes and Scheduled Tribes. These details help in understanding the village structure, education level, and community groups.</p>
        
        <figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
            <table>
            <thead>
                <tr>
                    <th>Particulars</th>
                    <th><strong>Total</strong></th>
                    <th><strong>Male</strong></th>
                    <th><strong>Female</strong></th>
                </tr>
            </thead>
            <tbody>
                @if (isset($villagestatistics) && !empty($villagestatistics))
                    @foreach ($villagestatistics as $villages_info)
                        <tr>
                            <td>{{!empty($villages_info->villagepopulationcategory->category_name) ? $villages_info->villagepopulationcategory->category_name : "N/A"}}</td>
                            <td>{{$villages_info->total}}</td>
                            <td>{{$villages_info->male}}</td>
                            <td>{{$villages_info->female}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Total Population</td>
                    </tr>
                @endif
            </tbody>
        </table>
        </figure>
<!--    </div>-->
<!--</div>-->