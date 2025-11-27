<div class="s-inner s-row-layout">
    <div class="s-top-row">
        <h2 class="s-application-cta-get-started-title">
            Sign up for our newsletter
        </h2>
        <form class="s-subscription-form" id="subscription-form">
            <div class="s-form-inputs">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input type="email" placeholder="Enter your email" id="subscriber-email" required="">
                <button type="submit" class="button-56 button-yellow">Subscribe</button>
            </div>
            <div id="subscription-message"></div>
            <div class="s-disclaimer">
                *I accept Krushi <a href="{{url('/privacy-policy')}}" rel="noopener" target="_blank">privacy policy</a> and can unsubscribe at any time.
            </div>
        </form>
    </div>
</div>