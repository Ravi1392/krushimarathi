<figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th><strong>District Name in English</strong></th>
                <th><strong>District Name</strong></th>
                <th><strong>Area (km²)</strong></th>
                <th><strong>Population (2011)</strong></th>
                <th><strong>Density (/km²)</strong></th>
                
            </tr>
            @if (isset($districts_data) && !empty($districts_data))
                @foreach ($districts_data as $district_data)
                    <tr>
                        <td>
                            @if ($district_data->is_active === 1)
                                <a href="{{ route('in.district', ['district_slug' => $district_data->district_slug]) }}"><strong>{{$district_data->en_name}}</strong></a>
                            @else
                                {{$district_data->en_name}}
                            @endif
                        </td>
                        <td>{{$district_data->mr_name}}</td>
                        <td>{{$district_data->area ?? "No Data"}}</td>
                        <td>{{$district_data->population ?? "No Data"}}</td>
                        <td>{{$district_data->density ?? "No Data"}}</td>
                    </tr>
                @endforeach
                
            @else
                <tr>
                    <td colspan="5">State data not found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</figure>
