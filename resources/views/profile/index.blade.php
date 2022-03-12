@extends('layouts.app')

@section('top-script')
<style>
#profile-picture-upload {
    display: none;
}

#profile-picture{
    cursor: pointer;
    width: 100px;
    height: 100px;
	object-fit: cover;
}

</style>
@endsection
@section('body')
@section('title','Halo, '.$user->name)
<div class="section-body">
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">                     
                    <img alt="image" src="assets/img/avatar/avatar-1.png" id="profile-picture" class="rounded-circle profile-widget-picture">
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        {{ $user->name }}
                        <div class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> Web Developer
                        </div>
                    </div>
                    Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
                </div>
                <form>
                    <input id="profile-picture-upload" type="file" name="profile-picture-upload" placeholder="Photo" onchange="loadFile(event)">
                </form>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4>Edit</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil" role="tab" aria-controls="profil" aria-selected="true">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                            <form method="POST" action="#" id="form-update-profile">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-6">
                                    <label for="nama">Nama</label>
                                    <input id="nama" type="text" class="form-control" name="nama" value="{{ $user->name }}">
                                </div>
                                <div class="form-group col-md-12 col-lg-6">
                                    <label for="nik">NIK</label>
                                    <input id="nik" type="text" class="form-control" name="nik"  value="{{ $user->nik }}" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-6">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email"  value="{{ $user->email }}">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-lg-6">
                                    <label for="no_telp">No Telepon / WhatsApp</label>
                                    <input id="no_telp" type="text" class="form-control" name="no_telp"  value="{{ $user->wa }}">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-4">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <select class="form-control" name="provinsi_lahir" id="provinsi_lahir" required>
                                        <option>- Provinsi -</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id ?? '' }}" @if ($user->provinsi_lahir==$item->id) selected @endif>{{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-lg-4">
                                    <label for="tempat_lahir">&nbsp;</label>
                                    <select class="form-control selectric" id='tempat_lahir' name='tempat_lahir'>
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-lg-4">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input id="tgl_lahir" type="text" class="form-control datepicker" name="tgl_lahir" value="{{ $user->tgl_lahir }}">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-6">
                                    <label>Provinsi</label>
                                    <select class="form-control" name="provinsi" id="provinsi" required>
                                        <option>- Provinsi -</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id ?? '' }}"  @if ($user->provinsi==$item->id) selected @endif>{{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-12 col-lg-6">
                                    <label>Kab/Kota</label>
                                    <select class="form-control selectric" id='kota' name='kota'>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" id='btn-update-profile' class="btn btn-primary btn-lg btn-block">
                                    Update Profil
                                </button>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <form id='form-update-password' action="#" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-12 col-lg-6">
                                        <label for="password" class="d-block">Password Sekarang</label>
                                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="current_password" autocomplete="off">
                                        <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-lg-6">
                                        <label for="password" class="d-block">Password Baru</label>
                                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" autocomplete="off">
                                        <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 col-lg-6">
                                        <label for="password2" class="d-block">Konfirmasi Password Baru</label>
                                        <input id="password2" type="password" class="form-control" name="password_confirm"  autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id='btn-update-profile' class="btn btn-primary btn-lg btn-block">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@section('bottom-script')
<script>
    $(function() {
        "use strict";
        $("#form-update-profile").on("submit", function(e) {
            e.preventDefault();
            updateProfile();
        });

        $("#form-update-password").on("submit", function(e) {
            e.preventDefault();
            updatePassword();
        });

        var prov = '{{ $user->provinsi }}';
        var kota = '{{ $user->kota }}';
        onChangeSelect('{{ route("cities") }}', prov, 'kota', kota);
        
        var prov_lahir = '{{ $user->provinsi_lahir }}';
        var tempat_lahir = '{{ $user->tempat_lahir }}';
        onChangeSelect('{{ route("cities") }}', prov_lahir, 'tempat_lahir', tempat_lahir);
        
        $('#provinsi').on('change', function () {
            onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
        });

        $('#provinsi_lahir').on('change', function () {
            onChangeSelect('{{ route("cities") }}', $(this).val(), 'tempat_lahir');
        });

        $("#profile-picture").click(function(e) {
            $("#profile-picture-upload").click();
        });

        
    });

    function loadFile(event){
        var output = document.getElementById('profile-picture');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function(){
            URL.revokeObjectURL(output.src)
        }
    }

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

    function updateProfile(){
        var formData = $("#form-update-profile").serialize();

        $.ajax({
            url: "{{ route('profile') }}",
            type: "POST",
            dataType: "json",
            data: formData,
            beforeSend() {
                // $("input").attr('disabled', 'disabled');
                // $("button").attr('disabled', 'disabled');
                // $("select").attr('disabled', 'disabled');
                $('input').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            },
            complete(){
                // $("input").removeAttr('disabled', 'disabled');
                // $("button").removeAttr('disabled', 'disabled');
                // $("select").removeAttr('disabled', 'disabled');
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
    }

    function updatePassword(){
        var formData = $('#form-update-password').serialize();
        $.ajax({
            url: "{{ route('profile.password') }}",
            type: "POST",
            dataType: "json",
            data: formData,
            beforeSend() {
                // $("input").attr('disabled', 'disabled');
                // $("button").attr('disabled', 'disabled');
                // $("select").attr('disabled', 'disabled');
                $('input').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            },
            complete(){
                // $("input").removeAttr('disabled', 'disabled');
                // $("button").removeAttr('disabled', 'disabled');
                // $("select").removeAttr('disabled', 'disabled');
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
    }
</script>
@endsection
@endsection