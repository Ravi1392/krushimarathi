<div class="match-container" style="background-image: url('{{ asset("public/assets/front/images/ipl/ipl_banner.png") }}');">
    @if ($match)
            <div class="match-card">
                @if ($match->match_started == 0) <!-- Upcoming Match -->
                    <div class="custom-match-card-matches" style="cursor: pointer;">
                        <div class="custom-match-header" style="margin-bottom: 0px;padding-top: 0;">
                            <p>Indian Premier League, 2025, {{ ltrim(trim(strrchr($match->name, ',')), ',') }}</p>
                            <div class="status">
                                <span class="upcoming">UPCOMING</span>
                            </div>
                        </div>
                        <hr>
                        <div class="custom-teams-scores" style="padding-bottom: 0;">
                            <div class="team-row">
                                <div class="team-info">
                                    <div class="team-logo">
                                        <img src="{{$match->firstteam->img}}" alt="{{ $match->team1 }}">
                                    </div>
                                    <p>{{ $match->team1 }}</p>
                                </div>
                                <p>{{ Carbon\Carbon::parse($match->datetime_gmt)->format('D, d M') }}</p>
                            </div>
                            <div class="team-row">
                                <div class="team-info">
                                    <div class="team-logo">
                                        <img src="{{$match->secondteam->img}}" alt="{{ $match->team2 }}">
                                    </div>
                                    <p>{{ $match->team2 }}</p>
                                </div>
                                <p>{{ Carbon\Carbon::parse($match->datetime_gmt)->addHours(5)->addMinutes(30)->format('h:i A') }}</p>
                            </div>
                        </div>
                        <p class="custom-match-status">
                            Match Time {{ Carbon\Carbon::parse($match->datetime_gmt)->addHours(5)->addMinutes(30)->format('H:i') }} IST 
                            ({{ Carbon\Carbon::parse($match->datetime_gmt)->format('H:i') }} GMT)
                        </p>
                    </div>
                @elseif ($match->match_started == 1 && $match->match_ended == 0) <!-- Live Match -->
                    <div class="custom-match-card-matches" style="cursor: pointer;">
                        <div class="custom-match-header" style="margin-bottom: 0px;padding-top: 0;">
                            <p>Indian Premier League, 2025, {{ ltrim(trim(strrchr($match->name, ',')), ',') }}</p>
                            <div class="status">
                                <span class="live">LIVE</span>
                                <img src="{{asset('/public/assets/front/images/ipl/hotspot.gif')}}" style="max-width: 30px;">
                            </div>
                        </div>
                        <hr style="margin: 0px;">
                        <div class="custom-teams-scores px-2 pt-2">
                            @php
                                $team1Score = $match->scores->firstWhere('inning', $match->team1 . ' Inning 1');
                                $team2Score = $match->scores->firstWhere('inning', $match->team2 . ' Inning 1');
                                $scoreCount = $match->scores->count();
                            @endphp

                            @if ($scoreCount === 0)
                                <div class="team-row">
                                    <div class="team-info">
                                        <div class="team-logo">
                                            <img src="{{ $match->firstteam->img }}" alt="{{ $match->team1 }}">
                                        </div>
                                        <p class="m-0 p-0 text-white">{{ $match->team1 }}</p>
                                    </div>
                                    <p class="m-0 p-0 text-white">Yet to bat</p>
                                </div>
                                <div class="team-row">
                                    <div class="team-info">
                                        <div class="team-logo">
                                            <img src="{{ $match->secondteam->img }}" alt="{{ $match->team2 }}">
                                        </div>
                                        <p class="m-0 p-0 text-white">{{ $match->team2 }}</p>
                                    </div>
                                    <p class="m-0 p-0 text-white">Yet to bat</p>
                                </div>
                            @elseif ($scoreCount === 1)
                                @if (isset($team1Score) && $team1Score->inning == ($match->team1 . ' Inning 1'))
                                    <div class="team-row">
                                        <div class="team-info">
                                            <div class="team-logo">
                                                <img src="{{ $match->firstteam->img }}" alt="{{ $match->team1 }}">
                                            </div>
                                            <p class="m-0 p-0 text-white">{{ $match->team1 }}</p>
                                        </div>
                                        <p class="m-0 p-0 text-white">{{ $team1Score ? "{$team1Score->runs}/{$team1Score->wickets} ({$team1Score->overs})" : "Yet to bat" }}</p>
                                    </div>
                                    <div class="team-row">
                                        <div class="team-info">
                                            <div class="team-logo">
                                                <img src="{{ $match->secondteam->img }}" alt="{{ $match->team2 }}">
                                            </div>
                                            <p class="m-0 p-0 text-white">{{ $match->team2 }}</p>
                                        </div>
                                        <p class="m-0 p-0 text-white">{{ $team2Score ? "{$team2Score->runs}/{$team2Score->wickets} ({$team2Score->overs})" : "Yet to bat" }}</p>
                                    </div>
                                @elseif (isset($team2Score) && $team2Score->inning == ($match->team2 . ' Inning 1'))
                                    <div class="team-row">
                                        <div class="team-info">
                                            <div class="team-logo">
                                                <img src="{{ $match->secondteam->img }}" alt="{{ $match->team2 }}">
                                            </div>
                                            <p class="m-0 p-0 text-white">{{ $match->team2 }}</p>
                                        </div>
                                        <p class="m-0 p-0 text-white">{{ $team2Score ? "{$team2Score->runs}/{$team2Score->wickets} ({$team2Score->overs})" : "Yet to bat" }}</p>
                                    </div>
                                    <div class="team-row">
                                        <div class="team-info">
                                            <div class="team-logo">
                                                <img src="{{ $match->firstteam->img }}" alt="{{ $match->team1 }}">
                                            </div>
                                            <p class="m-0 p-0 text-white">{{ $match->team1 }}</p>
                                        </div>
                                        <p class="m-0 p-0 text-white">{{ $team1Score ? "{$team1Score->runs}/{$team1Score->wickets} ({$team1Score->overs})" : "Yet to bat" }}</p>
                                    </div>
                                @endif
                            @elseif ($scoreCount === 2)
                                @foreach ($match->scores as $score)
                                    <div class="team-row">
                                        <div class="team-info">
                                            <div class="team-logo">
                                                <img src="{{ $score->inning == ($match->team1 . ' Inning 1') ? $match->firstteam->img : $match->secondteam->img }}" alt="{{ $score->inning }}" class="w-100 h-100">
                                            </div>
                                            <p class="m-0 p-0 text-white">{{ str_replace(' Inning 1', '', $score->inning) }}</p>
                                        </div>
                                        <p class="m-0 p-0 text-white">{{ $score->runs }}/{{ $score->wickets }} ({{ $score->overs }})</p>
                                    </div>
                                @endforeach
                            @endif
                               
                            @if ($match->scores->isEmpty())
                                <p class="text-center">No scores available yet</p>
                            @endif
                        </div>
                        <p class="custom-match-status" style="background: rgba(255, 255, 255, 0.1); color: rgb(255, 255, 255);">{{ $match->status }}</p>
                    </div>
                @elseif ($match->match_started == 1 && $match->match_ended == 1) <!-- Complete Match -->
                    <div class="custom-match-card-matches" style="cursor: pointer;">
                        <div class="custom-match-header" style="margin-bottom: 0px;padding-top: 0;">
                            <p>Indian Premier League, 2025, {{ ltrim(trim(strrchr($match->name, ',')), ',') }}</p>
                            <div class="status">
                                <span class="upcoming">COMPLETE</span>
                            </div>
                        </div>
                        <hr style="margin: 0px;">
                        <div class="custom-teams-scores px-2 pt-2">
                            
                            @foreach ($match->scores as $score)
                                <div class="team-row">
                                    <div class="team-info">
                                        <div class="team-logo">
                                            <img src="{{ $score->inning == ($match->team1 . ' Inning 1') ? $match->firstteam->img : $match->secondteam->img }}" alt="{{ $score->inning }}" class="w-100 h-100">
                                        </div>
                                        <p class="m-0 p-0 text-white">{{ str_replace(' Inning 1', '', $score->inning) }}</p>
                                    </div>
                                    <p class="m-0 p-0 text-white">{{ $score->runs }}/{{ $score->wickets }} ({{ $score->overs }})</p>
                                </div>
                            @endforeach
                            @if ($match->scores->isEmpty())
                                <p class="text-center">No scores available yet</p>
                            @endif
                        </div>
                        <p class="custom-match-status" style="background: rgba(255, 255, 255, 0.1); color: rgb(255, 255, 255);">{{ $match->status }}</p>
                    </div>
                @endif
            </div>
        @else
            <p class="text-center">No matches scheduled for today.</p>
        @endif
    <div class="center-section">
        <div class="logo-container">
            <img src="{{asset('/public/assets/front/images/ipl/ipl_2025.png')}}" alt="IPL Logo">
        </div>
        <div class="button-group">
            <a href="{{url('/hindi/ipl-2025')}}">
                <button>IPL News<span class="custom-external-link">↗</span></button>
            </a>
            <a href="{{url('/points-table')}}">
                <button>Points Table<span class="custom-external-link">↗</span></button>
            </a>
            <a href="{{url('/schedule')}}">
                <button>Schedule <span class="custom-external-link">↗</span></button>
            </a>
        </div>
    </div>
    <div class="points-table">
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
</div>