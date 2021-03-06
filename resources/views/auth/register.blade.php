<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; INi Jateng</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/select2/dist/css/select2.min.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="150" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <form id='form-register' action="javascript:void(0)" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nama">Nama</label>
                                            <input id="nama" type="text" class="form-control" name="nama" autofocus>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nik">NIK</label>
                                            <input id="nik" type="text" class="form-control" name="nik">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="npwp">NPWP</label>
                                            <input id="npwp" type="text" class="form-control" name="npwp">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="no_telp">No Telepon / WhatsApp</label>
                                            <input id="no_telp" type="text" class="form-control" name="no_telp">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <select class="form-control" name="provinsi_lahir" id="provinsi_lahir" required>
                                                <option>- Provinsi -</option>
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="tempat_lahir">&nbsp;</label>
                                            <select class="form-control selectric" id='tempat_lahir' name='tempat_lahir'>
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input id="tgl_lahir" type="text" class="form-control datepicker" name="tgl_lahir">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="alamat">Alamat Kantor</label>
                                            <input id="alamat" type="text" class="form-control" name="alamat">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="telp_kantor">No Telepon Kantor</label>
                                            <input id="telp_kantor" type="text" class="form-control" name="telp_kantor">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Provinsi</label>
                                            <select class="form-control" name="provinsi" id="provinsi" required>
                                                <option>- Provinsi -</option>
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-6">
                                            <label>Kab/Kota</label>
                                            <select class="form-control selectric" id='kota' name='kota'>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" autocomplete="off">
                                            <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Konfirmasi Password</label>
                                            <input id="password2" type="password" class="form-control" name="password_confirm"  autocomplete="off">
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                            <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <button type="submit" id='btn-register' class="btn btn-primary btn-lg btn-block">
                                          Register
                                        </button>
                                    </div>
                                    <div class="mt-5 text-muted text-center">
                                        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                        Copyright {{date('Y')}} ?? Ikatan Notaris Indonesia Pengurus Wilayah Jawa Tengah. All rights reserved</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- toast -->
    <script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('node_modules/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            "use strict";
            $("#form-register").on("submit", function(e) {
                e.preventDefault();
                register();
            });

            $('#tgl_lahir').val('');
            $('#btn-register').attr('disabled',true);

            $('#btn-register').prop('disabled', !$('#agree:checked').length);//initially disable/enable button based on checked length
            $('input[type=checkbox]').click(function() {
                if ($('#agree:checkbox:checked').length > 0) {
                    $('#btn-register').prop('disabled', false);
                } else {
                    $('#btn-register').prop('disabled', true);
                }
            });

            $('#provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            });

            $('#provinsi_lahir').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'tempat_lahir');
            });
            // $('#kota').on('change', function () {
            //     onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            // })
            // $('#kecamatan').on('change', function () {
            //     onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
            // })
        });

        function onChangeSelect(url, id, name) {
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
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }

        function register(){
            var formData = $("#form-register").serialize();

            $.ajax({
                url: "{{ route('register') }}",
                type: "POST",
                dataType: "json",
                data: formData,
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
                    $("#form-register")[0].reset();
                                        
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
</body>

</html>