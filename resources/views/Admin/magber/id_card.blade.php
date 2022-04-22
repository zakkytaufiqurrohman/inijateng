<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;700&display=swap');

                            * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                            }

                            body {
                            font-family: 'Poppins', sans-serif;
                            align-items: center;
                            justify-content: center;
                            background-color: #f1f1f1;
                            min-height: 100vh;
                            }
                            img {
                            max-width: 100%;
                            display: block;
                            }
                            ul {
                            list-style: none;
                            }

                            /* Utilities */
                            .card::after,
                            .card img {
                            border-radius: 5%;
                            }
                            body,
                            .card,
                            .stats {
                            display: flex;
                            }

                            .card {
                            padding: 2.5rem 2rem;
                            border-radius: 10px;
                            background-color: rgba(255, 255, 255, .5);
                            max-width: 500px;
                            box-shadow: 0 0 30px rgba(0, 0, 0, .15);
                            margin: 1rem;
                            position: relative;
                            transform-style: preserve-3d;
                            overflow: hidden;
                            }
                            .card::before,
                            .card::after {
                            content: '';
                            position: absolute;
                            z-index: -1;
                            }
                            .card::before {
                            width: 100%;
                            height: 100%;
                            border: 1px solid #c30914;
                            border-radius: 10px;
                            top: -.7rem;
                            left: -.7rem;
                            }
                            .card::after {
                            height: 15rem;
                            width: 15rem;
                            background-color: #c30914;
                            top: -8rem;
                            right: -8rem;
                            box-shadow: 2rem 6rem 0 -3rem rgb(255, 255, 255)
                            }

                            .card img {
                            width: 8rem;
                            min-width: 80px;
                            box-shadow: 0 0 0 2px #ffffff;
                            }
                            
                            hr{
                                border-top: 1px dotted red;
                                margin-bottom: 1rem;
                            }

                            .infos {
                            margin-left: 1.5rem;
                            }

                            .name {
                            margin-bottom: 1rem;
                            }
                            .name h2 {
                            font-size: 1.3rem;
                            }
                            .name h4 {
                            font-size: .8rem;
                            color: #333
                            }

                            .text {
                            font-size: .9rem;
                            margin-bottom: 1rem;
                            }

                            .stats {
                            margin-bottom: 1rem;
                            }
                            .stats li {
                            min-width: 5rem;
                            }
                            .stats li h3 {
                            font-size: .99rem;
                            }
                            .stats li h4 {
                            font-size: .75rem;
                            }

                            .links button {
                            font-family: 'Poppins', sans-serif;
                            min-width: 120px;
                            padding: .5rem;
                            border: 1px solid #222;
                            border-radius: 5px;
                            font-weight: bold;
                            cursor: pointer;
                            transition: all .25s linear;
                            }
                            .links .follow,
                            .links .view:hover {
                            background-color: #222;
                            color: #FFF;
                            }
                            .links .view,
                            .links .follow:hover{
                            background-color: transparent;
                            color: #222;
                            }

                            @media screen and (max-width: 450px) {
                            .card {
                                display: block;
                            }
                            .infos {
                                margin-left: 0;
                                margin-top: 1.5rem;
                            }
                            .links button {
                                min-width: 100px;
                            }
                            }

</style>


    <title>yukdaftar.com</title>
</head>
<body>
    
    <div class="card">
        <div class="img">
            <img src="{{asset('upload/foto/'.$data->foto)}}" alt="">
        </div>
        <div class="infos">
          <div class="name">
          <b> {{ $event->judul }} <br>
        
          </div>
          <br>
          {!! DNS2D::getBarcodeSVG($data->kode, 'QRCODE',10,10,'darkblack') !!}
          <p class="text">
                <h1> {{ $data->name }} </h1>
                <h3>{{ $data->kode }}</h3>
          </p>
          <br>
          <hr>
          <ul class="stats">
            <li>
              <h3>Tidak Perlu Dicetak</h3>
              <h4>Cukup Tunjukan Saat Absensi dan Pengambilan Sertifikat</h4>
            </li>
          </ul>
        </div>
      </div>

</body>
</html>