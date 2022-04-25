<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sertifikat A4</title>
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
            min-height: 297mm;
            margin: 10mm auto;
            background: white;
            /* background-image: url('/assets/img/logo.png'); */
            /* Full height */
            /* height: 100%; */
            /* position: relative; */

            /* Center and scale the image nicely */
            /* background-position: center;
            background-repeat: no-repeat;
            background-size: inherit; */
            /* width: 100vh;
            height: 100vh; */
            /* background-image: rgba(0, 0, 0, 0.5); */
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }
        .demo-bg {
            opacity: 0.1;
            position: absolute;
            top: 50%;
            margin-left: 10%;
            font-size: 18px;
        }

        .sub-page {
            padding: 1cm;
            height: 297mm;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
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
                /* top: 50%; */
                /* margin-left: 10%; */
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
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
            <img src="{{ asset('/assets/img/logo.png') }}">
            </div>
          
            <div class="container mt-5">
                <div class="p-2 flex-fill bd-highlight text-center">
                    <h5>
                        SURAT KETERANGAN LULUS <br>
                        SELEKSI ANGGOTA LUAR BIASA (ALB)
                    </h5>
                    Nomor: 38/SKL-ALB/XI/2021
                </div>
            </div>
            <div class="container mt-4">
                <div class="p-2 flex-fill bd-highlight text-start">
                    Pengurus Wilayah Jawa Tengah Ikatan Notaris Indonesia dengan ini menyatakan bahwa: <br><br>
                    <div class="row">
                        <div class="col-4">
                            Nama
                        </div>
                        <div class="col">
                            : 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Alamat Rumah
                        </div>
                        <div class="col">
                            : 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Asal Perguruan Tinggi
                        </div>
                        <div class="col">
                            : 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Progdi MKn
                        </div>
                        <div class="col">
                            : 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Tanggal Lulus Progdi MKn
                        </div>
                        <div class="col">
                            : 
                        </div>
                    </div>
                    <br>
                    Telah lulus Seleksi ALB INI berdasarkan Peraturan Perkumpulan INI Nomor: 22/PERKUM/INI/2021 tentang Pendaftaran Anggota Luar Biasa INI sesuai Surat ALB/INIJATENG/XI/2021, Tanggal 25 November 2021
                    <br>
                    <br>
                    Surat Keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.

                    <div class="container mt-5">
                        <div class="p-2 flex-fill bd-highlight text-center">

                            Semarang, 25 November 2021 <br>
                            PENGURUS WILAYAH JAWA TENGAH <br>
                            IKATAN NOTARIS INDONESIA

                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class=" mt-4">
                                <div class="card-body">
                                    <h5 class="text-center text-decoration-underline">Nama Ketua</h5>
                                    <h6 class="text-center">KETUA</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mt-4">
                                <div class="card-body">
                                <h5 class="text-center text-decoration-underline">Nama Sekretaris</h5>
                                <h6 class="text-center ">SEKRETARIS</h6>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>