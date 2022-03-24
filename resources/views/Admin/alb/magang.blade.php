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
                            <button class="btn btn-md btn-primary float-right mb-2" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>
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
                            <button class="btn btn-md btn-primary float-right mb-2" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>
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
        $("#riwayat_ttmb").removeAttr('width').dataTable({
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
</script>
@endsection