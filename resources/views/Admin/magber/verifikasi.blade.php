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
@section('title','List Data Verifikasi Magber '.$maber.' '.$st)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{-- <div class="col-lg-2">
                    <select class="form-control" width="50px"  name="filter" id="filter">
                        <option value="">All Data</option>
                        <option value="1">Maber 1 </option>
                        <option value="2">Maber 2 </option>
                        <option value="3">Maber 3 </option>
                        <option value="4">Maber 4 </option>
                    </select>
                </div> --}}
                <div class="table-responsive mt-4">
                    <table id="role" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"> No</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Wa</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
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
        var maber = '{{$maber}}';
        var status = '{{$id}}';

        $("#role").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: "{{route('verifikasi_maber.data')}}",
                data: {
                    id: maber,
                    status : status
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
                    "width": "15%"
                },
                {
                    data: 'wa',
                    "width": "15%"
                },
                {
                    data: 'kota',
                    "width": "15%"
                },
                {
                    data: 'provinsi',
                    "width": "15%"
                },
                {
                    data: 'action',
                    "width": "15%"
                }
            ],
            fixedColumns: true,
            order: [
                [1, 'asc']
            ]
        });
    }

    // $("#filter").change(function(){
    //     var id = $(this).val();
    //     getData(id);
    // });

    
</script>
@endsection