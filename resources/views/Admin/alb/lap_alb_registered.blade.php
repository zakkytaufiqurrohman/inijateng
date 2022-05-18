@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')

@section('title','Data Peserta ALB')
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
                                <th>Email</th>
                                <th>Wa</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>S1</th>
                                <th>Tahun lulus S1</th>
                                <th>S2</th>
                                <th>Tahun lulus S2</th>
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
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
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
            ajax: {
                url: "{{route('alb_registered.data')}}",
                // data: {
                //     id: maber,
                // }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    "width": "5%"
                },
                {
                    data: 'nama',
                    "width": "15%"
                },
                {
                    data: 'nik',
                    "width": "15%"
                },
                {
                    data: 'email',
                    "width": "15%"
                },
                {
                    data: 'wa',
                    "width": "15%"
                },
                {
                    data: 'tempat_lahir',
                    "width": "15%"
                },
                {
                    data: 'tanggal_lahir',
                    "width": "15%"
                },
                {
                    data: 'alamat',
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
                    data: 's1',
                    "width": "15%"
                },
                {
                    data: 'tahun_s1',
                    "width": "15%"
                },
                {
                    data: 's2',
                    "width": "15%"
                },
                {
                    data: 'tahun_s2',
                    "width": "15%"
                }
            ],
            fixedColumns: true,
            order: [
                [1, 'asc']
            ],dom: 'Blfrtip',
            buttons: [
                'excel',
            ],
            paging: false
        });
    }

    // $("#filter").change(function(){
    //     var id = $(this).val();
    //     getData(id);
    // });

    
</script>
@endsection