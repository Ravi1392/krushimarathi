<section class="section" style="background: url('{{ asset('public/assets/advertisement/images/home_banner.png') }}');
background-repeat: no-repeat;background-position: center;background-size: cover;padding: 15px 20px;border-radius: 0.8rem !important;text-align: center;">
    <div class="container">
        <h1 class="home-banner-title" style="color: #ffffff; font-weight: 700; font-size: 50px; line-height: 50px;">
            Welcome to <span style="color: #FCC000;">Krushi Marathi</span>
        </h1>
        <p style="color: #ffffff; font-size: 26px; line-height: 25px;">
            India’s Largest <span style="color: #FCC000;">Agriculture Marketplace</span>
        </p>
        <p style="color: #ffffff; font-size: 20px; line-height: 25px;">
            For <span style="color: #FCC000;">Farmers, Buyers, Sellers & Agri Businesses</span>
        </p>
        <p style="color: #ffffff; font-size: 20px; line-height: 25px;">
            <span style="color: #FCC000;">BUY, SELL & RENT</span> — All in One Platform
        </p>

        {{-- BUTTONS --}}
        <div style="margin-top: 30px;margin-bottom: 10px;">
            {{-- SELL NOW --}}
            <a class="postr" 
               href="{{ Auth::guard('customer')->check() ? route('ads.post-requirement') : route('ads.post-advertisement') }}" 
               title="Sell Product"
               style="background-color: #ffffff; color: #000; padding: 8px 8px; font-weight: bold; border-radius: 5px; text-decoration: none; margin-right: 15px;">
                SELL NOW
            </a>

            {{-- BUY NOW --}}
            <a class="postr" href="{{ url('/ads') }}" title="Buy Product"
               style="background-color: #FCC000; color: #000; padding: 8px 8px; font-weight: bold; border-radius: 5px; text-decoration: none; margin-right: 15px;">
                BUY NOW
            </a>

            {{-- REGISTER NOW (only if not logged in) --}}
            @if (!Auth::guard('customer')->check())
                <a class="postr" href="{{ route('ads.register') }}" title="Register or Login"
                   style="background-color: #28a745; color: #fff; padding: 8px 8px; font-weight: bold; border-radius: 5px; text-decoration: none;">
                    REGISTER NOW
                </a>
            @endif
        </div>
    </div>
</section>