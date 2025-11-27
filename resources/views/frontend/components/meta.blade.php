    <!-- Primary Meta Tags -->
    <title>{{ $title ?? 'Krushi Marathi' }}</title>
    <meta name="description" content="{{ $description ?? 'Krushi Marathi' }}" />
    <link rel="canonical" href="{{ $canonical }}" />
    
    <!-- Language & Locale -->
    @if ($section == 'English')
        <meta property="og:locale" content="en_US" />
    @elseif ($section == 'हिंदी' || $section == 'Smart Shopping')
        <meta property="og:locale" content="hi_IN" />
    @else
        <meta property="og:locale" content="mr_IN" />
    @endif
    
    <meta property="og:locale:alternate" content="en_US" />
    
    <!-- AMP Version -->
    @if(!empty($amp_url) && isset($amp_url))
        <link rel="amphtml" href="{{ $amp_url }}">
    @endif
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $type ?? 'website' }}" />
    <meta property="og:title" content="{{ $title ?? 'Krushi Marathi' }}" />
    <meta property="og:description" content="{{ $description ?? 'Krushi Marathi' }}" />
    <meta property="og:url" content="{{ $canonical }}" />
    <meta property="og:site_name" content="{{url('/')}}" />
    @if(!empty($section))
        <meta property="article:section" content="{{ $section }}" />
    @endif
    <meta property="article:publisher" content="{{ config('constants.facebook') }}" />
    @if(!empty($published_time))
        <meta property="article:published_time" content="{{ $published_time }}" />
    @endif
    @if(!empty($updated_time))
        <meta property="og:updated_time" content="{{ $updated_time }}" />
    @endif
    @if(!empty($modified_time))
        <meta property="article:modified_time" content="{{ $modified_time }}" />
    @endif
    @if(!empty($img_secure_url))
        <meta property="og:image" content="{{ $img_secure_url }}" />
        <meta property="og:image:secure_url" content="{{ $img_secure_url }}" />
    @endif
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="675" />
    <meta property="og:image:type" content="image/png/jpg/webp" />
    @if(!empty($blog_slug))
        <meta property="og:image:alt" content="{{ ucwords(str_replace('-', ' ', $blog_slug)) ?? 'Krushi Marathi' }}"/>
    @else
        <meta property="og:image:alt" content="{{ $title ?? 'Krushi Marathi' }}"/>
    @endif
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ config('constants.twitter_creator') }}">
    <meta name="twitter:title" content="{{ ($title ?? 'Krushi Marathi') . ' - Krushi Marathi' }}"/>
    <meta name="twitter:description" content="{{ ($description ?? 'Krushi Marathi') . ' - Krushi Marathi' }}"/>
    <meta name="twitter:url" content="{{ $canonical }}" />
    
    <meta name="twitter:creator" content="{{ config('constants.twitter_creator') }}">
    <meta name="twitter:domain" content="{{url('/')}}" />
    @if(!empty($img_secure_url))
        <meta name="twitter:image" content="{{ $img_secure_url }}" />
    @endif
    <meta name="twitter:label1" content="Written by" />
    @if(!empty($data1))
        <meta name="twitter:data1" content="{{ $data1 }}" />
    @endif
    <meta name="twitter:label2" content="Time to read">
    <meta name="twitter:data2" content="5 minutes">