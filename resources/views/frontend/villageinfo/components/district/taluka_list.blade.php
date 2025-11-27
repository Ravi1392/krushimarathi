<figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th><strong>Taluka Name in English</strong></th>
                <th><strong>Taluka Name</strong></th>
                <th><strong>Area (km²)</strong></th>
                <th><strong>Population (2011)</strong></th>
                <th><strong>Density (/km²)</strong></th>
                
            </tr>
            @if (isset($talukas_data) && !empty($talukas_data))
                @foreach ($talukas_data as $taluka_data)
                    <tr>
                        <td>
                            @if ($taluka_data->is_active === 1)
                                <a href="{{ route('in.taluka', ['taluka_slug' => $taluka_data->taluka_slug]) }}"><strong>{{$taluka_data->en_name}}</strong></a>
                            @else
                                {{$taluka_data->en_name}}
                            @endif
                        </td>
                        <td>{{$taluka_data->mr_name}}</td>
                        <td>{{$taluka_data->area ?? "No Data"}}</td>
                        <td>{{$taluka_data->population ?? "No Data"}}</td>
                        <td>{{$taluka_data->density ?? "No Data"}}</td>
                    </tr>
                @endforeach
                
            @else
                <tr>
                    <td colspan="5">Taluka data not found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</figure>
