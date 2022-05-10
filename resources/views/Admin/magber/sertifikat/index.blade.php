@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')

@section('title','List Data Sertifikat Maber Ke - '.$maber)
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
        $("#role").removeAttr('width').dataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: "{{route('sertifikat.data')}}",
                data: {
                    id: maber,
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