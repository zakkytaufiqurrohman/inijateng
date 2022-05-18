<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sertifikat</title>
    <style>
        body {
            width: 230mm;
            height: 100%;
            margin: 0 auto;
            padding: 0;
            font-size: 12pt;
            background: rgb(204, 204, 204);
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .main-page {
            width: 210mm;
            /* height: 297mm; */
            /* margin: 10mm auto; */
            background: white;
            /* box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5); */
        }
        .demo-bg {
            opacity: 0.1;
            position: absolute;
            top: 50%;
            margin-left: 10%;
            font-size: 18px;
        }
        p* {
            font-family: 'Calibri Light' !important;
        }
        hr {
            border-top: solid 1px #000 !important;
        }

        .sub-page {
            padding: 1cm;
            /* height: 297mm; */
        }

        @page {
            size: A4;
            height: 210;
        }

        @media print {

           .container{
                /* margin-left: 10%; */
                width: initial;
           }

            .main-page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
            .demo-bg {
                opacity: 0.1;
                position: absolute;
                top: 30%;
                margin-left: 15%;
                font-size: 18px;
            }
            .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
                    float: left;
            }
            .col-sm-12 {
                    width: 100%;
            }
            .col-sm-11 {
                    width: 91.66666667%;
            }
            .col-sm-10 {
                    width: 83.33333333%;
            }
            .col-sm-9 {
                    width: 75%;
            }
            .col-sm-8 {
                    width: 66.66666667%;
            }
            .col-sm-7 {
                    width: 58.33333333%;
            }
            .col-sm-6 {
                    width: 50%;
            }
            .col-sm-5 {
                    width: 41.66666667%;
            }
            .col-sm-4 {
                    width: 33.33333333%;
            }
            .col-sm-3 {
                    width: 25%;
            }
            .col-sm-2 {
                    width: 16.66666667%;
            }
            .col-sm-1 {
                    width: 8.33333333%;
            }
        }
    </style>
</head>

<body onload='window.print()' onafterprint="window.close()" >
    <div class="main-page">
        <div class="sub-page">
            <div class="container-fluid">
                <div class="d-flex">
                    <div class="p-2 flex bd-highlight">
                        <img src="{{ asset('/assets/img/logo.png') }}" alt="header" height="120" width="125" class="d-inline-block align-text-top">
                    </div>
                    <div class="p-2 flex-fill bd-highlight text-center">
                        <h3><b>PENGURUS WILAYAH JAWA TENGAH IKATAN NOTARIS INDONESIA ( INI )</b></h3>
                    </div>
                </div>
            </div>
            <hr>
            <div class="demo-bg">
            <img width="500px" src="{{ asset('/assets/img/logo.png') }}">
            </div>
          
            <div class="container mt-2">
                <div class="p-2 flex-fill bd-highlight text-center">
                    <h5>
                    TANDA TELAH MENGIKUTI MAGANG BERSAMA (TTMB)
                    </h5>
                    <b> Nomor: {{$trans->nomor}}/SK-MB/{{$trans->magber_ke}}/{{$magber->nomor}} </b>
                </div>
            </div>
            <div class="container mt-4">
                <div>
                Pengurus Wilayah Jawa Tengah Ikatan Notaris Indonesia. Dengan ini menerangkan bahwa : <br><br><br>
                <div class="anak">
                    <div class="row">
                        <div class="col-4">
                            Nama
                        </div>
                        <div class="col">
                            : {{$trans->user->name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Nomor ALB
                        </div>
                        <div class="col">
                            : {{$trans->detail_alb->no_alb}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                        Notaris Penerima Magang</div>
                        <div class="col">
                            : {{$trans->riwayat_magang->penerima_magang}}
                        </div>
                    </div>
                    
                </div>
                    <br>
                    Telah mengikuti magang Bersama berdasarkan Peraturan Perkumpulan INI mengenai Magang yang berlaku, pada tanggal {{$magber->tanggal}}, dengan Materi Semester {{$trans->magber_ke}}, dengan hasil penilaian <b>BAIK</b>, sesuai dengan Berita Acara Pelaksanaan Magang Bersama Pengurus Wilayah Jawa Tengah Ikatan Notaris Indonesia, tanggal {{$magber->tanggal}}.
                    <br>
                    <br>
                    Tanda Telah Mengikuti Magang Bersama (TTMB) ini dikeluarkan oleh Pengurus Wilayah Jawa Tengah Ikatan Notaris Indonesia, untukk dapat dipergunakan sebagaimana mestinya.                    <br>
                    <br>
                    <div class="container mt-2">
                        <div class="p-2 flex-fill bd-highlight text-center">

                            {{$magber->tempat}}, {{$magber->tanggal}} <br>
                            PENGURUS WILAYAH JAWA TENGAH <br>
                            IKATAN NOTARIS INDONESIA

                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <div class="mt-4">
                                <!-- <div class="card-body"> -->
                                    <h6 class="text-center text-decoration-underline">{{$magber->ketua}}</h6>
                                    <h6 class="text-center">KETUA</h6>
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mt-4">
                                <!-- <div class="card-body"> -->
                                    <h6 class="text-center text-decoration-underline">{{$magber->sekretaris}}</h6>
                                    <h6 class="text-center ">SEKRETARIS</h6>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
        <hr>
        <table style="margin-left:-10px">
            <tr>
                <td>Sekretariat: </td>
                <td colspan="3"><img width="20px" src="{{asset('assets/img/alamat.png')}}" alt=""> Jl.Setiabudi 12 Kompleks Alam Indah Semarang</td>
                <!-- <td>a</td>
                <td>a</td> -->
            </tr>
            <tr>
                <td></td>
                <td colspan="3"> <img width="20px" src="{{asset('assets/img/alamat.png')}}" alt=""> Panorama Ruko/PR NO.19 jl.Bukit Panorama Graha Candi Golf Kasipah,Jangli Semarang</td>
                <!-- <td></td>
                <td></td> -->
            </tr>
            <tr>
                <td></td>
                <td><img width="20px" src="{{asset('assets/img/kontak.png')}}" alt="">  024 7474203</td>
                <td><img width="20px" src="{{asset('assets/img/wa.png')}}" alt="">  088801907702</td>
                <td><img width="20px" src="{{asset('assets/img/email.png')}}" alt="">  pengwiljatengini@gmail.com</td>
            </tr>
        </table>
        </div>
      
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>