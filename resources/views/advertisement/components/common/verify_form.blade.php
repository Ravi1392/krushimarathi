<div class="row d-flex justify-content-center align-items-center">
    <div class="col-xl-4">
        <div class="card" id="otpSection">
            <div class="card-header header-elements-inline">
                <h2 class="card-title">Verify OTP</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('ads.verifyOtp')}}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <b>Enter OTP <span style="color:red">*</span></b>
                            <div class="d-flex justify-content-center mt-2">
                                @for ($i = 1; $i <= 6; $i++)
                                    <input type="text" maxlength="1" class="form-control otp-input mr-2" id="otp{{ $i }}" name="otp[]" style="width: 50px; text-align: center; display: inline-block;" required>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a class="text-left" id="resend-otp-btn" href="#">{{ __('otp.resend_button') }}</a>
                        <button id="verifyOtpBtn" class="btn btn-success" style="float: right;">Verify OTP <i class="icon-check position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>