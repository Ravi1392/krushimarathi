@push('custom-scripts')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/visualization/d3/d3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/js/pages/dashboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/ui/ripple.min.js')}}"></script>

    <script src="{{asset('public/assets/admin/js/plugins/visualization/echarts/echarts.min.js')}}"></script>
    <!-- /theme JS files -->

<script>
    const dynamicPieChartData = @json($pieChartData);
    function renderPieChart() {
        const chartElement = document.getElementById('pie_basic');
        const messageElement = document.getElementById('chart-message');

        if (!chartElement) {
            console.error('Chart container #pie_basic not found.');
            if (messageElement) {
                messageElement.innerHTML = '<p class="error-message">Chart container not found.</p>';
            }
            return;
        }

        if (!dynamicPieChartData || !Array.isArray(dynamicPieChartData) || dynamicPieChartData.length === 0) {
            console.warn('No data provided for the pie chart.');
            if (messageElement) {
                messageElement.innerHTML = '<p class="error-message">No data available to display.</p>';
            }
            return;
        }

        try {
            if (echarts.getInstanceByDom(chartElement)) {
                echarts.dispose(chartElement);
            }

            const chart = echarts.init(chartElement);

            const validData = dynamicPieChartData.filter(item =>
                item && typeof item.name === 'string' && typeof item.value === 'number' && item.value > 0
            );

            if (validData.length === 0) {
                console.warn('All chart data is invalid or zero.');
                if (messageElement) {
                    messageElement.innerHTML = '<p class="error-message">No valid data to display.</p>';
                }
                return;
            }

            const chartTitle = validData[0]?.name || validData[0]?.name || 'Statistics';
            const isMobile = window.innerWidth < 768;

            const option = {
                tooltip: {
                    trigger: 'item',
                    formatter: function (params) {
                        const views = params.data.views ?? 0;
                        return `${params.name} : ${params.value}<br/> Views : ${views}`;
                    }
                },
                legend: {
                    orient: isMobile ? 'horizontal' : 'vertical',
                    bottom: isMobile ? 0 : undefined,
                    left: isMobile ? 'center' : 'left',
                    formatter: function (name) {
                        // Find the matching item from the data
                        const item = validData.find(i => i.name === name);
                        if (item) {
                            return `${item.name}: ${item.value} (Views: ${item.views ?? 0})`;
                        }
                        return name;
                    }
                },
                series: [
                    {
                        name: chartTitle, // 👈 DYNAMIC series name!
                        type: 'pie',
                        radius: '50%',
                        data: validData,
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };

            chart.setOption(option);

            window.addEventListener('resize', () => {
                chart.resize();
            });

        } catch (error) {
            console.error('Chart rendering error:', error);
            if (messageElement) {
                messageElement.innerHTML = '<p class="error-message">Error rendering chart: ' + error.message + '</p>';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', renderPieChart);
</script>

   
@endpush
@push('custom-css')
    <link href="{{asset('public/assets/admin/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/admin/css/dashboard_custome.css')}}" rel="stylesheet" type="text/css">
@endpush 
@extends('Admin.layouts.common')      
    @section('content')
        <!-- Content area -->
        <div class="content">

            <div class="row text-center">
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#ec407a">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$category_count->total_categories > 0 ? $category_count->total_categories : 0}}</h5>
                                <h4 class="opacity-100">Categories</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#ff7043">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$subCategory_count->total_subcategories > 0 ? $subCategory_count->total_subcategories : 0}}</h5>
                                <h4 class="opacity-100">Sub Categories</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#26a69a">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-blog mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$blogStatistics->total_blogs > 0 ? $blogStatistics->total_blogs : 0}}</h5>
                                <h4 class="opacity-100">Blogs</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#ec407a">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$specialCategory_count->total_specialcategories > 0 ? $specialCategory_count->total_specialcategories : 0}}</h5>
                                <h4 class="opacity-100">Special Categories</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#66bb6a">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$category_count->total_category_views > 0 ? $category_count->total_category_views : 0}}</h5>
                                <h4 class="opacity-100">Category Visitors</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#ef5350">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$subCategory_count->total_subcategory_views > 0 ? $subCategory_count->total_subcategory_views : 0}}</h5>
                                <h4 class="opacity-100">Sub Category Visitors</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#7986cb">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-point-up mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$blogStatistics->total_blog_views > 0 ? $blogStatistics->total_blog_views : 0}}</h5>
                                <h4 class="opacity-100">Blog Visitors</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#66bb6a">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$specialCategory_count->total_specialcategories > 0 ? $specialCategory_count->total_specialcategory_views : 0}}</h5>
                                <h4 class="opacity-100">Special Category Visitors</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#ff7043">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$footerCategory_count->total_footercategories > 0 ? $footerCategory_count->total_footercategories : 0}}</h5>
                                <h4 class="opacity-100">Footer Categories</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#29b6f6">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$webStoriesStatistics->total_stories > 0 ? $webStoriesStatistics->total_stories : 0}}</h5>
                                <h4 class="opacity-100">Web stories</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#29b6f6">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalCountry->total_countries > 0 ? $totalCountry->total_countries : 0}}</h5>
                                <h4 class="opacity-100">Countries</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#29b6f6">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalState->total_states > 0 ? $totalState->total_states : 0}}</h5>
                                <h4 class="opacity-100">States</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#ef5350">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$footerCategory_count->total_footercategory_views > 0 ? $footerCategory_count->total_footercategory_views : 0}}</h5>
                                <h4 class="opacity-100">Footer Category Visitors</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#8d6e63">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$webStoriesStatistics->total_story_views > 0 ? $webStoriesStatistics->total_story_views : 0}}</h5>
                                <h4 class="opacity-100">Web Story Visitors</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#8d6e63">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalCountry->total_country_views > 0 ? $totalCountry->total_country_views : 0}}</h5>
                                <h4 class="opacity-100">Country Views</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#8d6e63">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalState->total_state_views > 0 ? $totalState->total_state_views : 0}}</h5>
                                <h4 class="opacity-100">State Views</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#ff7043">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalDistrict->total_districts > 0 ? $totalDistrict->total_districts : 0}}</h5>
                                <h4 class="opacity-100">Districts</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#29b6f6">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalTaluka->total_talukas > 0 ? $totalTaluka->total_talukas : 0}}</h5>
                                <h4 class="opacity-100">Talukas</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#29b6f6">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalVillage->total_villages > 0 ? $totalVillage->total_villages : 0}}</h5>
                                <h4 class="opacity-100">Villages</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#29b6f6">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$profilepoliticians->total_profiles > 0 ? $profilepoliticians->total_profiles : 0}}</h5>
                                <h4 class="opacity-100">Profiles</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#ef5350">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-pencil4 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalDistrict->total_district_views > 0 ? $totalDistrict->total_district_views : 0}}</h5>
                                <h4 class="opacity-100">District Views</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#8d6e63">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalTaluka->total_taluka_views > 0 ? $totalTaluka->total_taluka_views : 0}}</h5>
                                <h4 class="opacity-100">Taluka Views</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#8d6e63">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$totalVillage->total_village_views > 0 ? $totalVillage->total_village_views : 0}}</h5>
                                <h4 class="opacity-100">Villages Views</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-body bg-pink-400" style="background-color:#8d6e63">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                               <i class="icon-images3 mr-3 icon-2x"></i>
                            </div>
        
                            <div class="media-body">
                                <h5 class="font-weight-semibold mb-0">{{$profilepoliticians->total_profile_views > 0 ? $profilepoliticians->total_profile_views : 0}}</h5>
                                <h4 class="opacity-100">Profile Views</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <div class="chart-container" style="display: flex; flex-wrap: wrap; gap: 1rem;">
                        <div id="pie_basic" style="flex: 1 1 300px; min-width: 250px; height: 400px;"></div>
                        <div id="chart-message"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-decoration: underline">Category Data</h3>
                </div>

                <div class="card-body">
                    <div class="card card-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Category Views</th>
                                    <th>Sub Category Count</th>
                                    <th>Blog Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($categories_data) && !empty($categories_data))
                                    @foreach ($categories_data as $category_data)
                                        <tr>
                                            <td>
                                                <b>{{$category_data->name}}</b>
                                            </td>
                                            <td>
                                                {{$category_data->views}}
                                            </td>
                                            <td>
                                                {{$category_data->sub_categories_count}}
                                            </td>
                                            <td>
                                                {{$category_data->blogs_count}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-decoration: underline">Sub Category Data</h3>
                </div>

                <div class="card-body">
                    <div class="card card-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Sub Category Views</th>
                                    <th>Blog Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($subCategories_data) && !empty($subCategories_data))
                                    @foreach ($subCategories_data as $subCategory_data)
                                        <tr>
                                            <td>
                                                <b>{{$subCategory_data->category->name}}</b>
                                            </td>
                                            <td>
                                                {{$subCategory_data->name}}
                                            </td>
                                            <td>
                                                {{$subCategory_data->views}}
                                            </td>
                                            <td>
                                                {{$subCategory_data->blogs_count}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                
            {{-- most popullar blogs and low popular blogs list --}}
            
            <div class="card">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-decoration: underline">Most Popular Blog Data</h3>
                </div>

                <div class="card-body">
                    <div class="card card-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Views</th>
                                    <th>Blog Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($mostViewedBlogs) && !empty($mostViewedBlogs))
                                @foreach ($mostViewedBlogs as $mostViewedBlog)
                                    <tr>
                                        <td>
                                            <b>{{$mostViewedBlog->category->name}}</b>
                                        </td>
                                        <td>
                                            {{$mostViewedBlog->views}}
                                        </td>
                                        <td>
                                            {{$mostViewedBlog->blog_title}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-decoration: underline">Low Popular Blog Data</h3>
                </div>

                <div class="card-body">
                    <div class="card card-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Views</th>
                                    <th>Blog Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($lowViewedBlogs) && !empty($lowViewedBlogs))
                                    @foreach ($lowViewedBlogs as $lowViewedBlog)
                                        <tr>
                                            <td><b>{{$lowViewedBlog->category->name}}</b>
                                            </td>
                                            <td>
                                                {{$lowViewedBlog->views}}
                                            </td>
                                            <td>
                                                {{$lowViewedBlog->blog_title}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                
            
    @endsection
    