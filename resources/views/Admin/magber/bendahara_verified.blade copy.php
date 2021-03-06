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
<link rel="stylesheet" href="{{ asset('node_modules/chocolat/dist/css/chocolat.css') }}">
@endsection
@section('body')
@section('title','Verifikasi')
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="invoice-title">
                <h2>{{$data->user->name}}</h2>
                <div class="invoice-number">{{$data->user->nik}}</div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <ul class="list-group text-dark">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            NIK:
                            <span>{{ $data->user->nik }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Universitas S1:
                            <span>{{ $data->detail_alb->s1 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Universitas S2:
                            <span>{{ $data->detail_alb->s2 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Whatsapp:
                            <span>{{ $data->user->wa }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Kabupaten/Kota:
                            <span>{{ $data->user->kota }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Alamat:
                            <span>{{ $data->user->alamat }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tempat, Tanggal Lahir:
                            <span>{{ $data->user->tempat_lahir }}, {{ $data->user->tgl_lahir}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <a href='{{ asset('upload/suket_pengda/'.$data->detail_berkas_alb->suket_pengda) }}' target='_blank' class="btn btn-md btn-info">Download Suket Pengda&nbsp;<i class="fa fa-download"></i></a>
                        </li>
                        <li class="list-group-item">
                            <button class="btn btn-mf btn-success w-100"><i class="fa fa-paper-plane"></i>&nbsp;Undang Grup WA</button>
                        </li>
                        <li class="list-group-item">
                            <button class="btn btn-mf btn-primary w-100" onclick="validasi('{{$data->id}}')"><i class="fa fa-check"></i>&nbsp;Verifikasi</button>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="gallery gallery-md" data-item-height="">
                        <div class="gallery-item" data-image="{{ asset('upload/foto/'.$data->user->foto) }}" data-title="Foto"></div>
                        <div class="gallery-item" data-image="{{ asset('upload/ktp_img/'.$data->detail_berkas_alb->ktp) }}" data-title="Scan KTP"></div>
                        <div class="gallery-item" data-image="{{ asset('upload/ijazah/s1/'.$data->detail_alb->ijazah_s1) }}" data-title="Ijazah S1"></div>
                        <div class="gallery-item" data-image="{{ asset('upload/ijazah/s2/'.$data->detail_alb->ijazah_s2) }}" data-title="Ijazah S2"></div>
                    </div>
                    <div class="gallery gallery-fw" data-item-height="350">
                        <div class="gallery-item" data-image="{{ asset('upload/bukti_bayar_maber/'.$data->bukti_bayar) }}" data-title="Bukti Bayar"></div>
                    </div>
                </div>
            </div>

            {{-- <div class="row mt-4">
                <div class="col-md-6">
                    <img src="{{ asset('upload/foto/'.$data->user->foto) }}" class="img-fluid" title=""></a>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('upload/bukti_bayar_maber/'.$data->bukti_bayar) }}" class="img-fluid" title=""></a>
                </div> --}}
        </div>
        <hr>
        <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
                <button class="btn btn-primary btn-icon icon-left" onclick="validasi('{{$data->id}}')"><i class="fas fa-check"></i>&nbsp;Validasi</button>
                <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i>&nbsp;Cancel</button>
            </div>
            @php $url = "https://api.whatsapp.com/send?phone=".$data->user->wa @endphp
            <a href="{{ $url }}" class="btn btn-success btn-icon icon-left"><i class="fas fa-paper-plane"></i>&nbsp;Kirim Wa</a>
        </div>
    </div>
</div>
</section>
</div>
@endsection
@section('bottom-script')

<script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script>
    function validasi(id){
        $.ajax({
            url: "{{ route('bendahara_maber.validasi') }}",
            type: "POST",
            dataType: "json",
            data: {
                id : id,
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
</script>
@endsection