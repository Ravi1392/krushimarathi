<section class="application-cta-get-started section">
    <div class="inner row-layout">
        <h2 class="application-cta-get-started-title">
            Sign up for our newsletter
        </h2>

        <form class="subscription-form" id="subscription-form">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="email" placeholder="Enter your email" id="subscriber-email" required />
            <button type="submit" class="button-56 button-yellow">Subscribe</button>
        </form>
        <div id="subscription-message"></div>
        <span style="margin-top: 20px;">*I accept Krushi Marathi <a href="{{url('/privacy-policy')}}" rel="noopener" target="_blank">privacy policy</a> and can unsubscribe at any time.</span>
    </div>
</section>