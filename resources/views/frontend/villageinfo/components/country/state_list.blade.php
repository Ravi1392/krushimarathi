<figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th><strong>State Name in English</strong></th>
                <th><strong>State Name</strong></th>
                <th><strong>State or UT</strong></th>
                <th><strong>Census Code</strong></th>
                <th><strong>No. of Villages</strong></th>
                
            </tr>
            @if (isset($states_data) && !empty($states_data))
                @foreach ($states_data as $state_data)
                    <tr>
                        <td>
                            @if ($state_data->is_active === 1)
                                <a href="{{ route('in.state', ['state_slug' => $state_data->state_slug]) }}">{{$state_data->en_name}}</a>
                            @else
                                {{$state_data->en_name}}
                            @endif
                        </td>
                        <td>{{$state_data->mr_name}}</td>
                        <td>{{$state_data->type ?? "No Data"}}</td>
                        <td>{{$state_data->census_code ?? "No Data"}}</td>
                        <td>{{$state_data->total_villages ?? "No Data"}}</td>
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
