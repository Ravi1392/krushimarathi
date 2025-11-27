
<title>{{ $title ?? 'Krushi Marathi' }}</title>

<meta name="description" content="{{ $description ?? 'Krushi Marathi' }}" />
<link rel="canonical" href="{{ $canonical }}" />
<meta property="og:locale" content="en_IN" />
<meta property="og:locale:alternate" content="en_US" />
<meta property="og:type" content="{{ $type ?? 'website' }}" />
<meta property="og:title" content="{{ $title ?? 'Krushi Marathi' }}" />
<meta property="og:description" content="{{ $description ?? 'Krushi Marathi' }}" />
<meta property="og:url" content="{{ $canonical }}" />
<meta property="og:site_name" content="Krushi Marathi" />
<meta property="og:updated_time" content="{{$updated_time}}" />

@if (!empty($published_time))
    <meta property="article:published_time" content="{{$published_time}}" />
@endif
@if (!empty($modified_time))
    <meta property="article:modified_time" content="{{$modified_time}}" />
@endif
<meta name="twitter:site" content="{{ config('constants.twitter_creator') }}">
<meta name="twitter:creator" content="{{ config('constants.twitter_creator') }}">
<meta name="twitter:card" content="{{ $twitter_card ?? 'summary_large_image' }}" />
<meta name="twitter:title" content="{{ $title ?? 'Krushi Marathi' }}" />
<meta name="twitter:label1" content="Written by" />
@if(!empty($data1))
        <meta name="twitter:data1" content="{{ $data1 }}" />
@endif