@php
    $privacyUrl = url('/privacy-policy');
@endphp
<section class="farm-split-cta-banner mb-3">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-7 text-center text-md-start mb-4 mb-md-0">
                <h3 class="farm-split-title mb-2">
                    <i class="bi bi-harvest me-2"></i> {{ __('extra_card.title') }}
                </h3>
                <p class="farm-split-text opacity-75 mb-0">
                    {{ __('extra_card.description') }}
                </p>
            </div>

            <div class="col-md-5">
                <form class="farm-split-form d-flex flex-column flex-sm-row justify-content-center align-items-stretch gap-3 subscription-form" id="subscription-form">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="email" class="form-control farm-split-input mr-3" placeholder="{{ __('extra_card.placeholder') }}" id="subscriber-email" required>
                    <button type="submit" class="btn farm-split-btn">{{ __('extra_card.subscribe') }}</button>
                </form>
                <div id="subscription-message" class="mt-3 text-center text-white"></div>
                <small class="farm-split-privacy-text d-block text-center mt-3">
                    {!! __('extra_card.privacy', ['url' => $privacyUrl]) !!}
                </small>
            </div>
        </div>
    </div>
</section>