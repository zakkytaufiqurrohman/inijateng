<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="card text-center ms-4 mt-3 shadow">
        <div class="card-header bg-info text-white">
            <h3 class="card-title">Seleksi ALB</h3>
        </div>
        <div class="card-body">

            <p class="card-text mt-3">Jumlah Peserta: {{$alb_total}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{$alb_bendahara}} / {{ $alb_total}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$alb_verif}}/ {{ $alb_total}}</p>
        </div>
    </div>
    <div class="row ms-3 mt-5">
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Magang Bersama I</h3>
                </div>
                <div class="card-body">

                    <p class="card-text mt-3">Jumlah Peserta: {{$magber_total}}</p>
                    <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{$magber_bendahara}} / {{ $magber_total}}</p>
                    <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$magber_verif}}/ {{ $magber_total}}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Magang Bersama II</h3>
                </div>
                <div class="card-body">

                    <p class="card-text mt-3">Jumlah Peserta: {{ $magber_total2}}</p>
                    <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{ $magber_bendahara2}} / {{ $magber_total2}}</p>
                    <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$magber_verif2}} / {{ $magber_total2}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 ms-3">
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h3 class="card-title">Magang Bersama III</h3>
                </div>
                <div class="card-body">

                    <p class="card-text mt-3">
                        Jumlah Peserta: {{ $magber_total3}}</p>
                    <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{$magber_bendahara3}} / {{ $magber_total3}}</p>
                    <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$magber_verif3}} / {{ $magber_total3}}</p>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h3 class="card-title">Magang Bersama IV</h3>
                </div>
                <div class="card-body">

                    <p class="card-text mt-3">
                        Jumlah Peserta: {{ $magber_total4}}</p>
                    <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{$magber_bendahara4}} / {{ $magber_total4}}</p>
                    <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$magber_verif4}} / {{ $magber_total4}}</p>

                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>