<!--<div class="match-container">-->
    <div class="points-table" style="color: white;">
        <div class="table-container">
            <table style="margin: 0">
                <thead>
                    <tr>
                        <th class="text-start">IPL Points Table</th>
                        <th>P</th>
                        <th>W</th>
                        <th>L</th>
                        <th>NR</th>
                        <th>PTS</th>
                        <th>NRR</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($points_table)
                        @foreach ($points_table as $point_table)
                            <tr>
                                <td>
                                    <div class="team-info">
                                        <span><img src="{{$point_table->img}}" alt="CSK"></span>
                                        <span>{{$point_table->shortname}}</span>
                                    </div>
                                </td>
                                <td>{{$point_table->matches}}</td>
                                <td>{{$point_table->wins}}</td>
                                <td>{{$point_table->loss}}</td>
                                <td>{{$point_table->nr}}</td>
                                <td>{{$point_table->pts}}</td>
                                <td>
                                    @if ($point_table->nrr == 0 || is_null($point_table->nrr) || empty($point_table->nrr))
                                        -
                                    @else
                                        {{ $point_table->nrr }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
<!--</div>-->