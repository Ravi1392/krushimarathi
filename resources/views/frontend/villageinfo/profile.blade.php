@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => "{$profile->name} - Krushi Marathi",
        'description' => "Explore detailed profiles of political leaders including their career milestones, educational background, and contributions to rural development.",
        'canonical' => Request::url(),
        'type' => 'article',
        'data1' => "Krushi Marathi",
        'updated_time' =>  now()->toIso8601String(),
        'published_time'=> now()->toIso8601String(),
        'modified_time' => now()->toIso8601String()
    ])
@endpush

@push('custom-search_script')

@endpush

@push('custom-scripts')
    <link href="{{ config('constants.CDN_BASE') }}/front/css/villageinfo/stylehome.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div id="page" class="site grid-container container hfeed">
        {{-- <div class="row1" style="height: auto !important;margin-top: 20px;">
            <div class="col-md-12" style="height: auto !important;">
                @if (session('error') == true)
                    @include('frontend.components.success_error_msg',['msg_value' => session('msg_value'), 'msg' => session('msg')])
                @endif
            </div>
        </div> --}}
        <div class="row1 padding_set" style="margin-top: 10px;">
            <div class="col-md-12">
                <div class="bg-w card_radius">
                    <div class="dmprof-dtls-cntr ">
                        <div class="dm-prof-icon">
                            <img src="{{$profile->photo}}" alt="{{$profile->name}},{{$profile->name}}" title="{{$profile->name}}">
                        </div>
                        <h2 class="dm-name">{{$profile->name}} ({{$profile->local_name}})</h2>
                        <div class="dmprof-details">
                            <ul>
                                @if ($profile->profileposition->position_name)
                                    <li><strong>Position Name: </strong><span class="break-all">{{$profile->profileposition->position_name ?? "NA"}}</span></li>
                                @endif

                                <li>
                                    <strong>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>Status:
                                    </strong>
                                    @if ($profile->status == "current")
                                        Current
                                    @else
                                        Old
                                    @endif
                                </li>

                                @if ($profile->dob)
                                    <li><strong>Date Of Birth: </strong>{{ date('j M Y', strtotime($profile->dob)) }}</li>
                                @endif

                                @if ($profile->dod)
                                    <li><strong>Date Of Death: </strong>{{ date('j M Y', strtotime($profile->dod)) }}</li>
                                @endif

                                @if ($profile->place_of_birth)
                                    <li><strong>Birth Place: </strong>{{$profile->place_of_birth ?? "NA"}}</li>
                                @endif

                                @if ($profile->place_of_death)
                                    <li><strong>Death Place: </strong>{{$profile->place_of_death ?? "NA"}}</li>
                                @endif
                                
                                @if ($profile->email)
                                    <li><strong>Email: </strong>{{$profile->email ?? "NA"}}</li>
                                @endif

                                @if ($profile->contact)
                                    <li><strong>Contact: </strong>{{$profile->contact ?? "NA"}}</li>
                                @endif
                                
                                @if ($profile->address)
                                    <li><strong>Address: </strong>{{$profile->address ?? "NA"}}</li>
                                @endif

                                @if ($profile->education)
                                    <li class="dm-address-single"><strong>Education: </strong>{{$profile->education ?? "NA"}}</li>
                                @endif
                                
                                @if ($profile->spouse)
                                    <li class="dm-address-single"><strong>Spouse: </strong>{{$profile->spouse ?? "NA"}}</li>
                                @endif

                                @if ($profile->childrens)
                                    <li class="dm-address-single"><strong>Childrens: </strong>{{$profile->childrens ?? "NA"}}</li>
                                @endif

                                @if ($profile->service)
                                    <li><strong>Service: </strong><span class="break-all">{{$profile->service ?? "NA"}}</span></li>
                                @endif

                                @if ($profile->bio)
                                    <li><strong>Bio: </strong><span class="break-all">{{$profile->bio ?? "NA"}}</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row1 padding_set" style="margin-top: 10px;">
            <div class="col-md-12">
                <div class="bg-w card_radius">
                    <h2 class="archive-heading" style="font-size: 24px;margin-bottom: 10px;"><strong>Political Career Overview</strong></h2>
                    <hr>
                    <figure class="wp-block-table" style="overflow-x: auto; max-width: 100%;">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th><strong>Status</strong></th>
                                    <th><strong>Position Name</strong></th>
                                    <th><strong>Party Name</strong></th>
                                    <th><strong>Constituency Name</strong></th>
                                    <th><strong>From Date</strong></th>
                                    <th><strong>To Date</strong></th>
                                    <th><strong>Portfolio</strong></th>
                                </tr>
                                @if (isset($profile->profilepoliticians) && !empty($profile->profilepoliticians) && $profile->profilepoliticians->count())
                                    @foreach ($profile->profilepoliticians as $data)
                                        <tr>
                                            <td>
                                                @if ($data->status == "current")
                                                    <b>Current</b>
                                                @else
                                                    Old
                                                @endif
                                            </td>
                                            <td>{{$data->mr_name ?? "NA"}}</td>
                                            <td>{{$data->party ?? "NA"}}</td>
                                            <td>{{$data->constituency ?? "NA"}}</td>
                                            <td>{{ date('j M Y', strtotime($data->from_date)) }}</td>
                                            <td>
                                                @if ($data->status == "current")
                                                    Current
                                                @else
                                                    {{ date('j M Y', strtotime($data->to_date)) }}
                                                @endif
                                            </td>
                                            <td>{{$data->portfolio ?? "NA"}}</td>
                                            
                                        </tr>
                                    @endforeach
                                    
                                @else
                                    <tr>
                                        <td colspan="5">Political Career data not found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </figure>
                </div>
            </div>
        </div>
        
        @if(!$blogs_for_row->isEmpty())
            <div id="content" class="site-content section-padding">
                <div class="section sdn_sectionAbout main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="container">
                            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;font-size:24px;">Related Blogs</h2>
                            <hr style="margin-bottom: 12px;margin-top: 10px;">
                            <div class="xpress_articleList">
                                @include('frontend.components.other_blogs_row', ['blogs' => $blogs_for_row])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Left Side 160x600 Ad -->
        <div class="gutter-ad left">
           @include('frontend.Adsence.village_sticky_ad_1')
        </div>
    
        <!-- Right Side 160x600 Ad -->
        <div class="gutter-ad right">
            @include('frontend.Adsence.village_sticky_ad_2')
        </div>
    </div>
@endsection