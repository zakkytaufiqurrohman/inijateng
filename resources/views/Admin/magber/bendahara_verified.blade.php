@extends('layouts.app')
@section('top-script')
<style>
.img-fluid {
    max-width: 100%;
    height: auto;
    max-height: 500px;
}
</style>
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')
@section('title','Verifikasi')
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h2>{{$data->user->name}}</h2>
                        <div class="invoice-number">NO ALB</div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-4 border-bottom-0 ">
                            <address>
                                <strong>No Whatsapp:</strong><br>
                                08177298444<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Email</strong><br>
                                dsad@gmail.com<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Kota</strong><br>
                                Semarang<br>
                            </address>
                        </div>
                    </div>
                   
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <img src="{{asset('setting_img/slide1.jpg')}}" class="img-fluid" title=""></a>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('setting_img/slide1.jpg')}}" class="img-fluid" title=""></a>
                </div>
        </div>
        <hr>
        <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
                <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-check"></i> Validasi</button>
                <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
            </div>
            <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-paper-plane"></i> Kirim Wa</button>
        </div>
    </div>
</div>
</section>
</div>
@endsection
@section('bottom-script')


@endsection