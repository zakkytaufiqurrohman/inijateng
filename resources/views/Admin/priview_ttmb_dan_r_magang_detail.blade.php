@extends('layouts.app')
@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endsection
@section('body')
@section('title','Riwayar TTMB Dan Magang')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>Riwayat Magang</h4>
                <div class="table-responsive mt-4">
                    <table id="role" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"> No</th>
                                <th>Notaris Penerima Magang	</th>
                                <th>Tempat Kedudukan</th>
                                <th>Wilayah Kerja</th>
                                <th>Masa Magang</th>
                                <th>Tanggal dan No Surat</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($magangs as $magang)
                            <tr>
                                <td><?php echo $i;$i++ ?></td>
                                <td>{{$magang->penerima_magang}}</td>
                                <td>{{$magang->tempat_magang}}</td>
                                <td>{{$magang->wilayah_kerja}}</td>
                                <td>{{$magang->masa_magang}}</td>
                                <td>{{$magang->tgl_no_surat}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!--  -->
                <h4>Riwayat TTMB</h4>
                <div class="table-responsive mt-4">
                    <table id="role" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"> No</th>
                                <th>Pengurus Wilayah</th>
                                <th>Tanggal Pelakasanaan</th>
                                <th>Materi Semester</th>
                                <th>Nilai</th>
                                <th>Tanggal dan No TTMB</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($ttmbs as $ttmb)
                            <tr>
                                <td><?php echo $i;$i++ ?></td>
                                <td>{{$ttmb->pengwil}}</td>
                                <td>{{$ttmb->tgl_pelaksanaan}}</td>
                                <td>{{$ttmb->materi}}</td>
                                <td>{{$ttmb->nilai}}</td>
                                <td>{{$ttmb->tgl_nomor}}</td>
                            </tr>
                        @endforeach
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

    
</script>
@endsection