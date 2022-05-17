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
        p* {
            font-family: 'Calibri Light' !important;
        }
        
        /* .page {
            width: 29.7cm;
          
        } */
        .rules {
            margin-left: 30px;
            margin-top: -10px;
        }
        @media print{
            @page {
                size: landscape
            }
        }
        .sertif{
            background-image: url("{{asset('assets/img/magang2.png')}}");
            background-repeat: no-repeat, repeat;
            width:1100.6670866px;
            height:750.33417323px;
        }
        /* @media print {
            body {-webkit-print-color-adjust: exact;}
        } */
        /* html, body { height: auto; } */

    </style>
</head>

<body onload='window.print()' onafterprint="window.close()" >
    <!-- <div class="container"> -->
        <div class="page">
            <!-- <div class="sertif">
                <h1>dasdasd</h1>
            </div> -->
        <b> NOTARIS PENERIMA MAGANG </b>
        <table class="table table-bordered">
            <tr>
                <td style="width:5%">
                   NO
                </td>
                <td tyle="width:20">NOTARIS PENERIMA MAGANG</td>
                <td style="width:15">TEMPAT KEDUDUKAN</td>
                <td style="width:10">WILAYAH KERJA</td>
                <td style="width:20">MASA MAGANG</td>
                <td style="width:30">TANGGAL & NO. SURAT</td>
            </tr>
                
                @foreach($trans->riwayat_magangs as $key=>$riwayat)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$riwayat->penerima_magang}}</td>
                    <td>{{$riwayat->tempat_magang}}</td>
                    <td>{{$riwayat->wilayah_kerja}}</td>
                    <td>{{$riwayat->masa_magang}}</td>
                    <td>{{$riwayat->tgl_no_surat}}</td>
                </tr>
                @endforeach
            <tr>
                <td colspan="6">Total Masa Magang : 24 Bulan**)</td>
            </tr>
        </table>

        <b>DAFTAR TTMB</b>
        <table class="table table-bordered">
            <tr>
                <td style="width:5%">
                   NO
                </td>
                <td tyle="width:20">PENGURUS WILAYAH</td>
                <td style="width:15">TANGGAL PELAKSANAAN</td>
                <td style="width:10">MATERI SEMESTER</td>
                <td style="width:20">NILAI</td>
                <td style="width:30">TANGGAL & NO. TTMB</td>
            </tr>
                
            @foreach($trans->riwayat_ttmbs as $key=>$riwayat_ttmb)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$riwayat_ttmb->pengwil}}</td>
                <td>{{$riwayat_ttmb->tgl_pelaksanaan}}</td>
                <td>{{$riwayat_ttmb->materi}}</td>
                <td>{{$riwayat_ttmb->nilai}}</td>
                <td>{{$riwayat_ttmb->tgl_nomor}}</td>
            </tr>
            @endforeach
           
        </table>
      
        </div>
    <!-- </div> -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>