<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Sparepart</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-social/bootstrap-social.css') }}"> -->

    <!-- Template CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}"> -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('assets/img/logo1.png') }}" alt="logo" width="150" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form id='form-login' method="POST" action="#" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nik">nik</label>
                                        <input id="nik" type="nik" class="form-control" name="nik" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            nik Tidak Boleh Kosong
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Passoword Tidak Boleh Kosong
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                        Copyright &copy;2021 - {{date('Y')}} PT Growell Indo Metal All Right Reserved designed by Stisla {{ Date('Y')}}
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

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- toast -->

    <script>
        $(function() {
            "use strict";
            $("#form-login").on("submit", function(e) {
                e.preventDefault();
                if ($("#nik").val().length == 0 || $("#nik").val().length == 0) {
                    notification('error', 'Mohon isi semua field.');
                    return false;
                }
                login();
            });
        });

        function login() {
            var formData = $("#form-login").serialize();
            $.ajax({
                url: "{{route('auth')}}",
                type: "POST",
                dataType: "json",
                data: formData,
                beforeSend() {
                    $("#btn-login").addClass("btn-progress");
                    $("input").attr("disabled", "disabled");
                    $("button").attr("disabled", "disabled");
                },
                complete() {
                    $("#btn-login").removeClass("btn-progress");
                    $("input").removeAttr("disabled", "disabled");
                    $("button").removeAttr("disabled", "disabled");
                },
                success(result) {
                    if (result['status'] == 'success') {
                        // iziToast.success({
                        //     title: "success",
                        //     message: result.message,
                        //     position: 'topRight'
                        // });
                        window.location = "/";
                    } else {
                        // iziToast.error({
                        //     title: "Error",
                        //     message: result.message,
                        //     position: 'topRight'
                        // });
                    }
                },
                error(xhr, status, error) {
                    var err = eval('(' + xhr.responseText + ')');
                    // iziToast.success({
                    //         title: "error",
                    //         message: err.message,
                    //         position: 'topRight'
                    // });
                }
            });
        }
    </script>
</body>

</html>