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
                                <strong>Kota</strong><br>
                                {{$data->user->kota}}<br>
                            </address>
                        </div>
                    </div>
                   
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <img src="{{ asset('upload/foto/'.$data->user->foto) }}" class="img-fluid" title=""></a>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('upload/bukti_bayar_maber/'.$data->bukti_bayar) }}" class="img-fluid" title=""></a>
                </div>
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