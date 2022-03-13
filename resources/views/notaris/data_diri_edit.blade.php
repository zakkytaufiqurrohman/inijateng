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
                            <label for="npwp">NPWP</label>
                            <input id="npwp" type="text" class="form-control" name="npwp"  value="{{ $user->npwp }}" >
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="telephone">No. Telp</label>
                            <input id="telephone" type="text" class="form-control" name="telephone"  value="{{ $user->telephone }}" >
                        </div> 
                      
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="no_kta_ini">No. KTA INI</label>
                            <input id="no_kta_ini" type="text" class="form-control" name="no_kta_ini"  value="{{ $user->no_kta_ini }}" >
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="no_kta_ppt">No. KTA PPT</label>
                            <input id="no_kta_ppt" type="text" class="form-control" name="no_kta_ppt"  value="{{ $user->no_kta_ppt }}" >
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="no_sk_notaris">No. SK Notaris</label>
                            <input id="no_sk_notaris" type="text" class="form-control" name="no_sk_notaris"  value="{{ $user->no_sk_notaris }}" >
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="asal_pengda">Asal Pengda</label>
                            <select class="form-control selectric" id='asal_pengda' name='asal_pengda'>
                            </select>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="alamat">Alamat Kantor</label>
                            <textarea id="alamat" type="text" class="form-control" name="alamat" rows="4" cols="50">{{ $user->alamat_kantor }}</textarea>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ktp_img">Foto KTP</label>
                            <div class="custom-file">
                                <input id="ktp_img" type="file" class="custom-file-input" name="ktp_img" >
                                <label class="custom-file-label" for="ktp_img">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="sk_notaris">SK Notaris</label>
                            <div class="custom-file">
                                <input id="sk_notaris" type="file" class="custom-file-input" name="sk_notaris" >
                                <label class="custom-file-label" for="sk_notaris">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format PDF)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="sk_ppt">SK PPT</label>
                            <div class="custom-file">
                                <input id="sk_ppt" type="file" class="custom-file-input" name="sk_ppt" >
                                <label class="custom-file-label" for="sk_ppt">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format PDF)</span>
                        </div> 
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="scan_npwp">Scan NPWP</label>
                            <div class="custom-file">
                                <input id="scan_npwp" type="file" class="custom-file-input" name="scan_npwp" >
                                <label class="custom-file-label" for="scan_npwp">Choose file</label>
                            </div>
                            <span>*Kosongi apabila data tidak ingin diubah (Format jpg, png)</span>
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
@section('bottom-script')
<script>
    $(function() {
        "use strict";
        // $("#form-data-diri").on("submit", function(e) {
        //     e.preventDefault();
        //     submitData();
        // });
        onChangeSelect('{{ route("cities") }}', 13, 'asal_pengda', '{{ $user->asal_pengda }}');
        
        $('#ktp_img').on('change',function(){
            var fileName = $('#ktp_img')[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })

        $('#sk_notaris').on('change',function(){
            var fileName = $('#sk_notaris')[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })

        $('#sk_ppt').on('change',function(){
            var fileName = $('#sk_ppt')[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })

        $('#scan_npwp').on('change',function(){
            var fileName = $('#scan_npwp')[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })

        $("#form-data-diri").on("submit", function(e) {
            e.preventDefault();
            var form=$("body");
            form.find('.invalid-feedback').remove();
            $('input').removeClass('is-invalid');
            
            $.ajax({
                url: "{{ route('notaris.data_diri') }}",
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

    function onChangeSelect(url, id, name, val=null) {
        // send ajax request to get the cities of the selected province and append to the select tag
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function (data) {
                $('#' + name).empty();
                $('#' + name).append('<option>- Pilih Salah Satu -</option>');

                $.each(data, function (key, value) {
                    var sel = '';
                    if(val==key) var sel = 'selected'; 
                    
                    $('#' + name).append('<option value="' + key + '" '+sel+'>' + value + '</option>');
                });
            }
        });
    }
</script>
@endsection