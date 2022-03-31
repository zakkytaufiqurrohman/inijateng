<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; INI Jateng</title>

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
                                <form id='form-search' action="javascript:void(0)" method="POST" enctype="multipart">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="nik">Inputan NIK</label>
                                            <input id="nik" type="text" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <select class="form-control" name="semester" id="semester">
                                                <option value="1">Semester 1</option>
                                                <option value="2">Semester 2</option>
                                                <option value="3">Semester 3</option>
                                                <option value="4">Semester 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="btn-form-search">
                                        <button type="submit" id='btn-register' class="btn btn-primary btn-lg btn-block">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                                <!-- setelah sukses -->
                                <form id='form-register' class='d-none' action="javascript:void(0)" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{$id}}">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="nik-register">Inputan NIK</label>
                                            <input id="nik-register" type="text" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <select class="form-control" name="semester" id="semester-register">
                                                <option value="1">Semester 1</option>
                                                <option value="2">Semester 2</option>
                                                <option value="3">Semester 3</option>
                                                <option value="4">Semester 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="bukti_bayar">Bukti Bayar</label>
                                            <input id="bukti_bayar_register" type="file" class="form-control" name="bukti_bayar" placeholder="Bukti bayar">
                                            <span>*Maksimal File 1 Mb (Format jpg, png)</span>
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
                            Copyright {{date('Y')}} © Ikatan Notaris Indonesia Pengurus Wilayah Jawa Tengah. All rights reserved</a>
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
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>


    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- toast -->
    <script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
    </script>
    <script>
        $(function() {
            "use strict";

            $("#form-search").on("submit", function(e) {
                e.preventDefault();
                searchUser();
            });
        });

        function to(url){
            window.location.href = url;
        }

        function searchUser(){
            var formData = $("#form-search").serialize();

            $.ajax({
                url: "{{ route('event_magber.check') }}",
                type: "POST",
                dataType: "json",
                data: formData,
                beforeSend() {
                    $("#btn-register").addClass("btn-progress");
                    // $("#semester-register option:not(:selected)").prop("disabled", true);

                    // $("#semester-register").attr('disabled', 'disabled');
                },
                complete(){
                    $("#btn-register").removeClass("btn-progress");
                },
                success(result){
                    mess = result.message;
                    if(result.status =='error'){
                        swal({
                            title: 'Data Belum Lengkap',
                            text: 'Silahkan Login dan lengkapi data terlebih dahulu',
                            icon: 'error',
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                to('/login');
                            }
                        });
                    }
                    if(result.status=='ready'){
                        swal({
                            title: 'Sudah Terdaftar',
                            text: 'Anda Sudah Terdaftar Di Event Ini Silahkan Cek Email',
                            icon: 'error',
                            buttons: true,
                            dangerMode: true,
                        })
                        
                    }
                    if(result.status =='success'){
                        $('#form-search').addClass('d-none');
                        $('#form-register').removeClass('d-none');
                        $('#nik').attr('readonly',true);

                        $('#user_id').val(mess.id);
                        $('#nik-register').val( $("#nik").val());
                        $('#semester-register').val( $("#semester").val()).trigger('change');
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

        $("#form-register").on("submit", function(e) {
            var form=$("body");
            form.find('.invalid-feedback').remove();
            form.find('.form-group').removeClass('is-invalid');
            $.ajax({
                url: "{{ route('event_magber_store') }}",
                type: "POST",
                dataType: "json",
                processData: false,
                contentType: false,
                data:  new FormData(this),
                beforeSend() {
                    $("#btn-register").addClass("btn-progress");
                },
                complete(){
                    $("#btn-register").removeClass("btn-progress");
                },
                success(result){
                    $("#form-register")[0].reset();
                                        
                    if(result.status != 'success'){
                        iziToast.error({
                            title: result.status,
                            message: result.message,
                            position: 'topRight'
                        });
                    }
                    else {
                        var url = '{{ route("event_magber.success", ":id") }}';
                        url = url.replace(':id', result.data);
                        to(url)  
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
        })
    </script>
</body>

</html>