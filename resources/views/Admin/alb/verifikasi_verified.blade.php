@extends('layouts.app')
@section('top-script')
<style>
.img-fluid {
    max-width: 100%;
    height: auto;
    max-height: 500px;
}
.gallery.gallery-md.gallery-item-custom{
    width: 200px;
    height: 200px;
}
</style>
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{ asset('node_modules/chocolat/dist/css/chocolat.css') }}">
@endsection
@section('body')
@php 
$status = (($data->verifikator_status==0)&&$data->verifikator_status<>1) ? 'Verified' : 'Unverified';
@endphp
@section('title',"Verifikasi ".$data->name.' Status '.$status)
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="invoice-title">
                <h2>{{$data->nama}}</h2>
                <div class="invoice-number">{{$data->nik}}</div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
                    <ul class="list-group text-dark">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            NIK:
                            <span>{{ $data->nik }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Universitas S1:
                            <span>{{ $data->s1 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Universitas S2:
                            <span>{{ $data->s2 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Whatsapp:
                            <span>{{ $data->wa }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Kabupaten/Kota:
                            <span>{{ $data->kotas->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Alamat:
                            <span>{{ $data->alamat }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tempat, Tanggal Lahir:
                            <span class='text-left'>{{ $data->kotas->name }}, {{ $data->tanggal_lahir}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <a href='{{ asset('upload/alb_register/'.$data->suket) }}' target='_blank' class="btn btn-md btn-info w-100" download>Download Suket Pengda&nbsp;<i class="fa fa-download"></i></a>
                        </li>
                        <li class="list-group-item">
                            @php 
                                $text = "Link Group Wa ".$data->link_group;
                                $url = "https://api.whatsapp.com/send?phone=".$data->wa."&text=".$text;
                            @endphp
                            <a href="{{ $url }}" class="btn btn-mf btn-success w-100"><i class="fa fa-paper-plane"></i>&nbsp;Undang Grup WA</a>
                        </li>
                        <li class="list-group-item">
                            @php
                               $txt = ($data->verifikator_status==0) ? 'Verifikasi' : 'Batal Verifikasi';
                            @endphp
                            <button class="btn btn-mf btn-primary w-100" onclick="validasi('{{$data->id}}','{{$data->verifikator_status}}')"><i class="fa fa-check"></i>&nbsp;{{ $txt }}</button>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="gallery gallery-fw" data-item-height="300">
                            <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/alb_register/'.$data->foto) }}" data-title="Foto" alt='Foto'></div>
                            <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/alb_register/'.$data->ktp) }}" data-title="Scan KTP" alt='Scan KTP'></div>
                            <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/alb_register/'.$data->bukti_bayar) }}" data-title="Bukti Bayar" alt='Bukti Bayar'></div>
                            <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/alb_register/'.$data->ijazah_s1) }}" data-title="Ijazah S1" alt='Ijazah S1'></div>
                            <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/alb_register/'.$data->ijazah_s2) }}" data-title="Ijazah S2" alt='Ijazah S2'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
@endsection
@section('bottom-script')

<script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script>
    function validasi(id,status){

        swal({
            title: 'Verifikasi?',
            text: 'Apakah anda yakin ingin mengubah status?',
            icon: 'info',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('verifikasi_alb.validasi') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id : id,
                        status : status,
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
                            position: 'topRight'
                        });
                        window.location = "{{ url()->previous() }}"
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
        });
    }
</script>
@endsection