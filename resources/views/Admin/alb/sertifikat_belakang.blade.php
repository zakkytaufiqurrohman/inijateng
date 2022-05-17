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
        @page {
            /* width: 29.7cm; */
            size:A4 landscape;
        }
        
        /* .page {
            width: 29.7cm;
          
        } */
        .rules {
            margin-left: 30px;
            margin-top: -10px;
        }
        /* @media print{
            @page {
                size: landscape
            }
        } */
        /* html, body { height: auto; } */

    </style>
</head>

<body onload='window.print()' onafterprint="window.close()" >
    <!-- <div class="container"> -->
        <div class="page">

        <p>Lampiran Surat Keterangan Lulus Seleksi Anggota Luar Biasa</p>
        <table>
            <tr>
                <td>Nomor Surat Keterangan Lulus</td>
                <td>: {{$alb->nomor}}/{{$event->nomor}}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{$event->tanggal}}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: {{$alb->nama}}</td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <td style="width:5%">
                    <center><b>No</b></center>
                </td>
                <td><center><b>Materi</b></center></td>
                <td style="width:30%"><center><b>Nilai</b></center></td>
            </tr>
            <tr>
                <td>
                    <center><b>1</b></center>
                </td>
                <td>
                    <p><b>UJIAN TERTULIS MELIPUTI:</b></p>
                    <div class="rules">
                        <b>A. ANGGARAN DASAR</b><br>
                        <b>B. ANGGARAN RUMAH TANGGA</b><br>
                        <b>C. PERATURAN PERKUMPULAN</b><br>
                    </div>
                </td>
                <td><Center><b>{{$nilai->nilai_tertulis}}</b></Center></td>
            </tr>
            <tr>
                <td>
                    <center><b>2</b></center>
                </td>
                <td><b>WAWANCARA</b></td>
                <td><Center><b>{{$nilai->nilai_wawancara}}</b></Center></td>
            </tr>
            <tr>
                <!-- <td>
                    <b></b>
                </td> -->
                <td colspan="2"><center><b>JUMLAH NILAI</b></center></td>
                <td><Center><b>{{$nilai->nilai_tertulis + $nilai->nilai_wawancara }}</b></Center></td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <td style="width:5%">
                    <center><b>No</b></center>
                </td>
                <td><center>KRITERIA PENILAIAN</center></td>
                <td style="width:30%"><center>KETERANGAN LULUS</center></td>
            </tr>
            <tr>
                <td>
                    <center><b>1</b></center>
                </td>
                <td>
                    JUMLAH NILAI DIATAS 60
                </td>
                <td><Center>LULUS</Center></td>
            </tr>
            <tr>
                <td>
                    <center><b>2</b></center>
                </td>
                <td>JUMLAH NILAI DIBAWAH 60</td>
                <td><Center>TIDAK LULUS</Center></td>
            </tr>
        </table>
        <center><p>PENGURUS WILAYAH JAWA TENGAH <br> IKATAN NOTARIS INDONESIA</p></center>
        <br>
        <br>
        <div class="row mt-3">
                        <div class="col-sm-6">
                            <div class="mt-4">
                                <!-- <div class="card-body"> -->
                                    <h6 class="text-center text-decoration-underline">{{$event->ketua}}</h6>
                                    <h6 class="text-center">KETUA</h6>
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mt-4">
                                <!-- <div class="card-body"> -->
                                    <h6 class="text-center text-decoration-underline">{{$event->sekretaris}}</h6>
                                    <h6 class="text-center ">SEKRETARIS</h6>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
        </div>
    <!-- </div> -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>