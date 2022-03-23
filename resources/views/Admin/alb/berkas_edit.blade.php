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
@section('title', 'Berkas')

<div class="section-body">
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary profile-widget">
                <form id='form-berkas' action="javascript(0)" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-header"> 
                    <h4>Update Berkas</h4>                   
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ktp">KTP</label>
                            <div class="custom-file">
                                <input id="ktp" type="file" class="custom-file-input" name="ktp" >
                                <label class="custom-file-label text-truncate" for="ktp">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="pengantar_magang">Pengantar Magang</label>
                            <div class="custom-file">
                                <input id="pengantar_magang" type="file" class="custom-file-input" name="pengantar_magang" >
                                <label class="custom-file-label text-truncate" for="pengantar_magang">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="suket_pengda">Suket Pengda</label>
                            <div class="custom-file">
                                <input id="suket_pengda" type="file" class="custom-file-input" name="suket_pengda" >
                                <label class="custom-file-label text-truncate" for="suket_pengda">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="rekomendasi_pengda">Rekomendasi Pengda</label>
                            <div class="custom-file">
                                <input id="rekomendasi_pengda" type="file" class="custom-file-input" name="rekomendasi_pengda" >
                                <label class="custom-file-label text-truncate" for="rekomendasi_pengda">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ttmb1">TTMB 1</label>
                            <div class="custom-file">
                                <input id="ttmb1" type="file" class="custom-file-input" name="ttmb1" >
                                <label class="custom-file-label text-truncate" for="ttmb1">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ttmb2">TTMB 2</label>
                            <div class="custom-file">
                                <input id="ttmb2" type="file" class="custom-file-input" name="ttmb2" >
                                <label class="custom-file-label text-truncate" for="ttmb2">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ttmb3">TTMB 3</label>
                            <div class="custom-file">
                                <input id="ttmb3" type="file" class="custom-file-input" name="ttmb3" >
                                <label class="custom-file-label text-truncate" for="ttmb3">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ttmb4">TTMB 4</label>
                            <div class="custom-file">
                                <input id="ttmb4" type="file" class="custom-file-input" name="ttmb4" >
                                <label class="custom-file-label text-truncate" for="ttmb4">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-lg btn-primary">Submit</button>
                    <a href="{{ route('alb.berkas') }}" class="btn btn-lg btn-secondary">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('bottom-script')
<script>
    $(function() {
        "use strict";
        
        $('.custom-file-input').on('change',function(){
            var fileName = $(this)[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })

        $("#form-berkas").on("submit", function(e) {
            e.preventDefault();
            var form=$("body");
            form.find('.invalid-feedback').remove();
            $('input').removeClass('is-invalid');
            
            $.ajax({
                url: "{{ route('alb.berkas') }}",
                type: "POST",
                dataType: "json",
                data: new FormData(this),
                processData: false,
				contentType: false,
                beforeSend() {
                    $("input").attr('disabled', 'disabled');
                    $("button").attr('disabled', 'disabled');
                    $("select").attr('disabled', 'disabled');
                    $('input').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                },
                complete(){
                    $("input").removeAttr('disabled', 'disabled');
                    $("button").removeAttr('disabled', 'disabled');
                    $("select").removeAttr('disabled', 'disabled');
                },
                success(result){
                                        
                    iziToast.success({
                        title: result.status,
                        message: result.message,
                        position: 'topRight'
                    });
                },
                error(xhr, status, error) {
                    var err = eval('(' + xhr.responseText + ')');
                    iziToast.error({
                        title: 'Error',
                        message: err.message,
                        position: 'topRight'
                    });
                },
                error:function (response){
                    $.each(response.responseJSON.errors,function(key,value){
                        $("input[name="+key+"]").addClass('is-invalid').after('<div class="invalid-feedback">'+value+'</div>');
                    })
                }
            });
        });
    });
</script>
@endsection