
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
              
        <link rel="icon" href="{{ asset('public/favicon.ico') }}" type="image/x-icon">
        
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="preload" href="https://fonts.gstatic.com/s/mukta/v14/iJWKBXyXfNzjYGVTSmltFdK.ttf" as="font" type="font/woff2" crossorigin="anonymous">
        
        <link href="{{asset('public/assets/front/css/custome.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/front/css/main.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/front/css/style.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/front/css/style.css')}}" rel="stylesheet" type="text/css">
        
        
        <script src="{{asset('public/assets/front/js/jquery.min.js')}}" type="text/javascript" ></script>
        <script src="{{asset('public/assets/front/js/jquery-migrate.min.js')}}" type="text/javascript"></script>
        
        <style>
            .left-sidebar {
                width: 30%;
            }
            .left-sidebar h3 {
                font-size: 18px;
                color: #333;
                margin-bottom: 10px;
                font-weight: bold;
                display: flex;
                align-items: center;
            }
            .live-indicator {
                height: 10px;
                width: 10px;
                background-color: red;
                border-radius: 50%;
                margin-right: 8px;
                position: relative;
                animation: pulse 1.5s infinite;
            }
            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.7);
                }
                70% {
                    box-shadow: 0 0 0 10px rgba(255, 0, 0, 0);
                }
                100% {
                    box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
                }
            }

            .left-sidebar ul {
                list-style: none;
                padding: 0;
                margin: 0;
                max-height: 400px;
                overflow-y: auto;
                scrollbar-width: thin;
                scrollbar-color: #4CAF50 #f4f4f4;
            }
            /* Styles for WebKit browsers (Chrome, Safari, Edge) */
            .left-sidebar ul::-webkit-scrollbar {
                width: 6px;
            }
            .left-sidebar ul::-webkit-scrollbar-track {
                background: #f4f4f4;
            }
            .left-sidebar ul::-webkit-scrollbar-thumb {
                background-color: #4CAF50;
                border-radius: 10px;
                border: 3px solid #f4f4f4;
            }
            .left-sidebar li {
                margin-bottom: 10px;
                padding: 10px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                position: relative;
                border: 1px solid #ddd;
            }
            .left-sidebar li:hover {
                background-color: #e6e6e6;
            }

            .left-sidebar a {
                text-decoration: none;
                color: #333;
                font-size: 14px;
                display: block;
            }
            .left-sidebar .time {
                color: #777;
                font-weight: normal;
                font-size: 12px;
            }
            .left-sidebar p {
                font-size: 16px;
                font-weight: 100;
                line-height: 30px;
                margin: 0;
            }
            .right-content {
                width: 70%;
                padding-left: 20px;
            }
            .header {
                background-color: #fff;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                margin-bottom: 20px;
            }
            .header h1 {
                font-size: 30px;
                color: #c04a4a;
                margin: 0 0 10px 0;
                font-weight: 600;
            }
            .header h1 span {
                color: red;
            }
            .header img {
                max-width: 100%;
                height: auto;
                /* margin-bottom: 10px; */
            }
            .header p {
                font-size: 16px;
                color: #333;
                margin: 5px 0;
            }
            .update-item {
                background-color: #fff;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                margin-bottom: 20px;
                position: relative;
            }
            .update-item .time {
                font-size: 12px;
                color: #666;
                display: block;
                margin-bottom: 5px;
            }
            .update-item h2 {
                font-size: 22px;
                color: #c04a4a;
                margin: 5px 0;
                font-weight: 600;
            }
            .update-item p {
                font-size: 17px;
                color: #333;
                line-height: 32px;
            }

            .update-item p.posted-by{
                font-size: 14px;
                color: #333;
                line-height: 1.5;
            }
            
            .update-item::before, .update-item::after {
                display: none;
            }

            #backToTopBtn {
                display: none;
                justify-content: center; /* Center horizontally */
                align-items: center; /* Center vertically */
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                z-index: 1000;
                font-size: 1.5rem;
                border: none;
                outline: none;
                background: linear-gradient(135deg, #28a745, #218838);
                color: white;
                cursor: pointer;
                padding: 1rem;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                transition: opacity 0.3s ease, transform 0.3s ease, background 0.3s ease;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                opacity: 0.8;
            }

            #backToTopBtn:hover {
                background: linear-gradient(135deg, #218838, #1e7e34);
                transform: scale(1.1);
                opacity: 1;
            }

            #backToTopBtn:focus {
                outline: 2px solid #fff;
                outline-offset: 2px;
            }

            #backToTopBtn svg {
                width: 100%;
                height: 100%;
                fill: currentColor;
            }

            @media (max-width: 768px) {
                .container {
                    flex-direction: column;
                    padding: 10px;
                }
                .left-sidebar, .right-content {
                    width: 100%;
                    padding: 0;
                }
                .left-sidebar {
                    border-bottom: 2px solid #ddd;
                }
                .right-content {
                    padding-left: 0;
                    margin-top: 15px;
                }
                .header h1 {
                    font-size: 20px;
                }
                .header p {
                    font-size: 12px;
                }
                .update-item .time {
                    font-size: 10px;
                }
                .update-item h2 {
                    font-size: 14px;
                }
                .update-item p {
                    font-size: 12px;
                }
                .update-item .posted-by {
                    font-size: 10px;
                }
                .site-content {
                    padding-top: 0px;
                }
            }

            @media (max-width: 600px) {
                #backToTopBtn {
                    bottom: 1.5rem;
                    right: 1.5rem;
                    width: 50px;
                    height: 50px;
                    padding: 0.8rem;
                }
            }

            @media (max-width: 400px) {
                #backToTopBtn {
                    width: 40px;
                    height: 40px;
                    padding: 0.6rem;
                }
            }
        </style>
        
    </head>

    <body class="page-template-default wp-custom-logo wp-embed-responsive no-sidebar nav-float-right separate-containers nav-search-enabled header-aligned-left dropdown-hover featured-image-active using-mouse">
               
        <div id="page" class="site grid-container container hfeed">
            <div id="content" class="site-content" style="padding-top: 20px;">

                <div class="left-sidebar">
                    <h3><span class="live-indicator"></span>Live Update</h3>
                    <ul>
                        @if (isset($live_update->liveupdatesdata) && !empty($live_update->liveupdatesdata) && $live_update->liveupdatesdata->count() > 0)
                            @foreach ($live_update->liveupdatesdata as $liveupdatesdata)
                                <li>
                                    <a href="#{{$liveupdatesdata->id}}">
                                        <span class="time">{{date("h:i A", strtotime($liveupdatesdata->created_at))}}</span><br>
                                        <p>{{$liveupdatesdata->title}}</p>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li>
                                <a href="#nodata">
                                    <span class="time">{{date("h:i A", strtotime(now()))}}</span><br>
                                    <p>Live Updates जल्द ही उपलब्ध होंगे…</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="right-content">
                    <div class="header">
                        @php
                            $liveUpdate = isset($live_update->liveupdatesdata) ? $live_update->liveupdatesdata->first() : "";
                        @endphp
                        <h1>Agriculture <span>LIVE</span> Updates : {{ $liveUpdate ? $liveUpdate->title : 'जल्द ही उपलब्ध होंगे…' }}</h1>
                        <span><b>आज की तारीख: {{ now()->translatedFormat('d F Y, l') }} | समय: {{ now()->format('h:i A') }} </b></span>
                        <img src="{{$liveUpdate ? $live_update->live_update_image : asset('public/live.webp')}}" alt="Agriculture News Live Updates Today">
                        
                        <p>Agriculture News Live Updates Today {{ now()->format('jS F l Y') }}: अब खेती-किसानी से जुड़ी हर ताज़ा खबर, मौसम का हाल, सरकारी योजनाएँ, मंडी भाव, कृषि तकनीक और किसानों की समस्याओं से जुड़े बड़े अपडेट एक ही जगह पढ़ें। देशभर की ग्रामीण और कृषि जगत की सबसे महत्वपूर्ण खबरें लगातार यहीं उपलब्ध रहेंगी।</p>
                    </div>

                    @if (isset($live_update->liveupdatesdata) && !empty($live_update->liveupdatesdata) &&           $live_update->liveupdatesdata->count() > 0)
                        @foreach ($live_update->liveupdatesdata as $liveupdatesdata)
                            <div id="{{$liveupdatesdata->id}}" class="update-item">
                                <span class="time">{{date("h:i A", strtotime($liveupdatesdata->created_at))}}</span>
                                <h2>{!!$liveupdatesdata->title!!}</h2>

                                <p>{!!$liveupdatesdata->description!!}</p>
                                <p class="posted-by">Posted by: {{$live_update->user->name .' '. $live_update->user->last_name}} | {{date("Y-m-d h:i:s", strtotime($liveupdatesdata->created_at))}}</p>
                            </div>
                        @endforeach
                    @else
                        <div id="nodata" class="update-item">
                            
                            <p style="margin-bottom: unset;"><b>फिलहाल कोई नया अपडेट उपलब्ध नहीं है। कृपया हमारे साथ जुड़े रहें। थोड़ी ही देर में आपको यहां ताज़ा कृषि समाचार, मौसम रिपोर्ट और महत्वपूर्ण जानकारी मिलना शुरू हो जाएगी। इस पेज पर बार-बार विज़िट करते रहें ताकि कोई भी खबर मिस न हो।</b></p>
                        </div>
                    @endif
                </div>
                
            </div> 
        </div>

        <button id="backToTopBtn" aria-label="Scroll back to top" title="Back to Top">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 4l-8 8h6v8h4v-8h6z" fill="currentColor"/>
            </svg>
        </button>

        <script src="{{asset('public/assets/front/js/ssp-checkout-form.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/front/js/core.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/front/js/menu.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/front/js/navigation-search.min.js')}}" type="text/javascript"></script>
        <script>
            const backToTopBtn = document.getElementById("backToTopBtn");

            window.addEventListener('scroll', () => {
                if (window.scrollY > 200) {
                    backToTopBtn.style.display = 'block';
                    backToTopBtn.style.opacity = '0.8';
                } else {
                    backToTopBtn.style.display = 'none';
                }
            });

            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Keyboard accessibility
            backToTopBtn.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        </script>
    </body>
</html>