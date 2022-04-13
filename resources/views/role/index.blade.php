@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')
@section('title','Role')
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
                                <th>Namas</th>
                                <th>Permission</th>
                                <th>Keterangan</th>
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
                <h5 class="modal-title">Tambah Data User</h5>
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
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <div class="show-error">
                            <label>Permission</label>
                            <ul id="permissions"></ul>
                        </div>
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
                <h5 class="modal-title">Edit Data Role</h5>
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
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="update-keterangan" placeholder="Keterangan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <div class="show-error">
                            <label>Permission</label>
                            <ul id="permissions-edit"></ul>
                        </div>
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
        getRole();

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
    })

    // get data
    function getRole() {
        $("#role").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{route('role.data')}}",
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
                    data: 'permission',
                    "width": "20%"
                },
                {
                    data: 'keterangan',
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
        getPermission();
        $('.permissions').remove();
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
    }

    function AddData() {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var name = $('#nama').val();
        var ket = $('#keterangan').val();
        var permissions = [];
        $('.permission').each(function() {
            if ($(this).is(":checked")) {
                permissions.push($(this).val());
            }
        });

        $.ajax({
            url: "{{ route('role') }}",
            type: "POST",
            dataType: "json",
            data: {
                "permission": permissions,
                "name": name,
                "keterangan": ket,
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
                $("#form-add")[0].reset();
                $('#modal-add').modal('hide');
                getRole();

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
                    $(".show-error").addClass('is-invalid').after('<div class="invalid-feedback">'+value+'</div>');

                })
            }
        });
    }

    function in_array(needle, haystack){
        var found = 0;
        for (var i=0, len=haystack.length;i<len;i++) {
            if (haystack[i] == needle) return i;
                found++;
        }
        return -1;
    }

    // edit show/asign data
    function edit(object) {
        $('.permissions').remove();
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var id = $(object).data('id');

        $('#modal-edit').modal('show');
        $('#form-update')[0].reset();
        $.ajax({
            url: "{{route('role.show')}}",
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
                var permiss = [];
                var edit_permiss = [];
                $.each(result['permissions'], function(key, value) {
                    edit_permiss.push(value.name);
                })
                $.ajax({
                    url: "{{route('role.getPermission')}}",
                    type: "GET",
                    dataType: "json",
                    success(response) {
                        $.each(response.data, function(key, value) {
                            permiss.push(value.name);
                        });
                        if (result['permissions'] != null) {
                            var jml = permiss.length;
                            var status = "";
                            
                            for (i = 0; i < permiss.length; i++) {
                                if(in_array(permiss[i],edit_permiss)!= -1){
                                    status = "checked";
                                }
                                else {
                                    status = "";
                                }
                                var li = $('<div class="permissions"<li><input class="form-check-input permission" type="checkbox" '+status+' name="'+ permiss[i] + '" value="' + permiss[i] + '" id="' + result['permissions']['id'] + '"/>' +
                                    '<label for="' + permiss[i] + '"></label></li><div>');
                                li.find('label').text(permiss[i]);
                                $('#permissions-edit').append(li);
                            }
                        }
                    },
                    error(xhr, status, error) {
                        var err = eval('(' + xhr.responseText + ')');
                        notification(status, err.message);
                        checkCSRFToken(err.message);
                    }
                });
                $('#modal-edit').find("input[name='id']").val(result['roles']['id']);
                $('#modal-edit').find("input[name='name']").val(result['roles']['name']);
                $('#modal-edit').find("input[name='keterangan']").val(result['roles']['keterangan']);result['permissions'].length;
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
        var name = $('#update-nama').val();
        var ket = $('#update-keterangan').val();
        var id = $('#update-id').val();
        var permissions = [];
        $('.permission').each(function() {
            if ($(this).is(":checked")) {
                permissions.push($(this).val());
            }
        });

        $.ajax({
            url: "{{ route('role') }}",
            type: "PUT",
            dataType: "json",
            data: {
                "id" : id,
                "permission": permissions,
                "name": name,
                "keterangan": ket,
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
                getRole();

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
    }

    // get permission
    function getPermission() {
       
        $.ajax({
            url: "{{route('role.getPermission')}}",
            type: "GET",
            dataType: "json",
            success(response) {
                $.each(response.data, function(key, value) {
                    var li = $('<div class="permissions"><li><input class="form-check-input permission" type="checkbox" name="' + key + '" value="' + value.name + '" id="' + value.id + '"/>' +
                        '<label for="' + key + '"></label></li></div>');
                    li.find('label').text(value.name);
                    $('#permissions').append(li); 

                });
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                notification(status, err.message);
                checkCSRFToken(err.message);
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
                        url: "{{ route('role') }}",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success(result) {
                            getRole();
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