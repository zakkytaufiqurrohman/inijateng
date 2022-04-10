<?php

use App\Models\Alb;
use App\Models\Magber;

$page_name = 'home';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="./images/icon.png">
<link rel="stylesheet" type="text/css" href="{{asset('home/css/style.css')}}" >
<link rel="stylesheet" type="text/css" href="{{asset('home/css/style-mobile.css')}}" >
<link rel="stylesheet" type="text/css" href="{{asset('home/css/reset.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('home/font/stylesheet.css')}}" > 
<link rel="stylesheet" type="text/css" href="{{asset('home/css/marquee.css')}}" />

<script src="{{ asset('home/js/jquery.min.js')}}"></script>
<link href="{{ asset('home/css/slide/styles.css')}}" rel="stylesheet" type="text/css" media="all">
<script src="{{ asset('home/css/slide/app.js')}}" type="text/javascript"></script>

<!-- Owl Carousel Assets -->
<link href="{{ asset('homeowl-carousel/owl.carousel.css')}}" rel="stylesheet">
<link href="{{ asset('homeowl-carousel/owl.theme.css')}}" rel="stylesheet"> 
<script src="{{ asset('homeowl-carousel/owl.carousel.js')}}"></script> 

<!--Menu Mobile-->
<link type="text/css" rel="stylesheet" href="css/jquery.mmenu.all.css" />
<script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script>
<script type="text/javascript">
    $(function() {
    $('nav#menumob').mmenu();
    });
</script> 

<script src="https://kit.fontawesome.com/ece056f606.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-157710883-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-157710883-1');
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>INI Jateng</title>
<link rel="icon" href="{{ asset('assets/img/logo.png') }}">
</head>
<body>
@include('page.layouts.header')
@yield('isi')
@include('page.layouts.footer')

</body>
</html>
