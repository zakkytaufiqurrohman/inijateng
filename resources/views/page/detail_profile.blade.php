@extends('page.layouts.app')
@section('isi')
<div class="bread">
    <div class="container_24">
        <a href="https://www.inijateng.org">Beranda /</a> <a href="" class="active">{{$data->judul}}</a>
    </div>
</div>

<div class="konten_midle" style="background: #f4f4f4;">
    <div class="container_24">
        <div class="left">
            <div class="area">
                <h1 class="title">{{$data->judul}}</h1>
                <div class="text">
                    {!!$data->isi!!}
                </div>
            </div>
            <div class="top">
                <h1 class="name">Berita</h1>
                <a href="#" class="more">Lihat berita lainnya &raquo;</a>
            </div>
            <div class="bottom">
                <div class="grid">
                   
                    <div class="box">
            
                        <div class="pic"><a href=""><img src="" style="object-fit: cover;"></a></div>
                        <h1 class="title"><a href="">judul</a></h1>
                        <div class="sub">Tanggal</div>
                        <div class="text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut voluptate quod quaerat excepturi ullam cumque? Eum, molestias. Cupiditate ullam quis deleniti sit asperiores repellat voluptatum libero! Nulla illo enim tempora.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="area">
              
                <h1 class="title">Jabatan</h1>
                <div class="pic"><img src="" alt="" style="object-fit: cover;"></div>
                <h1 class="name">Nama Ketua</h1>
            </div>
            <div class="area">
                <h1 class="title2">Hymne Ikatan Notaris Indonesia</h1>
                <iframe width="100%" height="200" src="https://www.youtube.com/embed/hLotSlXfOmU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endsection