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
@section('title', 'Berkas')

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
                        <a href="{{ route('alb.berkas.edit') }}" class="btn btn-lg btn-primary"><span class="d-none d-md-inline">Update&nbsp;</span><i class="fa fa-edit"></i></a>
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
                            <label for="ktp">KTP</label>
                            <div class="d-block">
                                @if(!empty($user->ktp))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-times"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="pengantar_magang">Pengantar Magang</label>
                            <div class="d-block">
                                @if(!empty($user->pengantar_magang))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-times"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="suket_pengda">Suket Pengda</label>
                            <div class="d-block">
                                @if(!empty($user->suket_pengda))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-times"></i></button>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="rekomendasi_pengda">Rekomendasi Pengda</label>
                            <div class="d-block">
                                @if(!empty($user->rekomendasi_pengda))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-times"></i></button>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ttmb1">TTMB 1</label>
                            <div class="d-block">
                                @if(!empty($user->ttmb1))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-times"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ttmb2">TTMB 2</label>
                            <div class="d-block">
                                @if(!empty($user->ttmb2))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-times"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ttmb1">TTMB 3</label>
                            <div class="d-block">
                                @if(!empty($user->ttmb3))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-times"></i></button>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-4">
                            <label for="ttmb1">TTMB 4</label>
                            <div class="d-block">
                                @if(!empty($user->ttmb4))
                                    <button class="btn btn-success">Sudah Diupload &nbsp;<i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger">Belum Diupload &nbsp;<i class="fa fa-times"></i></button>
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