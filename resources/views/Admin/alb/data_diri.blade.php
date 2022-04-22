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
                        <a href="{{ route('alb.data_diri.edit') }}" class="btn btn-lg btn-primary"><span class="d-none d-md-inline">Update&nbsp;</span><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        {{ $user->name }}
                        <div class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> ALB
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
                            <label for="no_alb">No. ALB</label>
                            <input id="no_alb" type="text" class="form-control" name="no_alb"  value="{{ $user->no_alb }}" disabled>
                        </div>
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="s1">S1</label>
                            <input id="s1" type="text" class="form-control" name="s1"  value="{{ $user->s1 }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="tgl_lulus_s1">Tgl Lulus S1</label>
                            <input id="tgl_lulus_s1" type="text" class="form-control" name="tgl_lulus_s1"  value="{{ $user->tgl_lulus_s1 }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="s2">S2</label>
                            <input id="s2" type="text" class="form-control" name="s2"  value="{{ $user->s2 }}" disabled>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="tgl_lulus_s2">Tgl. Lulus S2</label>
                            <input id="tgl_lulus_s2" type="text" class="form-control" name="tgl_lulus_s2"  value="{{ $user->tgl_lulus_s2 }}" disabled>
                        </div>
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="alamat">Alamat</label>
                            <input id="alamat" type="text" class="form-control" name="alamat"  value="{{ $user->alamat }}" disabled>
                        </div>  
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="bukti_terdaftar">Bukti Terdaftar</label>
                            <div class="d-block">
                                @if(!empty($user->bukti_terdaftar))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ijazah_s1">Ijazah S1</label>
                            <div class="d-block">
                                @if(!empty($user->ijazah_s1))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ijazah_s1">Ijazah S2</label>
                            <div class="d-block">
                                @if(!empty($user->ijazah_s2))
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