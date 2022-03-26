@extends('layouts.app')
@section('top-script')
<style>
.span-data {
    display: block;
    font-weight: 600;
    font-size: 14px;
}
</style>
@endsection

@section('body')
@section('title', 'Riwayat Magang')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="magang-tab" data-toggle="tab" href="#magang" role="tab" aria-controls="magang" aria-selected="true">Magang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ttmb-tab" data-toggle="tab" href="#ttmb" role="tab" aria-controls="ttmb" aria-selected="true">TTMB</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="magang" role="tabpanel" aria-labelledby="magang-tab">
                            <button class="btn btn-md btn-primary float-right mb-2" onclick="OpenModalAddMagang()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>
                            <div class="table-responsive mt-4">
                                <table id="riwayat_magang" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Penerima Magang</th>
                                            <th>Tempat Magang</th>
                                            <th>Wilayah Kerja</th>
                                            <th>Masa Magang</th>
                                            <th>Tgl & No Surat</th>
                                            <th>Magang Ke</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ttmb" role="tabpanel" aria-labelledby="ttmb-tab">
                            <button class="btn btn-md btn-primary float-right mb-2" onclick="OpenModalAddTTMB()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>
                            <div class="table-responsive mt-4">
                                <table id="riwayat_ttmb" class="table table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Pengwil</th>
                                            <th>Tgl Pelaksanaan</th>
                                            <th>Materi</th>
                                            <th>Nilai</th>
                                            <th>Tgl & No Surat</th>
                                            <th>Magang Ke</th>
                                            <th>Aksi</th>
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
    </div>
</div>

<!-- modal add -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-add-magang">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Riwayat Magang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-add-magang">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Penerima Magang</label>
                        <input type="text" class="form-control" name="penerima_magang" id="penerima_magang" placeholder="Penerima Magang" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tempat Magang</label>
                        <input type="text" class="form-control" name="tempat_magang" id="tempat_magang" placeholder="Tempat Magang" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Wilayah Kerja</label>
                        <input type="text" class="form-control" name="wilayah_kerja" id="wilayah_kerja" placeholder="Wilayah Kerja" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Masa Kerja</label>
                        <input type="text" class="form-control" name="masa_magang" id="masa_magang" placeholder="Masa Kerja" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tgl & No Surat</label>
                        <input type="text" class="form-control" name="tgl_no_surat" id="tgl_no_surat" placeholder="Tgl & No Surat" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Magang Ke</label>
                        <input type="number" class="form-control" name="magang_ke" id="magang_ke" placeholder="Magang Ke" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add -->

<!-- modal add -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-add-ttmb">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Riwayat TTMB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-add-ttmb">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Pengwil</label>
                        <input type="text" class="form-control" name="pengwil" id="pengwil" placeholder="Pengwil" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tgl Pelaksanaan</label>
                        <input type="text" class="form-control datepicker" name="tgl_pelaksanaan" id="tgl_pelaksanaan" placeholder=">Tgl Pelaksanaan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Materi</label>
                        <input type="text" class="form-control" name="materi" id="materi" placeholder="Materi" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tgl & Nomor</label>
                        <input type="text" class="form-control" name="tgl_nomor" id="tgl_nomor" placeholder="Tgl & Nomor" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Magang Ke</label>
                        <input type="number" class="form-control" name="magang_ke" id="magang_ke" placeholder="Magang Ke" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add -->


<!-- modal edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit-magang">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Riwayat Magang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-update-magang">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="" id="update-id">
                    <div class="form-group">
                        <label>Penerima Magang</label>
                        <input type="text" class="form-control" name="penerima_magang" id="penerima_magang" placeholder="Penerima Magang" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tempat Magang</label>
                        <input type="text" class="form-control" name="tempat_magang" id="tempat_magang" placeholder="Tempat Magang" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Wilayah Kerja</label>
                        <input type="text" class="form-control" name="wilayah_kerja" id="wilayah_kerja" placeholder="Wilayah Kerja" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Masa Magang</label>
                        <input type="text" class="form-control" name="masa_magang" id="masa_magang" placeholder="Masa Kerja" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tgl & No Surat</label>
                        <input type="text" class="form-control" name="tgl_no_surat" id="tgl_no_surat" placeholder="Tgl & No Surat" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Magang Ke</label>
                        <input type="number" class="form-control" name="magang_ke" id="magang_ke" placeholder="Magang Ke" autocomplete="off">
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

<!-- modal edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit-ttmb">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Riwayat Magang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-update-ttmb">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="" id="update-id">
                    <div class="form-group">
                        <label>Pengwil</label>
                        <input type="text" class="form-control" name="pengwil" id="pengwil" placeholder="Pengwil" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tgl Pelaksanaan</label>
                        <input type="text" class="form-control datepicker" name="tgl_pelaksanaan" id="tgl_pelaksanaan" placeholder="Tgl Pelaksanaan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Materi</label>
                        <input type="text" class="form-control" name="materi" id="materi" placeholder="Materi" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tgl & Nomor</label>
                        <input type="text" class="form-control" name="tgl_nomor" id="tgl_nomor" placeholder="Tgl & Nomor" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Magang Ke</label>
                        <input type="number" class="form-control" name="magang_ke" id="magang_ke" placeholder="Magang Ke" autocomplete="off">
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
@endsection
@section('bottom-script')
<script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
<script>
    $(function() {
        getDataMagang();
        getDataTTMB();
    });

    function getDataMagang(){
        $("#riwayat_magang").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{route('alb.magang.riwayat')}}",
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false, "width": "5%" },
                { data: 'penerima_magang', "width": "20%"},
                { data: 'tempat_magang', "width": "20%"},
                { data: 'wilayah_kerja', "width": "20%"},
                { data: 'masa_magang', "width": "15%"},
                { data: 'tgl_no_surat', "width": "15%"},
                { data: 'magang_ke', "width": "10%"},
                { data: 'action', "width": "20%"},
            ],
            fixedColumns: true,
            order: [
                [1, 'asc']
            ]
        });
    }

    function getDataTTMB(){
        $("#riwayat_ttmb").attr('width','100%').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{route('alb.ttmb.riwayat')}}",
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false, "width": "5%" },
                { data: 'pengwil', "width": "20%"},
                { data: 'tgl_pelaksanaan', "width": "10%"},
                { data: 'materi', "width": "20%"},
                { data: 'nilai', "width": "15%"},
                { data: 'tgl_nomor', "width": "15%"},
                { data: 'magang_ke', "width": "10%"},
                { data: 'action', "width": "20%"},
            ],
            fixedColumns: true,
            order: [
                [1, 'asc']
            ]
        });
    }

    function OpenModalAddMagang(){
        $('#modal-add-magang').modal('show');
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
    }

    $("#form-add-magang").on("submit", function(e) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var formData = $("#form-add-magang").serialize();
        $.ajax({
            url: "{{ route('alb.magang.riwayat') }}",
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
                $("#form-add-magang")[0].reset();
                $('#modal-add-magang').modal('hide');
                getDataMagang();

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

    function Delete(object){
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
                    url: "{{ route('alb.magang.riwayat') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    success(result) {
                        if(result.status=='success')
                            getDataMagang();

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

    function edit(object) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var id = $(object).data('id');

        $('#modal-edit-magang').modal('show');
        $('#form-update-magang')[0].reset();
        $.ajax({
            url: "{{route('alb.magang.show')}}",
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
                $('#modal-edit-magang').find("input[name='id']").val(result['data']['id']);
                $('#modal-edit-magang').find("input[name='penerima_magang']").val(result['data']['penerima_magang']);
                $('#modal-edit-magang').find("input[name='tempat_magang']").val(result['data']['tempat_magang']);
                $('#modal-edit-magang').find("input[name='wilayah_kerja']").val(result['data']['wilayah_kerja']);
                $('#modal-edit-magang').find("input[name='masa_magang']").val(result['data']['masa_magang']);
                $('#modal-edit-magang').find("input[name='tgl_no_surat']").val(result['data']['tgl_no_surat']);
                $('#modal-edit-magang').find("input[name='magang_ke']").val(result['data']['magang_ke']);
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                notification(status, err.message);
                checkCSRFToken(err.message);
            }
        });
    }

    // update
    $("#form-update-magang").on("submit", function(e) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group').removeClass('is-invalid');
        // var formData = $("#form-update").serialize();

        $.ajax({
            url: "{{ route('alb.magang.riwayat') }}",
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
                $("#form-update-magang")[0].reset();
                $('#modal-edit-magang').modal('hide');
                getDataMagang();

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


    function OpenModalAddTTMB(){
        $('#modal-add-ttmb').modal('show');
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
    }

    $("#form-add-ttmb").on("submit", function(e) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var formData = $("#form-add-ttmb").serialize();
        $.ajax({
            url: "{{ route('alb.ttmb.riwayat') }}",
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
                $("#form-add-ttmb")[0].reset();
                $('#modal-add-ttmb').modal('hide');
                getDataTTMB();

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

    function DeleteTTMB(object){
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
                    url: "{{ route('alb.ttmb.riwayat') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    success(result) {
                        if(result.status=='success')
                            getDataTTMB();
                            
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

    function editTTMB(object) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var id = $(object).data('id');

        $('#modal-edit-ttmb').modal('show');
        $('#form-update-ttmb')[0].reset();
        $.ajax({
            url: "{{route('alb.ttmb.show')}}",
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
                $('#modal-edit-ttmb').find("input[name='id']").val(result['data']['id']);
                $('#modal-edit-ttmb').find("input[name='pengwil']").val(result['data']['pengwil']);
                $('#modal-edit-ttmb').find("input[name='tgl_pelaksanaan']").val(result['data']['tgl_pelaksanaan']);
                $('#modal-edit-ttmb').find("input[name='materi']").val(result['data']['materi']);
                $('#modal-edit-ttmb').find("input[name='nilai']").val(result['data']['nilai']);
                $('#modal-edit-ttmb').find("input[name='tgl_nomor']").val(result['data']['tgl_nomor']);
                $('#modal-edit-ttmb').find("input[name='magang_ke']").val(result['data']['magang_ke']);
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                notification(status, err.message);
                checkCSRFToken(err.message);
            }
        });
    }

    // update
    $("#form-update-ttmb").on("submit", function(e) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group').removeClass('is-invalid');
        // var formData = $("#form-update").serialize();

        $.ajax({
            url: "{{ route('alb.ttmb.riwayat') }}",
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
                $("#form-update-ttmb")[0].reset();
                $('#modal-edit-ttmb').modal('hide');
                getDataTTMB();

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

</script>
@endsection