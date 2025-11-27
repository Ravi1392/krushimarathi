@extends('frontend.layout.common')


@push('custom-meta')
    @include('frontend.components.home_meta',
        [
            'title' => $spec_category_info->name .' '."| Krushi Marathi", 
            'description' => $spec_category_info->meta_description,
            'canonical' => Request::url(),
            'type' => 'website',
            'data1' =>  config('constants.user_name'),
            'updated_time' =>  $spec_category_info->content_updated_at->toIso8601String(),
            'published_time' => $spec_category_info->content_updated_at->toIso8601String(),
            'modified_time' => $spec_category_info->content_updated_at->toIso8601String()
        ])
@endpush

@push('custom-css')
    <link href="{{ config('constants.CDN_BASE') }}/front/css/more_for_u_card.css" rel="stylesheet" type="text/css">
    <style>
       .container {
            animation: slideUp 1s ease-out;
        }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .section h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: #2c6e49;
            text-align: center;
            margin-bottom: 15px;
            position: relative;
        }
        .section h1::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 4px;
            background: #ff6f61;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            animation: pulse1 2s infinite;
        }
        @keyframes pulse1 {
            0% { width: 50px; }
            50% { width: 60px; }
            100% { width: 50px; }
        }

        .subtitle {
            color: #555;
            font-size: 1.1rem;
            text-align: center;
            margin-bottom: 30px;
            opacity: 0;
            animation: fadeIn 1.5s ease-in 1s forwards;
        }
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        #ai-form {
            text-align: center;
        }
        .ai-form {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            animation: bounceIn 1s ease-out;
        }
        @keyframes bounceIn {
            0% { transform: scale(0.9); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }
        #ai-form textarea {
            width: 75%;
            min-height: 150px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            resize: vertical;
            transition: border-color 0.3s ease;
        }
        #ai-form textarea:focus {
            border-color: #2c6e49;
            outline: none;
        }
        #ai-form button {
            padding: 10px 30px;
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(45deg, #ff6f61, #ff8a65);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 75%;
            margin: 10px 0 20px 0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
            overflow: hidden;
            align-items: center;
        }
        #ai-form button::after {
            content: '';
            position: absolute;
            width: 0;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            top: 0;
            left: -100%;
            transition: all 0.4s ease;
        }
        #ai-form button:hover::after {
            width: 100%;
            left: 0;
        }
        #ai-form button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 111, 97, 0.4);
        }

        .output-section {
            text-align: left;
            display: none;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            animation: slideDown 0.8s ease-out;
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .output-box {
            line-height: 1.8;
            color: #444;
        }

        .output-box h1,
        .output-box h2,
        .output-box h3,
        .output-box h4,
        .output-box h5,
        .output-box h6 {
            color: #2c3e50;
            font-weight: 600;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        .output-box h1 { font-size: 2.2rem; }
        .output-box h2 { font-size: 1.8rem; }
        .output-box h3 { font-size: 1.5rem; }
        .output-box h4 { font-size: 1.2rem; }

        .output-box p {
            margin-bottom: 15px;
        }

        .output-box ul,
        .output-box ol {
            margin-bottom: 0px;
        }

        .output-box ul {
            list-style-type: disc;
        }

        .output-box li {
            margin-bottom: 5px;
        }

        .output-box b {
            color: #e74c3c;
        }

        .output-box i {
            color: #3498db;
        }

        .output-box hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        .loading-animation {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        .output-box ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .output-box h1, .output-box h2, .output-box h3, .output-box h4, .output-box h5, .output-box h6 {
            list-style-type: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loader {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 150px;
            color: #2c6e49;
            font-size: 1.2rem;
            animation: pulseText 1.5s infinite;
        }

        @keyframes pulseText {
            0% { opacity: 0.6; }
            50% { opacity: 1; }
            100% { opacity: 0.6; }
        }

        .loader::after {
            content: '';
            width: 40px;
            height: 40px;
            border: 4px solid #2c6e49;
            border-top: 4px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }

        @media (max-width: 600px) {
            .section h1 {
                font-size: 2.2rem;
            }
            .subtitle {
                font-size: 1rem;
            }
            #ai-form textarea {
                width: 100%;
                min-height: 125px;
                font-size: 0.9rem;
            }
            #ai-form button {
                width: 100%;
                font-size: 1.1rem;
            }
        }
        
        @media (max-width: 768px) {
            .desktop-only {
                display: none !important;
            }
        }
    </style>
@endpush

@push('custom-scripts')
    <script src="{{ config('constants.CDN_BASE') }}/front/js/jquery-3.6.0.min.js" ></script>
    <script>
        document.getElementById('ai-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const questionInput = document.getElementById('questionInput');
            const submitBtn = document.getElementById('submitBtn');
            const generatedContent = document.getElementById('generatedContent');
            const loader = document.getElementById('loader');
            const outputSection = document.getElementById('outputSection');
            
            const question = questionInput.value.trim();
            if (question === '') {
                alert('Please type your question.');
                return;
            }

            submitBtn.innerHTML = 'I am processing for your request...';
            submitBtn.disabled = true;
            loader.style.display = 'flex';
            generatedContent.style.display = 'none';
            outputSection.style.display = 'block';

            $.ajax({
                url: "{{ route('generate-answer') }}",
                method: 'POST',
                data: {
                    question: question,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        generatedContent.innerHTML = response.answer;
                    } else {
                        generatedContent.innerHTML = response.message || 'Sorry, we could not fetch the answer. Please try again.';
                    }
                },
                error: function(xhr, status, error) {
                    //console.error('AJAX Error:', error);
                    const errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Oops! Something went wrong. Please try again later.';
                    generatedContent.innerHTML = errorMessage;
                },
                complete: function() {
                    loader.style.display = 'none';
                    generatedContent.style.display = 'block';
                    submitBtn.innerHTML = 'Get Answer';
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
@endpush

@push('ads-script')

    <!--sidebar_ad_code-->
    <script>
        window.googletag = window.googletag || { cmd: [] };
        googletag.cmd.push(function () {
    
        const REFRESH_KEY = 'refresh';
        const REFRESH_VALUE = 'true';
        const SECONDS_TO_WAIT_AFTER_VIEWABILITY = 30;
        
        var mapping = googletag.sizeMapping()
            .addSize([1024, 0], [[728, 90], [970, 90]]) // Desktop
            .addSize([768, 0], [[468, 60], [320, 100]]) // Tablet
            .addSize([0, 0], [[300, 250], [320, 100], [320, 50]]) // Mobile
            .build();
        
        //-------------Top Ad------------------
        googletag.defineSlot('/23289270189/bajarbhav_ad_top', [[728, 90], [300, 250], [320, 50], [300, 100]], 'div-gpt-ad-1758342315505-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
    
        // --- Blog View Ad 3 ---
        googletag.defineSlot('/23289270189/blog_view_ads_4', [[728, 90], [320, 250], [300, 100], [300, 75], [250, 250], [300, 50]], 'div-gpt-ad-1758108473622-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
    
        // Enable Single Request and Collapse Empty Divs
        googletag.pubads().enableSingleRequest();
        // googletag.pubads().collapseEmptyDivs();
    
        // Auto-refresh after viewable
        googletag.pubads().addEventListener('impressionViewable', function (event) {
          const slot = event.slot;
          if (slot.getTargeting(REFRESH_KEY).indexOf(REFRESH_VALUE) > -1) {
            setTimeout(function () {
              googletag.pubads().refresh([slot]);
            }, SECONDS_TO_WAIT_AFTER_VIEWABILITY * 1000);
          }
        });
    
        googletag.enableServices();
      });
    </script>
@endpush

@push('custom-search_script')

@endpush

@section('content')
    <div id="page" class="site grid-container container hfeed">
        
        <div style="padding-top: 15px;padding-left: 10px;">
            @include('frontend.Ads.bajarbhav_ad_top')
        </div>

        <div class="section section--alt new-card-shadow" style="padding-bottom: 10px;">
            <div class="sectionWrapper">
                <div class="container">
                    <h1>KrushiTech AI ✨</h1>
                    <p class="subtitle">Share your farm or crop concerns and get instant AI-powered solutions.</p>

                    <form id="ai-form">
                        <textarea id="questionInput" name="question" placeholder="For example: How to manage pests on wheat? Improve yield in dry fields?"></textarea>
                        <button type="submit" id="submitBtn">
                            <i class="fas fa-arrow-right"></i> Get Answer <i class="fas fa-rocket"></i></button>
                        </button>
                    </form>

                    <div class="output-section" id="outputSection" style="padding-bottom: 0px;">
                        <div class="loader" id="loader"></div>
                        <div class="output-box" id="generatedContent">
                            Your answer will appear here.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('frontend.components.more_for_u_card_en')
        
        @include('frontend.Ads.blog_view_ads_2')
        
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow">
                <div class="sectionWrapper">
                    <div class="sectionTitlebar sectionTitlebar--hasCta block">
                        <h2 class="sectionTitle archive-heading">KrushiTech AI: Your AI-Powered Farming Expert for Crop, Soil, and Livestock Guidance</h2>
                    </div>
                    <div class="container">
                        <div class="content-area" id="primary">
                            <div class="inside-article">
                                <div class="entry-content" itemprop="text">
                                    <p><strong>KrushiTech AI</strong> is an advanced <strong>Artificial Intelligence (AI) platform</strong> designed specifically for farmers. Its primary goal is to provide accurate information, expert advice, and actionable guidance for agriculture-related challenges. In today&rsquo;s modern farming landscape, leveraging technology is essential for achieving high yields and sustainable success. <strong>KrushiTech AI</strong> empowers farmers with timely insights, enabling them to make informed decisions and improve overall productivity.</p>
                                    
                                    <h2 class="archive-heading">What is KrushiTech AI?</h2>
                                    
                                    <p><strong>KrushiTech AI</strong> is a digital platform where farmers can ask questions about crops, soil, and livestock and receive instant AI-powered solutions. The platform offers guidance on <strong>crop management, pest and disease control, soil health, and other critical agricultural topics</strong>. Its core purpose is to deliver the right information at the right time, helping farmers optimize their decision-making and farm operations.</p>
    
                                    <h2 class="archive-heading">Benefits of KrushiTech AI</h2>
                                    
                                    <ul>
                                        <li>
                                            <p></p> 
                                                <strong>Instant Solutions:</strong>
                                                Farmers get immediate answers and actionable solutions, saving time and preventing crop loss.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Expert Guidance:</strong>
                                                Built on the knowledge of agricultural experts, ensuring accurate and trustworthy information.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Comprehensive Coverage:</strong>
                                                Offers insights on crop cultivation, fertilizer management, irrigation, pest control, and more.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Multilingual Support:</strong> Get information in your language on this <strong>multi-language platform</strong>, making guidance accessible to all farmers.
                                            </p>
                                        </li>
                                        <li>
                                            <p><strong>Time-Saving:</strong>
                                                Eliminates the need to search extensively or consult multiple advisors; all guidance is centralized.
                                            </p>
                                        </li>
                                        <li>
                                            <p><strong>Cost-Effective:</strong>
                                                Often more affordable than traditional advisory services, without compromising quality.
                                            </p>
                                        </li>
                                        <li>
                                            <p><strong>Updated Information:</strong>
                                                Continuously updated with the latest research, farming techniques, and best practices.
                                            </p>
                                        </li>
                                    </ul>
    
                                    @include('frontend.Adsence.home_page_ads_1')
    
                                    <h2 class="archive-heading">How KrushiTech AI Works</h2>
                                    
                                    <ul>
                                        <li>
                                            <p>
                                                <strong>Ask a Question:</strong>
                                                Farmers type their queries about crops, soil, or livestock. For example:
                                            </p>
    
                                            <ol>
                                                <li>
                                                    <p>
                                                    &ldquo;What disease is affecting my tomato plants?&rdquo;
                                                    </p>
                                                </li>
                                                <li>
                                                    <p>
                                                    &ldquo;Which fertilizers are best for cotton cultivation?&rdquo;
                                                    </p>
                                                </li>
                                            </ol>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>AI Analysis:</strong>
                                                The platform analyzes the question using its AI engine, which is trained on extensive agricultural expertise.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Provide Accurate Solutions:</strong>
                                                The AI identifies the most relevant and useful information for the query.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Receive Guidance:</strong>
                                                Farmers get clear, easy-to-understand answers, along with practical advice or recommended actions.
                                            </p>
                                        </li>
                                    </ul>
    
                                    <h2 class="archive-heading">Types of Information Available</h2>
    
                                    <ul>
                                        <li>
                                            <p>
                                                <strong>Crop Information:</strong>
                                                Guidance on planting, growth, and crop management.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Disease Diagnosis and Treatment:</strong>
                                                Identify crop diseases and get remedies with recommended dosages.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Pest Management:</strong>
                                                Detect pests and learn effective control measures.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Fertilizer Guidance:</strong>
                                                Types, usage, and quantities for optimal yields.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Irrigation Management:</strong>
                                                Efficient water usage tips.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Soil Health:</strong>
                                                Solutions to maintain soil fertility and long-term productivity.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Government Schemes:</strong>
                                                Access agricultural schemes and their benefits.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Market Rates &amp; Sales Guidance:</strong>
                                                Updates on crop prices and marketing advice.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Modern Farming Practices:</strong>
                                                Learn about new technologies and sustainable farming methods.
                                            </p>
                                        </li>
                                    </ul>
                                    
                                    @include('frontend.Adsence.home_page_ads_2')
    
                                    <h2 class="archive-heading">How to Use KrushiTech AI</h2>
    
                                    <ul>
                                        <li>
                                            <p>
                                            <strong>Visit the Platform:</strong>
                                            Access 
                                            <strong>KrushiTech AI</strong>
                                            at 
                                            <a href="{{url('/krushi-tech-ai')}}" data-type="link" data-id="{{url('/krushi-tech-ai')}}">
                                                <strong style="color: #0000ff;">KrushiTech.AI</strong>
                                            </a>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                            <strong>Ask Your Question:</strong>
                                            Type your query in your preferred language on our multi-language platform.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                            <strong>Get Instant Answers:</strong>
                                            Click &ldquo;Get Answer&rdquo; to receive AI-powered guidance immediately.
                                            </p>
                                        </li>
                                    </ul>
    
                                    <h2 class="archive-heading">Who Can Benefit</h2>
    
                                    <ul>
                                        <li>
                                            <p>
                                            Farmers seeking crop and livestock guidance
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                            Agricultural students and researchers
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                            Agriculture consultants and advisors
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                            Individuals experimenting with modern farming techniques
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                            Anyone looking for reliable, multilingual agricultural information
                                            </p>
                                        </li>
                                    </ul>
    
                                    <h2 class="archive-heading">Contact information</h2>
    
                                    <p>Have questions about contributing to Krushi Marathi?, you can reach me at <strong>support@krushimarathi.in</strong>. Or, you can also contact us through our Contact Us form. For that, go to our Contact Us page –&gt; <a href="{{url('/contact-us')}}" data-type="link" data-id="{{url('/contact-us')}}"><strong style="color: #0000ff;">Contact Us</strong></a>. We’re excited to collaborate with you and showcase your work in Marathi, English, or Hindi!</p>
    
                                    <p>Thank you for visiting the Krushi Marathi website.</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('frontend.Adsence.home_page_ads_3')
        
        @if(!$blogs_result->isEmpty())
            <div id="content" class="site-content section-padding">
                <div class="section sdn_sectionAbout main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="container">
                            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;font-size:24px;">Blogs</h2>
                            <hr style="margin-bottom: 12px;margin-top: 10px;">
                            <div class="xpress_articleList">
                                @include('frontend.components.other_blogs_row', ['blogs' => $blogs_result])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Left Side 160x600 Ad -->
        <div class="gutter-ad left">
           @include('frontend.Adsence.sticky_ad_1')
        </div>
    
        <!-- Right Side 160x600 Ad -->
        <div class="gutter-ad right">
            @include('frontend.Adsence.sticky_ad_2')
        </div>
        
    </div>
@endsection