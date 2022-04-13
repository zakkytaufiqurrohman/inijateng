@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')
@section('title','Master Data Notaris Dan ALB')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row" style="margin-left: 1px;">
                    <div class="col-lg-2">
                            <select class="form-control" width="50px"  name="filter" id="filter">
                            <option value="">All Data</option>
                            <option value="notaris">Notaris</option>
                            <option value="alb">Alb</option>
                            </select>
                    </div>
                    <div class="col-lg-7">

                    </div>
                    <div class="col-lg-3">
                    <button class="btn btn-md btn-primary" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>

                    </div>
                </div>
                <div class="col-lg-2">
                        
                </div>
                <!-- <button class="btn btn-md btn-primary" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button> -->
                <!-- <button class="btn btn-md btn-primary" onclick=""><i class='fa fa-upload'></i>&nbsp;Import</button> -->
                <div class="table-responsive mt-4">
                    <table id="role" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"> No</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Email</th>
                                <th>Status Anggota</th>
                                <th>Status Data</th>
                                <th>Role</th>
                                <th>Barcode</th>
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
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-add">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" id="nama" placeholder="Nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nik</label>
                        <input type="number" class="form-control" name="nik" id="nik" placeholder="nik 16 digit" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Status Anggota</label>
                       <select class="form-control" name="status_anggota" id="status_anggota">
                           <option value="notaris">Notaris</option>
                           <option value="alb">ALB</option>
                       </select>
                    </div>
                    <div class="form-group form-role">
                        <label>Role</label>
                            <select class="form-control select2" name="role[]" id="role" multiple="multiple">
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" > {{ $role->name }}</option>
                                @endforeach
                            </select>
                        <div class="invalid-feedback-custom"></div>
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
                <h5 class="modal-title">Edit Data</h5>
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
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" id="update-nama" placeholder="Nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nik</label>
                        <input type="number" class="form-control" name="nik" id="nik" placeholder="nik 16 digit" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="email" autocomplete="off">
                    </div>
                    <select class="form-control" name="status_anggota" id="status_anggota">
                           <option value="notaris">Notaris</option>
                           <option value="alb">ALB</option>
                       </select>
                    <div class="form-group form-role">
                        <label>Role</label>
                        <select class="form-control select2" name="roleEdit[]" id="role-edit" multiple='multiple'>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" > {{ $role->name }}</option>
                            @endforeach
                        </select>
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
<script src="{{ asset('node_modules/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    $(function() {
        getData();

        // preven add
        $("#form-add").on("submit", function(e) {
            e.preventDefault();
            AddData();
        });

        // preven update
        $("#form-update").on("submit", function(e) {
                e.preventDefault();
                update();
        });

        // $('#role').select2({
        //         width: "100%",
        //         placeholder: "Roles",
        //         allowClear: true
        // });

        // $('#role-edit').select2({
        //     width: "100%",
        //     placeholder: "Roles",
        //     allowClear: true
        // });
    })

    // get data
    function getData(id) {
        $("#role").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: "{{route('master_data.data')}}",
                data: {
                    id: id
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    "width": "5%"
                },
                {
                    data: 'name',
                    "width": "20%"
                },
                {
                    data: 'nik',
                    "width": "20%"
                },
                {
                    data: 'email',
                    "width": "20%"
                },
                {
                    data: 'status_anggota',
                    "width": "20%"
                },
                {
                    data: 'status',
                    "width": "20%"
                },
                {
                    data: 'roles',
                    "width": "20%",
                    "searchable": false
                },
                {
                    data: 'barcode',
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

    function AddData() {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var formData = $("#form-add").serialize();
        $.ajax({
            url: "{{ route('master_data') }}",
            type: "POST",
            dataType: "json",
            data: formData,
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
                    if(key=='role'){ 
                            $("#role").addClass('is-invalid is-invalid-custom'); 
                            $(".form-role").append('<div class="invalid-feedback invalid-feedback-custom">'+value+'</div>')
                    }
                })
            }
        });
    }

    // edit show/asign data
    function edit(object) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var id = $(object).data('id');

        $('#modal-edit').modal('show');
        $('#form-update')[0].reset();
        $.ajax({
            url: "{{route('master_data.show')}}",
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
                var roles = result['data']['roles'];
                $('#modal-edit').find("input[name='id']").val(result['data']['id']);
                $('#modal-edit').find("input[name='name']").val(result['data']['name']);
                $('#modal-edit').find("input[name='nik']").val(result['data']['nik']);
                $('#modal-edit').find("input[name='email']").val(result['data']['email']);
                $('#modal-edit').find("select[name='status_anggota']").val(result['data']['status_anggota']).change();
                var role = [];
                $.each(roles, function(key,value){
                    role.push(value.id)
                });
                $('#role-edit').val(role);
                $('#role-edit').trigger('change');
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                notification(status, err.message);
                checkCSRFToken(err.message);
            }
        });
    }

    // update
    function update() {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group').removeClass('is-invalid');
        var formData = $("#form-update").serialize();

        $.ajax({
            url: "{{ route('master_data') }}",
            type: "POST",
            dataType: "json",
            data: formData,
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
                    if(key=='roleEdit'){ 
                        $("#role-edit").addClass('is-invalid is-invalid-custom'); 
                        $(".form-role").append('<div class="invalid-feedback invalid-feedback-custom">'+value+'</div>')
                    }
                })
            }
        });
    }


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
                        url: "{{ route('master_data') }}",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success(result) {
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

    $("#filter").change(function(){
        var id = $(this).val();
        getData(id);
    });
</script>
@endsection