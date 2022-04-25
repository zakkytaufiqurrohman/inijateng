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
                <div class="gallery gallery-fw" data-item-height="300">
                    <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/alb_register/'.$data->foto) }}" data-title="Foto" alt='Foto'></div>
                    <div class="gallery-item col-lg-5 col-md-12 col-sm-12" data-image="{{ asset('upload/alb_register/'.$data->bukti_bayar) }}" data-title="bukti bayar" alt='bukti bayar'></div>
                </div>
            </div>
        </div>
        <hr>
        <?php
            $wa = "https://api.whatsapp.com/send?phone=".$data->wa;

        ?>
        <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
                @if($data->bendahara_status == 0)
                    <a  href="#" onclick="validasi('{{$data->id}}','{{$data->bendahara_status}}')" class="btn klik btn-primary btn-icon icon-left"><i class="fas fa-check"></i> Validasi</a>
                @else 
                <a href="#" onclick="validasi('{{$data->id}}','{{$data->bendahara_status}}')" class="btn klik btn-primary btn-icon icon-left"><i class="fas fa-check"></i> Cancel Validasi</a>
                @endif
                <a href="#" onclick="edit()" class="btn btn-danger btn-icon icon-left"><i class="fas fa-edit"></i> Edit</a>
            </div>
            <a href="{{$wa}}" target="_blank" class="btn btn-warning btn-icon icon-left"><i class="fas fa-paper-plane"></i> Kirim Wa</a>
        </div>
    </div>
</div>
</section>
<!-- modal edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Wa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-update">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="" id="update-id">
                    <div class="form-group">
                        <label>Wa</label>
                        <input type="number" class="form-control" name="wa" id="wa" placeholder="Wa 6285234XX" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-update">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal edit -->
</div>
@endsection
@section('bottom-script')
<script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<script>
    $("#form-update").on("submit", function(e) {
                e.preventDefault();
                update();
    });

    function validasi(id,status){
        $.ajax({
            url: "{{ route('bendahara_alb.validasi') }}",
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

     // edit show/asign data
    function edit() {
        var id = "{{$data->id}}";
        var wa = "{{$data->wa}}";
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        $('#modal-edit').modal('show');
        $('#form-update')[0].reset();
        $('#modal-edit').find("input[name='id']").val(id);
        $('#modal-edit').find("input[name='wa']").val(wa);
    }

    function update() {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group').removeClass('is-invalid');
        var wa = $('#wa').val();
        var id = $('#update-id').val();

        $.ajax({
            url: "{{ route('bendahara_alb.edit') }}",
            type: "PUT",
            dataType: "json",
            data: {
                "id" : id,
                "wa": wa,
                "_token": "{{ csrf_token() }}"
            },
            beforeSend() {
                $("input").attr('disabled', 'disabled');
                $("button").attr('disabled', 'disabled');
            },
            complete() {
                $("input").removeAttr('disabled', 'disabled');
                $("button").removeAttr('disabled', 'disabled');
            },
            success(result) {
                $("#form-update")[0].reset();
                $('#modal-edit').modal('hide');
                iziToast.success({
                    title: result.status,
                    message: result.message,
                    position: 'topRight',
                    onOpened: function () {
                        location.reload();
                    }
                });
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                toastr.error(err.message);
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $("input[name="+key+"]").addClass('is-invalid').after('<div class="invalid-feedback">'+value+'</div>');
                })
            }
        });
    }
</script>

@endsection