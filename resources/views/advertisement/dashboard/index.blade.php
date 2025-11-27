@extends('advertisement.layouts.common')   

@push('custom-scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //OTP fill text box logic
    $(document).ready(function () {
        $('.otp-input').on('input', function () {
            var input = $(this);
            var value = input.val();

            // Allow only 1 character and move to next
            if (/^[a-zA-Z0-9]$/.test(value)) {
                input.val(value.toUpperCase()); // Optional: force uppercase
                input.next('.otp-input').focus();
            } else {
                input.val(''); // Clear if not valid
            }
        });

        $('.otp-input').on('keydown', function (e) {
            var input = $(this);

            // Move to previous input on Backspace if current is empty
            if (e.key === "Backspace" && input.val() === '') {
                input.prev('.otp-input').focus();
            }
        });
    });

    //Resend OTP
     $('#resend-otp-btn').click(function () {
        $('#product_detail_loader').show();
        $.ajax({
            url: "{{ route('ads.resendOtp') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                if (res.status === 'success') {
                    toastr.success(res.message);
                } else {
                    toastr.error(res.message);
                }
                $('#product_detail_loader').hide();
            },
            error: function (xhr) {
                if (xhr.status === 401) {
                    toastr.error(`{{ __('otp.login_required') }}`);
                } else {
                    toastr.error(`{{ __('otp.resend_error') }}`);
                }
                $('#product_detail_loader').hide();
            }
        });
    });
</script>

 
@endpush
@push('custom-css')
<link href="{{asset('public/assets/advertisement/css/loader.css')}}" rel="stylesheet" type="text/css">
@endpush
   
@section('content')
    <!-- Content area -->
    <div class="content">
        @if (Auth::guard('customer')->check())
            @php
                $customer = Auth::guard('customer')->user();
                $status = $customer->status;
            @endphp
            
            @if ($status == "Pending")
                <div class="alert alert-warning alert-styled-left alert-dismissible">
                    {!! __('common.registration_notice') !!}
                </div>
                @include('advertisement.components.common.verify_form', ['email' => $customer->email])
            @else
                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-3"></div>
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
                    <div class="col-xl-3"></div>
                </div>
                <!-- /main charts -->
            @endif
        @endif
    </div>
    <!-- /content area -->
@endsection
    