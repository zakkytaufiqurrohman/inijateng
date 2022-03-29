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
                <form id='form-data-diri' action="javascript(0)" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-header"> 
                    <h4>Update Data Diri</h4>                   
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="no_alb">No. ALB</label>
                            <input id="no_alb" type="text" class="form-control" name="no_alb"  value="{{ $user->no_alb }}" >
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="bukti_terdaftar">Bukti Terdaftar</label>
                            <div class="custom-file">
                                <input id="bukti_terdaftar" type="file" class="custom-file-input" name="bukti_terdaftar" >
                                <label class="custom-file-label text-truncate" for="bukti_terdaftar">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah, Format jpg/png, Ukuran Maximal 2MB</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="s1">S1</label>
                            <input id="s1" type="text" class="form-control" name="s1"  value="{{ $user->s1 }}" placeholder="Contoh : Universitas Diponegoro"  >
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="tgl_lulus_s1">Tgl Lulus S1</label>
                            <input id="tgl_lulus_s1" type="text" class="form-control datepicker" name="tgl_lulus_s1"  value="{{ $user->tgl_lulus_s1 }}" >
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="s2">S2</label>
                            <input id="s2" type="text" class="form-control" name="s2"  value="{{ $user->s2 }}" placeholder="Contoh : Universitas Diponegoro" >
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="tgl_lulus_s2">Tgl. Lulus S2</label>
                            <input id="tgl_lulus_s2" type="text" class="form-control datepicker" name="tgl_lulus_s2"  value="{{ $user->tgl_lulus_s2 }}" >
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ijazah_s1">Ijazah S1</label>
                            <div class="custom-file">
                                <input id="ijazah_s1" type="file" class="custom-file-input" name="ijazah_s1" >
                                <label class="custom-file-label text-truncate" for="ijazah_s1">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah, Format jpg/png, Ukuran Maximal 2MB</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ijazah_s2">Ijazah S2</label>
                            <div class="custom-file">
                                <input id="ijazah_s2" type="file" class="custom-file-input" name="ijazah_s2" >
                                <label class="custom-file-label text-truncate" for="ijazah_s2">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah, Format jpg/png, Ukuran Maximal 2MB</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-lg btn-primary">Submit</button>
                    <a href="{{ route('alb.data_diri') }}" class="btn btn-lg btn-secondary">Kembali</a>
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
        
        $('#bukti_terdaftar').on('change',function(){
            var fileName = $('#bukti_terdaftar')[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })

        $('#ijazah_s1').on('change',function(){
            var fileName = $('#ijazah_s1')[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })

        $('#ijazah_s2').on('change',function(){
            var fileName = $('#ijazah_s2')[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })

        $("#form-data-diri").on("submit", function(e) {
            e.preventDefault();
            var form=$("body");
            form.find('.invalid-feedback').remove();
            $('input').removeClass('is-invalid');
            
            $.ajax({
                url: "{{ route('alb.data_diri') }}",
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