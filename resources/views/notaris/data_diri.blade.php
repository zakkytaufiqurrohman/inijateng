@extends('layouts.app')
@section('top-script')
<style>
#profile-picture-upload {
    display: none;
}
#profile-picture-custom{
    cursor: pointer;
    width: 150px;
    height: 150px;
	object-fit: cover;
}
.label-data {

}
.span-data {
    display: block;
    font-weight: 600;
    font-size: 14px;
}
/* .button-header-custom{
    float: right;   
} */
</style>
@endsection

@section('body')
@section('title', 'Data Diri')

<div class="section-body">
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary profile-widget">
                <div class="profile-widget-header">          
                    @if(!empty($user->foto))
                        <img alt="image" src="{{ asset('upload/foto/'.$user->foto)}}" id="profile-picture-custom" class="rounded-circle profile-widget-picture">
                    @else
                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" id='profile-picture-custom' class="rounded-circle profile-widget-picture profile-picture-custom">
                    @endif           
                    <div class="button-header-custom float-right p-3">
                        <a href="{{ route('notaris.data_diri.edit') }}" class="btn btn-lg btn-primary"><span class="d-none d-md-inline">Update&nbsp;</span><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        {{ $user->name }}
                        <div class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> Notaris
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="nama">Nama</label>
                            {{-- <span class="d-block" >{{ $user->name }}</span> --}}
                            <input id="nama" type="text" class="form-control" name="nama" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="nik">NIK</label>
                            <input id="nik" type="text" class="form-control" name="nik"  value="{{ $user->nik }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="email">Email</label>
                            <input id="email" type="text" class="form-control" name="email"  value="{{ $user->email }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="npwp">NPWP</label>
                            <input id="npwp" type="text" class="form-control" name="npwp"  value="{{ $user->npwp }}" disabled>
                        </div>
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="telephone">No. Telp</label>
                            <input id="telephone" type="text" class="form-control" name="telephone"  value="{{ $user->telephone }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="no_kta_ini">No. KTA INI</label>
                            <input id="no_kta_ini" type="text" class="form-control" name="no_kta_ini"  value="{{ $user->no_kta_ini }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="no_kta_ppat">No. KTA PPAT</label>
                            <input id="no_kta_ppat" type="text" class="form-control" name="no_kta_ppat"  value="{{ $user->no_kta_ppt }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="no_sk_notaris">No. SK Notaris</label>
                            <input id="no_sk_notaris" type="text" class="form-control" name="no_sk_notaris"  value="{{ $user->no_sk_notaris }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="alamat">Alamat Kantor</label>
                            <input id="alamat" type="text" class="form-control" name="alamat"  value="{{ $user->alamat_kantor }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="asal_pengda">Asal Pengda</label>
                            <input id="asal_pengda" type="text" class="form-control" name="asal_pengda"  value="{{ $user->asal_pengda }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ktp_img">Foto KTP</label>
                            <div class="d-block">
                                @if(!empty($user->ktp_img))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ktp_img">SK Notaris</label>
                            <div class="d-block">
                                @if(!empty($user->sk_notaris))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ktp_img">SK PPAT</label>
                            <div class="d-block">
                                @if(!empty($user->sk_ppt))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ktp_img">Scan NPWP</label>
                            <div class="d-block">
                                @if(!empty($user->scan_npwp))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @endif
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{-- <a href="{{ route('notaris.data_diri.edit') }}" class="btn btn-lg btn-primary">Update&nbsp;<i class="fa fa-edit"></i></a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection