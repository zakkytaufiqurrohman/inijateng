@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')
<?php 
    if($id == 0){
        $st = 'Unverified';
    }
    else{
        $st = 'Verified';
    }
?>
@section('title','List Bendahara ALB '.$st)
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
@endsection
@section('bottom-script')

<script>
    $(function() {
        getData();
    })

    // get data
    function getData() {
        var status = '{{$id}}';
        $("#role").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: "{{route('bendahara_alb.data')}}",
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
                    data: 'nama',
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
                    data: 'action',
                    "width": "20%"
                }
            ],
            fixedColumns: true,
            order: [
                [1, 'asc']
            ]
        });
    }

    
</script>
@endsection