<!-- @extends('layouts.base') -->

@section('body')

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
<main>
    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            <!-- <p class="text-center">
                <a href="{{ url('/home') }}" class="d-flex align-items-center justify-content-center">
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                    Back to homepage
                </a>
            </p> -->
            <div class="row justify-content-center form-bg-image">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">IPPAT</h1>
                        </div>
                        <form id="form-login" action="" class="mt-4">
                            @csrf
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="nik">Nik</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                    </span>
                                    <input type="number" class="form-control" name="nik" placeholder="Masukkan NIK" id="nik" autofocus required>
                                </div>  
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password"> Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        <input type="password"  name = "password" placeholder="Password" class="form-control" id="password" required>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="d-flex justify-content-between align-items-top mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="remember">
                                        <label class="form-check-label mb-0" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <div><a href="./forgot-password.html" class="small text-right">Lupa Password?</a></div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">Sign in</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">
                                Not registered?
                                <a href="{{ route('register') }}" class="fw-bold">Create account</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@section('bottom-script')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

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
                url: "{{route('login')}}",
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
                        iziToast.success({
                            title: "success",
                            message: result.message,
                            position: 'topRight'
                        });
                        window.location = "/home";
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: result.message,
                            position: 'topRight'
                        });
                    }
                },
                error(xhr, status, error) {
                    var err = eval('(' + xhr.responseText + ')');
                    iziToast.success({
                            title: "error",
                            message: err.message,
                            position: 'topRight'
                    });
                }
            });
        }
    </script>
@endsection
@endsection