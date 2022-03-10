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
@section('title', 'Data Diri')

<div class="section-body">
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary profile-widget">
                <form id='form-data-diri' action="javascript(0)" method="POST" >
                <div class="card-header"> 
                    <h4>Update Data Diri</h4>                   
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="npwp">NPWP</label>
                            <input id="npwp" type="text" class="form-control" name="npwp"  value="{{ $user->detail_notaris->npwp }}" >
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="telephone">No. Telp</label>
                            <input id="telephone" type="text" class="form-control" name="telephone"  value="{{ $user->detail_notaris->telephone }}" >
                        </div> 
                      
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="no_kta_ini">No. KTA INI</label>
                            <input id="no_kta_ini" type="text" class="form-control" name="no_kta_ini"  value="{{ $user->detail_notaris->no_kta_ini }}" >
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="no_kta_ppat">No. KTA PPAT</label>
                            <input id="no_kta_ppat" type="text" class="form-control" name="no_kta_ppat"  value="{{ $user->detail_notaris->no_kta_ppat }}" >
                        </div> 
                        <div class="form-group col-md-12 col-lg-12">
                            <label for="alamat">Alamat Kantor</label>
                            <textarea id="alamat" type="text" class="form-control" name="alamat" rows="4" cols="50">{{ $user->detail_notaris->alamat_kantor }}</textarea>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ktp_img">Foto KTP</label>
                            <div class="custom-file">
                                <input id="ktp_img" type="file" class="custom-file-input" name="ktp_img" >
                                <label class="custom-file-label" for="ktp_img">Choose file</label>
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="sk_notaris">SK Notaris</label>
                            <div class="custom-file">
                                <input id="sk_notaris" type="file" class="custom-file-input" name="sk_notaris" >
                                <label class="custom-file-label" for="sk_notaris">Choose file</label>
                            </div>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="sk_ppt">SK PPT</label>
                            <div class="custom-file">
                                <input id="sk_ppt" type="file" class="custom-file-input" name="sk_ppt" >
                                <label class="custom-file-label" for="sk_ppt">Choose file</label>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-lg btn-primary">Submit</button>
                    <a href="{{ route('notaris.data_diri') }}" class="btn btn-lg btn-secondary">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection