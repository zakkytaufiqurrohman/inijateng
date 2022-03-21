@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')
@section('title','List Maber')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-md btn-primary" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>
                <div class="table-responsive mt-4">
                    <table id="role" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"> No</th>
                                <th>Judul</th>
                                <th>Banner</th>
                                <th>Tahun</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- modal add -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Maber</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-add">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Maber" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="bukti_bayar">Banner</label>
                        <input id="banner" type="file" class="form-control" name="banner" placeholder="Banner">
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="tahun" placeholder="2022" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" autocomplete="off">
                    </div>
                   
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add -->

<!-- modal edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Maber</h5>
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
                        <label>judul</label>
                        <input type="text" class="form-control" name="judul" id="update-judul" placeholder="Judul" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="update-tahun" placeholder="tahun" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="bukti_bayar">Banner</label>
                        <input id="banner-edit" type="file" class="form-control" name="banner" placeholder="Banner">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                       <select class="form-control" name="status" id="status">
                           <option value="0">Tidak Aktif</option>
                           <option value="1">Aktif</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="update-keterangan" placeholder="Keterangan" autocomplete="off">
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
@endsection
@section('bottom-script')
<script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
<script>
    $(function() {
        getData();
    })

    // get data
    function getData() {
        $("#role").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{route('maber.data')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    "width": "5%"
                },
                {
                    data: 'judul',
                    "width": "20%"
                },
                {
                    data: 'year',
                    "width": "20%"
                },
                {
                    data: 'banner',
                    "width": "20%"
                },
                {
                    data: 'keterangan',
                    "width": "20%"
                },
                {
                    data: 'status',
                    "width": "20%"
                },
                {
                    data: 'action',
                    "width": "20%"
                },
            ],
            fixedColumns: true,
            order: [
                [1, 'asc']
            ]
        });
    }

    function OpenModalAdd() {
        $('#modal-add').modal('show');
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
    }

    $("#form-add").on("submit", function(e) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var formData = $("#form-add").serialize();
        $.ajax({
            url: "{{ route('maber') }}",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data:  new FormData(this),
            beforeSend() {
                $("input").attr('disabled', 'disabled');
                $("button").attr('disabled', 'disabled');
            },
            complete() {
                $("input").removeAttr('disabled', 'disabled');
                $("button").removeAttr('disabled', 'disabled');
            },
            success(result) {
                $("#form-add")[0].reset();
                $('#modal-add').modal('hide');
                getData();

                iziToast.success({
                    title: result.status,
                    message: result.message,
                    position: 'topRight'
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
    })

    // edit show/asign data
    function edit(object) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var id = $(object).data('id');

        $('#modal-edit').modal('show');
        $('#form-update')[0].reset();
        $.ajax({
            url: "{{route('maber.show')}}",
            type: "GET",
            dataType: "json",
            data: {
                "id": id,
            },
            beforeSend() {
                $(".btn-update").addClass('btn-progress');
                $("input").attr('disabled', 'disabled');
                $("button").attr('disabled', 'disabled');
            },
            complete() {
                $(".btn-update").removeClass('btn-progress');
                $("input").removeAttr('disabled', 'disabled');
                $("button").removeAttr('disabled', 'disabled');
            },
            success(result) {
                $('#modal-edit').find("input[name='id']").val(result['data']['id']);
                $('#modal-edit').find("input[name='judul']").val(result['data']['judul']);
                $('#modal-edit').find("input[name='tahun']").val(result['data']['year']);
                $('#modal-edit').find("input[name='keterangan']").val(result['data']['keterangan']);
                $('#modal-edit').find("select[name='status']").val(result['data']['status']).trigger('change');
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                notification(status, err.message);
                checkCSRFToken(err.message);
            }
        });
    }

    // update
    $("#form-update").on("submit", function(e) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group').removeClass('is-invalid');
        // var formData = $("#form-update").serialize();

        $.ajax({
            url: "{{ route('maber') }}",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data:  new FormData(this),
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
                getData();

                iziToast.success({
                    title: result.status,
                    message: result.message,
                    position: 'topRight'
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
    })


    function Delete(object) {
        var id = $(object).data('id');
        swal({
                title: 'Hapus?',
                text: 'Apakah anda yakin ingin menghapus data ini?',
                icon: 'error',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('maber') }}",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success(result) {
                            if(result)
                            getData();
                            iziToast.success({
                                title: result.status,
                                message: result.message,
                                position: 'topRight'
                            });

                        },
                        error(xhr, status, error) {
                            var err = eval('(' + xhr.responseText + ')');
                            iziToast.error({
                                title: status,
                                message: err.message,
                                position: 'topRight'
                            });
                        }
                    });
                }
            });
    }
</script>
@endsection