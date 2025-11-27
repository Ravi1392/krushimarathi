<figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th><strong>Village Name in English</strong></th>
                <th><strong>Village Name</strong></th>
                <th><strong>Gram Panchayat</strong></th>
                <th><strong>Panchayat Code</strong></th>
                
            </tr>
            @if (isset($villages_data) && !empty($villages_data))
                @foreach ($villages_data as $village_data)
                    <tr>
                        <td>
                            @if ($village_data->is_active === 1)
                                <a href="{{ route('in.village', ['village_slug' => $village_data->village_slug]) }}"><strong>{{$village_data->en_name}}</strong></a>
                            @else
                                {{$village_data->en_name}}
                            @endif
                        </td>
                        <td>{{$village_data->mr_name ?? "No Data"}}</td>
                        <td>{{$village_data->gram_panchayat_name ?? "No Data"}}</td>
                        <td>{{$village_data->panchayat_code ?? "No Data"}}</td>
                    </tr>
                @endforeach
                
            @else
                <tr>
                    <td colspan="5">Village data not found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</figure>
