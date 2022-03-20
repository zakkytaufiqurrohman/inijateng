@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')
@section('title','Profile')
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-md btn-primary" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>
                <div class="table-responsive mt-4">
                    <table id="profile_page-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"> No</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Foto</th>
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
    <!-- /.row -->
</section>
<!-- modal add -->
<div class="modal fade" role="dialog" id="modal-add-profile_page">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-add-profile_page"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" placeholder="judul">
                    </div>
                    <div class="form-group">
                      <label for="addisi">Isi</label>  
                      <textarea class="ckeditor form-control" name="isi" id="addisi"></textarea>
                    </div>
                    <div class="form-group>
                            <label for="foto">Foto</label>
                            <input class="form-control" type="file" name="foto" id="">
                            <span>*Kosongi apabila data tidak ingin Upload Foto (Format Png/Jpg)</span>
                    </div> 
                   
                    <div class="form-group">
                        <label for="flag">flag</label>
                        <input type="text" name="flag" class="form-control" id="flag" placeholder="flag">
                    </div>
                    <div class="form-group">
                        <label for="flag">Status Publish</label>
                        <select name="status" class="form-control" id="status">
                            <option value="no">Tidak</option>
                            <option value="publish">Pubish</option>
                        </select>
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
<div class="modal fade" role="dialog" id="modal-update-profile_page">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" enctype="multipart/form-data" id="form-update-profile_page">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="update-judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="update-judul" placeholder="judul">
                    </div>
                    <div class="form-group">
                      <label for="updateisi">Isi</label>  
                      <textarea class="ckeditor form-control" name="isi" id="updateisi"></textarea>
                    </div>
                    <div class="form-group>
                            <label for="foto">Foto</label>
                            <input class="form-control" type="file" name="foto" id="">
                            <span>*Kosongi apabila data tidak ingin Upload Foto (Format Png/Jpg)</span>
                    </div> 
                   
                    <div class="form-group">
                        <label for="flag">flag</label>
                        <input type="text" name="flag" class="form-control" id="flag" placeholder="flag">
                    </div>
                    <div class="form-group">
                        <label for="flag">Status Publish</label>
                        <select name="status" class="form-control" id="status">
                            <option value="no">Tidak</option>
                            <option value="publish">Pubish</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-update-agenda">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal edit -->
<!-- /.content -->
@endsection
@section('bottom-script')
<!-- ckeditor -->
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js   "></script>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('.ckeditor').ckeditor();
    // });
</script>
<script>
    $(function () {
        getData()
        // $("#form-update-profile_page").on("submit", function(e) {
        //         e.preventDefault();
        //         updateCovernot();
        // });
    })
    $('#modal-add-profile_page').on('hidden.bs.modal', function () {
    var form=$("body");
            form.find('.help-block').remove();
            form.find('.form-group').removeClass('has-error');
    })
    $('#modal-update-profile_page').on('hidden.bs.modal', function () {
    var form=$("body");
            form.find('.help-block').remove();
            form.find('.form-group').removeClass('has-error');
    })
    // open modal
    function OpenModalAdd()
    {
        $('#modal-add-profile_page').modal('show');
        setTimeout(() => {
            $('#add-judul').focus();
        }, 500);
    }

    // add /simpan
    $("#form-add-profile_page").on("submit", function(e) {
            e.preventDefault();
        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].updateElement();
        };
        // var formData = $("#form-add-profile_page").serialize();
        var form=$("body");
                form.find('.help-block').remove();
                form.find('.form-group').removeClass('has-error');
        $.ajax({
            url: "{{route('profile_page')}}",
            type: "POST",
            dataType: "json",
            processData: false,
			contentType: false,
            data:  new FormData(this),
            beforeSend() {
                $("#btn-add-profile_page").addClass('btn-progress');
                $("input").attr('disabled', 'disabled');
                $("button").attr('disabled', 'disabled');
                $("select").attr('disabled', 'disabled');
            },
            complete() {
                $("#btn-add-profile_page").removeClass('btn-progress');
                $("input").removeAttr('disabled', 'disabled');
                $("button").removeAttr('disabled', 'disabled');
            },
            success(result) {
                if(result['status'] == 'success'){
                    CKEDITOR.instances.addisi.setData('');
                    $("#form-add-profile_page")[0].reset();
                    $('#modal-add-profile_page').modal('hide');
                    getData();
                }

                toastr.success(result.message);
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                toastr.error(err.message);
            },
            error:function (response){
                $.each(response.responseJSON.errors,function(key,value){
                    $("input[name="+key+"]")
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>'+value+'</strong></span>');
                    $("textarea[name="+key+"]")
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>'+value+'</strong></span>');
                    $("checkbox[name="+key+"]")
                    .closest('.form-group')
                    .addClass('has-error')
                    .append('<span class="help-block"><strong>'+value+'</strong></span>');
                })
            }
        });
    })

    
    // edit show/asign data
    function showCovernot(object)
    {
        var id = $(object).data('id');

        $('#modal-update-profile_page').modal('show');
        $('#form-update-profile_page')[0].reset();
        $.ajax({
            url: "{{route('profile_page.show')}}",
            type: "GET",
            dataType: "json",
            data: {
                "id": id,
            },
            beforeSend() {
                $("#btn-update-profile_page").addClass('btn-progress');
                $("input").attr('disabled', 'disabled');
                $("button").attr('disabled', 'disabled');
            },
            complete() {
                $("#btn-update-profile_page").removeClass('btn-progress');
                $("input").removeAttr('disabled', 'disabled');
                $("button").removeAttr('disabled', 'disabled');
                $("select").removeAttr('disabled', 'disabled');
            },
            success(result) {
                $('#modal-update-profile_page').find("input[name='id']").val(result['data']['id']);
                $('#modal-update-profile_page').find("input[name='judul']").val(result['data']['judul']);
                $('#modal-update-profile_page').find("input[name='flag']").val(result['data']['flag']);
                $('#modal-update-profile_page').find("select[name='status']").val(result['data']['status']).trigger('change');
                CKEDITOR.instances.updateisi.setData(result['data']['isi']);
                           
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                notification(status, err.message);
                checkCSRFToken(err.message);
            }
        });
    }

    // proses update
    $("#form-update-profile_page").on("submit", function(e) {
        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].updateElement();
        };
        // var formData = $("#form-update-profile_page").serialize();
        var form=$("body");
                form.find('.help-block').remove();
                form.find('.form-group').removeClass('has-error');
        $.ajax({
            url: "{{route('profile_page')}}",
            type: "POST",
            dataType: "json",
            processData: false,
			contentType: false,
            data:  new FormData(this),
            beforeSend() {
                $("#btn-update-profile_page").addClass('btn-progress');
                $("input").attr('disabled', 'disabled');
                $("button").attr('disabled', 'disabled');
                $("select").attr('disabled', 'disabled');
            },
            complete() {
                $("#btn-update-profile_page").removeClass('btn-progress');
                $("input").removeAttr('disabled', 'disabled');
                $("button").removeAttr('disabled', 'disabled');
                $("select").removeAttr('disabled', 'disabled');
            },
            success(result) {
                if(result['status'] == 'success'){
                    $("#form-update-profile_page")[0].reset();
                    $('#modal-update-profile_page').modal('hide');
                    getData();
                }
                toastr.success(result.message);
            },
            error(xhr, status, error) {
                var err = eval('(' + xhr.responseText + ')');
                toastr.error(err.message);
            },
            error:function (response){
                $.each(response.responseJSON.errors,function(key,value){
                    $("input[name="+key+"]")
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>'+value+'</strong></span>');
                    $("textarea[name="+key+"]")
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>'+value+'</strong></span>');
                })
            }
        });
    })

    // delete
    function deleteData(object)
    {
        var id = $(object).data('id');
        if (confirm("Apakah Anda Yakin ?")) {
            $.ajax({
                url: "{{route('profile_page')}}",
                type: "POST",
                dataType: "json",
                data: {
                    "id": id,
                    "_method": "DELETE",
                    "_token": "{{ csrf_token() }}"
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
    }

    
    // get data
    function getData()
    {   
        $("#profile_page-table").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('profile_page.data')}}",
            destroy: true,
            scrollX: true,
            scrollCollapse: true,
            columns: [   
                { data: 'DT_RowIndex', orderable: false, searchable:false },
                { data: 'judul',"width": "35%" },
                { data: 'status',"width": "10%" },
                { data: 'created_at',"width": "25%" },
                { data: 'foto',"width": "20%" },
                { data: 'action',"width": "10%" },
            ],
            fixedColumns: true,
            order: [
                [1, 'asc']
            ]
        });
    }
            
</script>
@endsection