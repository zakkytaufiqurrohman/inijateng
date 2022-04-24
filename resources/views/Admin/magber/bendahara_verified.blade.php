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
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{ asset('node_modules/chocolat/dist/css/chocolat.css') }}">

@endsection
@section('body')
@section('title','Verifikasi Bendahara Maber')
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h2>{{$data->user->name}}</h2>
                        <div class="invoice-number">{{$data->user->nik}}</div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-4 border-bottom-0 ">
                            <address>
                                <strong>No Whatsapp:</strong><br>
                                {{$data->user->wa}}<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Email</strong><br>
                                {{$data->user->email}}<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>No Alb</strong><br>
                                {{$data->detail_alb->no_alb}}<br>
                            </address>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-4 border-bottom-0 ">
                            <address>
                                <strong>Universitas S1:</strong><br>
                                {{$data->detail_alb->s1}}<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Universitas S2</strong><br>
                                {{$data->detail_alb->s1}}<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>TTl</strong><br>
                                {{optional($data->user->lahir)->name}}<br>
                            </address>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-4 border-bottom-0 ">
                            <address>
                                <strong>Provinsi:</strong><br>
                                {{optional($data->user->provincies)->name}}<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Kota</strong><br>
                                {{optional($data->user->kotas)->name}}<br>
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Alamat</strong><br>
                                {{$data->detail_alb->alamat}}<br>
                            </address>
                        </div>
                    </div>
                   
                </div>
            </div>

            <div class="row mt-4">
                <!-- <div class="col-md-6">
                    <img src="{{asset('upload/foto/'.$data->user->foto)}}" alt="foto" width="100%" title="" height="400px" ></img>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('upload/bukti_bayar_maber/'.$data->bukti_bayar)}}"  alt="butki" width="100%"  height="400px" title=""></a>
                </div> -->
                <div class="gallery gallery-fw" data-item-height="300">
                    <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/foto/'.$data->user->foto) }}" data-title="Foto" alt='Foto'></div>
                    <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/bukti_bayar_maber/'.$data->bukti_bayar) }}" data-title="bukti bayar" alt='bukti bayar'></div>
                </div>
            </div>
        </div>
        <hr>
        <?php
            $wa = "https://api.whatsapp.com/send?phone=".$data->user->wa;

        ?>
        <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
                @if($data->bendahara_status == 0)
                    <a  href="#" onclick="validasi('{{$data->id}}','{{$data->bendahara_status}}')" class="btn klik btn-primary btn-icon icon-left"><i class="fas fa-check"></i> Validasi</a>
                @else 
                <a href="#" onclick="validasi('{{$data->id}}','{{$data->bendahara_status}}')" class="btn klik btn-primary btn-icon icon-left"><i class="fas fa-check"></i> Cancel Validasi</a>
                @endif
                <!-- <a href="#" onclick="edit()" class="btn btn-danger btn-icon icon-left"><i class="fas fa-edit"></i> Edit</a> -->
            </div>
            <a href="{{$wa}}" target="_blank" class="btn btn-warning btn-icon icon-left"><i class="fas fa-paper-plane"></i> Kirim Wa</a>
        </div>
        <br>
    </div>
</div>
</section>
</div>
@endsection
@section('bottom-script')
<script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script>
    function validasi(id,status){
        $.ajax({
            url: "{{ route('bendahara_maber.validasi') }}",
            type: "POST",
            dataType: "json",
            data: {
                id : id,
                status: status,
                "_token": "{{ csrf_token() }}",
            },
            beforeSend() {
                $(".klik").attr('disabled', 'disabled');
            },
            complete() {
                $(".klik").removeAttr('disabled', 'disabled');
            },
            success(result) {
                iziToast.success({
                    title: result.status,
                    message: result.message,
                    position: 'topRight',
                    onOpened: function () {
                        window.location = "{{ url()->previous() }}"
                    }
                });
                // window.location = "{{ url()->previous() }}"
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                iziToast.error({
                    title: 'error',
                    position: 'topRight'
                });
            },
        });
    }
</script>

@endsection