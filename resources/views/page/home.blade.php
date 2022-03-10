<?php
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
<title>Pengwil Jateng Ikatan Notaris Indonesia</title>
</head>
<body>
@include('page.layouts.header')

<div class="header_news">
    <div class="container_24">
        <h1 class="title">Berita Terbaru</h1>
        <div class="show_news">
            <div class="marquee up">

            </div>
        </div>
    </div>
</div>

<div class="konten_top">
    <div class="container_24">
        <div id="homepage_slider" class="flexslider">
            <ul class="slides">
                <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;" class="flex-active-slide">
                    <a href="#"><img src="{{asset('setting_img/slide1.jpg')}}" alt="" draggable="false"></a>
                </li>
                <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;" class="flex-active-slide">
                    <a href="#"><img src="{{asset('setting_img/slide2.jpg')}}" alt="" draggable="false"></a>
                </li>
                <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;" class="flex-active-slide">
                    <a href="#"><img src="{{asset('setting_img/slide1.jpg')}}" alt="" draggable="false"></a>
                </li>
            </ul>
            <ul class="flex-direction-nav">
                <li><a class="flex-prev" href="#">Previous</a></li>
                <li><a class="flex-next" href="#">Next</a></li>
            </ul>
        </div>

        <div class="visi">
        <div class="grid">
                <div class="box">
                    <h1 class="title"><div class="ico"><img src="{{asset('assets/img/ico_about.png')}}"></div>{{$sejarah->judul}}</h1>
                    <div class="text">
                        <p><?php $str1=str_replace('<p>','',$sejarah->isi);
                        $str2=str_replace('</p>','',$str1);
                        $str3=str_replace('&nbsp;','',$str2);
                        $str4=strip_tags($str3);
                        $kata=strtok($str4," ");
                            for ($i=1;$i<=16;$i++)
                            {
                            print("$kata ");
                            $kata=strtok(" ");
                        }?></p>
                        <a href="" class="link">Selengkapnya</a>
                    </div>
                </div>
                <div class="box">
                    <h1 class="title"><div class="ico"><img src="{{asset('assets/img/ico_visi.png')}}"></div>{{$visi->judul}}</h1>
                    <div class="text">
                        <p><?php $str1=str_replace('<p>','',$visi->isi);
                        $str2=str_replace('</p>','',$str1);
                        $str3=str_replace('&nbsp;','',$str2);
                        $str4=strip_tags($str3);
                        $kata=strtok($str4," ");
                            for ($i=1;$i<=16;$i++)
                            {
                            print("$kata ");
                            $kata=strtok(" ");
                        }?></p>
                        <a href="" class="link">Selengkapnya</a>
                    </div>
                </div>
                <div class="box">
                    <h1 class="title"><div class="ico"><img src="{{asset('assets/img/ico_kode.png')}}"></div>{{$kode_etk->judul}}</h1>
                    <div class="text">
                        <p><?php $str1=str_replace('<p>','',$kode_etk->isi);
                        $str2=str_replace('</p>','',$str1);
                        $str3=str_replace('&nbsp;','',$str2);
                        $str4=strip_tags($str3);
                        $kata=strtok($str4," ");
                            for ($i=1;$i<=16;$i++)
                            {
                            print("$kata ");
                            $kata=strtok(" ");
                        }?></p>
                        <a href="" class="link">Selengkapnya</a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- <div class="konten_midle">
    <div class="container_24">
        <div class="left">
        	<div class="top">
                <h1 class="name">Kegiatan Pengwil INI Jateng</h1>
            </div>
            <div class="bottom" style="margin-bottom: 30px;">
                <div class="grid">
                   
                </div>
            </div>

            <div class="top">
                <h1 class="name">Berita</h1>
                <a href="agenda.php" class="more">Lihat berita lainnya &raquo;</a>
            </div>
            <div class="bottom">
                <div class="grid">
                	
                    <div class="box">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="box">
                <h1 class="top">Galeri Kegiatan</h1>
                <div class="grid">
                    
                </div>
                <a href="galeri.php" class="more">Lihat galeri lainnya &raquo;</a>
            </div>
            <div class="box">
                <h1 class="top">Follow Us</h1>
            </div>
        </div>
    </div>
</div> -->

<!-- <div class="dewan_page">
    <div class="container_24">
        <h1 class="title">DEWAN PENGURUS</h1>
        <div class="slide_bottom">
            <div id="owl-demo1" class="owl-carousel">
               
            </div>
        </div>
    </div>
</div> -->

<!--<div class="mitra_page">
    <div class="container_24">
        <h1 class="name">Mitra INI Jateng</h1>
        <div class="row center_grid" style="float: left; width: 100%;">
           
        </div>
    </div>
</div>-->
@include('page.layouts.footer')

</body>
</html>