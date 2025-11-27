@push('custom-scripts')
   
 
@endpush
@push('custom-css')

@endpush

@extends('advertisement.layouts.common')      
@section('content')
    <!-- Content area -->
    <div class="content">

        <!-- Main charts -->
        <div class="row">
            <div class="col-xl-3">

            </div>
            <div class="col-xl-6">

                <!-- Traffic sources -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Traffic sources</h6>
                        <div class="header-elements">
                            <div class="form-check form-check-right form-check-switchery form-check-switchery-sm">
                                <label class="form-check-label">
                                    Live update:
                                    <input type="checkbox" class="form-input-switchery" checked data-fouc>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /traffic sources -->

            </div>

            <div class="col-xl-3">

            </div>
        </div>
        <!-- /main charts -->

    </div>
    <!-- /content area -->
@endsection
    