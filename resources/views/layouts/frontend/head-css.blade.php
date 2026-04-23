<meta charset="utf-8">

<!-- Title (page-specific override via @section('title', '...')) -->
<title>@yield('title', 'Yayasan Sains Nusantara | Penelitian & Teknologi Terapan Indonesia')</title>

<!-- mobile responsive meta -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Meta description (page override) -->
<meta name="description" content="@yield('meta_description', 'YSN menghadirkan inovasi teknologi terapan melalui penelitian dan pelatihan untuk mendukung kesejahteraan masyarakat Indonesia. Jelajahi program kami.')">

<!-- Meta keywords (optional page override) -->
<meta name="keywords" content="@yield('meta_keywords', 'YSN, teknologi terapan, penelitian, pelatihan, Indonesia')">

<meta name="robots" content="@yield('meta_robots', 'index, follow')">

<!-- ** Plugins Needed for the Project ** -->
<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/fe/plugins/bootstrap/bootstrap.min.css') }}">
<!-- slick slider -->
<link rel="stylesheet" href="{{ asset('assets/fe/plugins/slick/slick.css') }}">
<!-- themefy-icon -->
<link rel="stylesheet" href="{{ asset('assets/fe/plugins/themify-icons/themify-icons.css') }}">
<!-- animation css -->
<link rel="stylesheet" href="{{ asset('assets/fe/plugins/animate/animate.css') }}">
<!-- aos -->
<link rel="stylesheet" href="{{ asset('assets/fe/plugins/aos/aos.css') }}">
<!-- venobox popup -->
<link rel="stylesheet" href="{{ asset('assets/fe/plugins/venobox/venobox.css') }}">

<link rel="stylesheet" href="{{ asset('assets/fe/css/timeline.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.css">

<!-- Main Stylesheet -->
<link href="{{ asset('assets/fe/css/style.css') }}" rel="stylesheet">

<!--Favicon-->
<link rel="shortcut icon" href="{{ asset('assets/fe/images/favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/fe/images/favicon.ico') }}" type="image/x-icon">


<link rel="canonical" href="@yield('canonical', url()->current())">

@stack('styles')
