<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; IPPAT</title>

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
                            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="70" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary mb-3">
                            <div class="card-header">
                                <h4>Pengwil Jateng Ikatan Notaris Indonesia</h4>
                            </div>

                            <div class="card-body">
                                <form id='form-search' action="javascript:void(0)" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="nik">Inputan Nomor NIK</label>
                                            <input id="nik" type="text" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan">
                                        </div>
                                    </div>
                                    <div class="form-group" id='btn-form-search'>
                                        <button type="submit" id='btn-search' class="btn btn-primary btn-lg btn-block">
                                            Cari
                                        </button>
                                    </div>
                                </form>
                                <form id='form-register' class='d-none' action="javascript:void(0)" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="email">Nama</label>
                                            <input id="nama" type="text" readonly class="form-control" name="nama" placeholder="nama">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="email">Email</label>
                                            <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                                            <input id="user_id" type="hidden" class="form-control" name="user_id" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password   <div class="far fa-eye" id="togglePassword" style="margin-left: 0px; cursor: pointer;"></div></label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" autocomplete="off">
                                            <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password_confirm" class="d-block">Konfirmasi Password <div class="far fa-eye" id="togglePassword1" style="margin-left: 0px; cursor: pointer;"></div></label>
                                            <input id="password_confirm" type="password" class="form-control" name="password_confirm"  autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id='btn-register' class="btn btn-primary btn-lg btn-block">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                        Copyright &copy;2021 - {{date('Y')}} IPPAT
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
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        // konfirmasi
        const togglePassword1 = document.querySelector('#togglePassword1');
        const password1 = document.querySelector('#password_confirm');
        
        togglePassword1.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
            password1.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
        $(function() {
            "use strict";
            $("#form-search").on("submit", function(e) {
                e.preventDefault();
                searchUser();
            });

            $("#form-register").on("submit", function(e) {
                e.preventDefault();
                register();
            });
        });

        function to(url){
            window.location.href = url;
        }

        function searchUser(){
            var formData = $("#form-search").serialize();

            $.ajax({
                url: "{{ route('register.check') }}",
                type: "POST",
                dataType: "json",
                data: formData,
                beforeSend() {
                    $("input").attr('disabled', 'disabled');
                    $("button").attr('disabled', 'disabled');
                    $('input').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                },
                complete(){
                    $("input").removeAttr('disabled', 'disabled');
                    $("button").removeAttr('disabled', 'disabled');
                },
                success(result){
                    mess = result.message;
                    if(result.status!='success'){
                        $("input[name='nik']").addClass('is-invalid').after('<div class="invalid-feedback">'+mess+'</div>')
                    }else{
                        if(mess.is_check!=1){
                            $('#btn-form-search').addClass('d-none');
                            $('#form-register').removeClass('d-none');
                            $('#nik').attr('readonly',true);

                            $('#user_id').val(mess.id);
                            $('#email').val(mess.email);
                            $('#nama').val(mess.name);
                            $('#password').val('');
                            $('#password_confirm').val('');
                        }else{
                            to("{{ route('login') }}");
                        }
                    }
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

                    to('{{ route("dashboard") }}')                    
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