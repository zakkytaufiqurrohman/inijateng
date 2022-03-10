<div class="footer_top">
    <div class="left">
        <h1 class="name">KANTOR SEKRETARIAT PENGURUS WILAYAH JAWA TENGAH IKATAN NOTARIS INDONESIA</h1>
        <div class="info">
            <div class="ico"><i class="far fa-building"></i></div>Setiabudi 12 Kompleks Alam Indah Semarang
        </div>
        <div class="info">
            <div class="ico"><i class="far fa-building"></i></div>Ruko Panorama No.19, Grha Candi Golf Semarang
        </div>
        <div class="info">
            <div class="ico"><i class="fas fa-phone-alt"></i></div>024-7474203
        </div>
        <div class="info">
            <div class="ico"><i class="fab fa-whatsapp"></i></div>088801907702
        </div>
        <div class="info">
            <div class="ico"><i class="far fa-envelope"></i></div>pengwiljatengini@gmail.com
        </div>
    </div>
    <div class="right"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.7337336333712!2d110.42076598795306!3d-7.040546432938799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f4afa27f10ed%3A0xc82c73a9fbca269d!2sCatharina%20Mulyani%20Santoso%2C%20SH.%2CMH.!5e0!3m2!1sen!2sid!4v1574841483810!5m2!1sen!2sid" width="100%" height="360" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
</div>
<?php $thn=date("Y");?>
<div class="footer_bottom">Copyright <?php echo $thn;?> © Ikatan Notaris Indonesia Pengurus Wilayah Jawa Tengah. All rights reserved.</div>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>

<a href="#" id="back-to-top" title="Back to top"></a>
<script type="text/javascript">
if ($('#back-to-top').length) {
    var scrollTrigger = 500, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    var owl = $("#owl-demo1");
    owl.owlCarousel({
    items : 5, //10 items above 1000px browser width
    itemsDesktop : [1000,5], //5 items between 1000px and 901px
    itemsDesktopSmall : [900,4], // 3 items betweem 900px and 601px
    itemsTablet: [550,2], //2 items between 600 and 0;
    itemsMobile : false,
    autoPlay : 5000,
    slideSpeed : 1400
    });
    });
</script>