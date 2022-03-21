<div class="header_atas">
    <div class="container_24">
        <div class="menu-mobile">
        <div class="menu-mobile"><a href="#menumob"></a></div>
            <nav id="menumob">
                <ul>
                    <li><a href='https://www.inijateng.org'>BERANDA</a></li>
                    <li class="has-sub"><a href='#'>PROFIL</a>
                        <ul>
                            <?php

                                use App\Models\Profile;
                                $datas = Profile::where('status','publish')->get();
                            ?>
                            @foreach($datas as $data)
                            <li>
                                <a href=''>{{$data->judul}}ss</a>
                            </li>
                            @endforeach
                            <li>
                                <a href=''>ss</a>
                            </li>
                    

                            <li><a href='laporan_keuangan.php'>Laporan Keuangans</a>
                                <ul>
                                    <li><a href='laporan-1-bendahara.html'>Laporan Keuangan Bendahara</a></li>
                                    <li><a href='laporan-2-bendahara.html'>Laporan Keuangan Bendahara 1</a></li>
                                    <li><a href='laporan-3-bendahara.html'>Laporan Keuangan Bendahara 2</a></li>
                                    <li><a href='laporan-4-bendahara.html'>Laporan Keuangan Bendahara 3</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="has-sub"><a href='#'>KEANGGOTAAN</a>
                        <ul>
                            <li><a href='pengurus_daerah.php'>Pengurus Daerah</a></li>
                            <li><a href='notaris_magang.php'>Notaris Penerima Magang</a></li>
                            <li><a href='alb.php'>Pendaftaran ALB</a></li>
                            <li><a href='magang.php'>Pendaftaran Magang Bersama</a></li>
                            <li><a href='seminar.php'>Pendaftaran Seminar</a></li>
                        </ul>
                    </li>
                    <li><a href='agenda.php'>AGENDA & EVENT</a></li>
                    <li><a href='galeri.php'>GALERI</a></li>
                    <li><a href='artikel.php'>ARTIKEL</a></li>
                    <li><a href='kontak.php'>KONTAK</a></li>
                   
                </ul>
            </nav>
        </div>
        <div class="logo"><a href="https://www.inijateng.org"><img src="{{asset('setting_img/logo.png')}}" title=""></a></div>
        
    </div>
</div>
<div class="header_bawah" id="navbar">
    <div class="container_24">
        <div id='cssmenu'>
            <ul>
                <li><a href='https://www.inijateng.org'>BERANDA</a></li>
                <li class="has-sub"><a href='#'>PROFIL</a>
                    <ul>
                        <?php

                            $datas = Profile::where('status','publish')->get();
                        ?>
                        @foreach($datas as $data)
                            <li>
                                <a href=''>{{$data->judul}}ss</a>
                            </li>
                        @endforeach
                       
                        <li><a href='laporan_keuangan.php'>Laporan Keuangan</a>
                            <ul style="margin-left: 240px; margin-top: -40px;">
                                <li><a href='laporan-1-bendahara.html'>Laporan Keuangan Bendahara</a></li>
                                <li><a href='laporan-2-bendahara.html'>Laporan Keuangan Bendahara 1</a></li>
                                <li><a href='laporan-3-bendahara.html'>Laporan Keuangan Bendahara 2</a></li>
                                <li><a href='laporan-4-bendahara.html'>Laporan Keuangan Bendahara 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="has-sub"><a href='#'>KEANGGOTAAN</a>
                    <ul>
                        <li><a href='pengurus_daerah.php'>Pengurus Daerah</a></li>
                        <li><a href='notaris_magang.php'>Notaris Penerima Magang</a></li>
                        <li><a href='alb.php'>Pendaftaran ALB</a></li>
                        <li><a href='magang.php'>Pendaftaran Magang Bersama</a></li>
                        <li><a href='seminar.php'>Pendaftaran Seminar</a></li>
                    </ul>
                </li>
                <li><a href='agenda.php'>AGENDA & EVENT</a></li>
                <li><a href='galeri.php'>GALERI</a></li>
                <li><a href='artikel.php'>ARTIKEL</a></li>
                <li><a href='kontak.php'>KONTAK</a></li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
function valnominal(angka) { 
     var isi = angka.value;
     var hasil='';
     
     for(var i=0;i<isi.length;i++)
     {
        var nilai = isi.substr(i,1);
        if(parseFloat(nilai) || parseFloat(nilai)==0 || (i==0 && nilai=='-'))
        {
            if(i==0 && nilai=='-') hasil=nilai;
            else if(i==1 && hasil==0) hasil=nilai;
            else if(i==1 && nilai==0 && hasil=='-') hasil=hasil;
            else hasil+= nilai;
        }
     }
     
     var jumlah=Math.floor(hasil.length/3);
     var sisa=hasil.length%3;
     var hasill='';
     for(var i=-1;i<jumlah;i++) {
         if(i==-1) hasill+=hasil.substr(0,sisa);
         else if(hasill=='' || hasill=='-') hasill+=hasil.substr(sisa+(3*i),3);
         else hasill+="."+hasil.substr(sisa+(3*i),3);
     }
     angka.value = hasill;
}
function CheckTextBox(i) {
     if(i.value.length>0) 
     {
     i.value = i.value.replace(/[^\d]+/g, ''); 
     }
}
</script>