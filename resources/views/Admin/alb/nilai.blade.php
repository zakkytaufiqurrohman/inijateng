@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')
<?php 
    if($id == 0){
        $st = 'Belum Dinilai';
    }
    else{
        $st = 'Sudah Dinilai';
    }
?>
@section('title','List Penilaian ALB '.$st)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mt-4">
                    <table id="role" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"> No</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Wa</th>
                                <th>Alamat</th>
                                <th>Gelar S1</th>
                                <th>Gelar S2</th>
                                <th>Tahun Mkn</th>
                                <th>Nilai Tertulis</th>
                                <th>Nilai Wawancara</th>
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
                <h5 class="modal-title">Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-add">
            <input type="hidden" name="id">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Nilai Ujian Tertulis</label>
                        <input type="number" class="form-control" name="tulis" id="tertulis" placeholder="Nilai Ujian Tertulis" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nilai Wawancara</label>
                        <input type="number" class="form-control" name="wawancara" id="Nilai Wawancara" placeholder="Nilai Ujian Wawancara" autocomplete="off">
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
@endsection
@section('bottom-script')

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
    })

    // get data
    function getData() {
        var status = '{{$id}}';
        $("#role").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: "{{route('nilai.data')}}",
                type: "get",
                data: function (d) {
                    d.status = status;
                },
            },
            // ajax: "{{route('bendahara_maber.data')}}",
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
                    data: 'wa',
                    "width": "20%"
                },
                {
                    data: 'alamat',
                    "width": "20%"
                },
                {
                    data: 's1',
                    "width": "20%"
                },
                {
                    data: 's2',
                    "width": "20%"
                },
                {
                    data: 'tahun_s2',
                    "width": "20%"
                },
                {
                    data: 'nilai_t',
                    "width": "20%"
                },
                {
                    data: 'nilai_w',
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

    function AddData() {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var formData = $("#form-add").serialize();
        $.ajax({
            url: "{{ route('nilai') }}",
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
                })
            }
        });
    }

    // edit show/asign data
    function nilai(object) {
        var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group .is-invalid').removeClass('is-invalid');
        var id = $(object).data('id');
        console.log(id)
        $('#modal-add').find("input[name='id']").val(id);
        $('#modal-add').modal('show');
        $('#form-update')[0].reset();
     

    }
    
</script>
@endsection