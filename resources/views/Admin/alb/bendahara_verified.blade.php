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
                        <h2>{{$data->nama}}</h2>
                        <div class="invoice-number">{{$data->nik}}</div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-4 border-bottom-0 ">
                            <address>
                                <strong>No Whatsapp:</strong><br>
                                {{$data->wa}}<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Email</strong><br>
                                {{$data->email}}<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Alamat</strong><br>
                                {{$data->alamat}}<br>
                            </address>
                        </div>
                    </div>
                   
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <img src="{{asset('upload/alb_register/'.$data->foto)}}" class="img-fluid" title=""></a>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('upload/alb_register/'.$data->bukti_bayar)}}"  alt="butki" class="img-fluid" title=""></a>
                </div>
        </div>
        <hr>
        <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
                <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-check"></i> Validasi</button>
                <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
            </div>
            <a href='www.googel.com' class="btn btn-warning btn-icon icon-left"><i class="fas fa-paper-plane"></i> Kirim Wa</a>
        </div>
    </div>
</div>
</section>
</div>
@endsection
