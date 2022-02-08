@extends('layouts.base')

@section('body')
<main>
    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image" >
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">{{ __('Daftar Akun') }}</h1>
                        </div>
                        <form id="form-register" action="" class="mt-4">
                            @csrf
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama" autofocus required autocomplete='off'>
                            </div>
                            <div class="form-group mb-4">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" placeholder="NIK" name="nik" id="nik" autofocus required autocomplete='off'>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email" autofocus required autocomplete='off'>
                            </div>
                            <div class="form-group mb-4">
                                <label for="npwp">NPWP</label>
                                <input type="text" class="form-control" placeholder="NPWP" name="npwp" id="npwp" autofocus required autocomplete='off'>
                            </div>
                            <div class="form-group mb-4">
                                <label for="phone_number">No. Telepon / WhatsApp</label>
                                <input type="text" class="form-control" placeholder="No. Telepon / WhatsApp" name="phone_number" id="phone_number" autofocus required autocomplete='off'>
                            </div>
                            <div class="form-group mb-4">
                                <label for="office_number">No. Telepon Kantor</label>
                                <input type="text" class="form-control" placeholder="No. Telepon Kantor" name="office_number" id="office_number" autofocus required autocomplete='off'>
                            </div>
                            <div class="form-group mb-4">
                                <label for="alamat">Alamat Kantor</label>
                                <input type="text" class="form-control" placeholder="Alamat Kantor" name="alamat" id="alamat" autofocus required autocomplete='off'>
                            </div>
                            <div class="form-group mb-4">
                                <label for="kota">Kota</label>
                                <select class="form-control" name="kota" id="kota" autofocus required autocomplete='off' >
                                    <option value="12">Semarang</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="provinsi">Provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi" autofocus required autocomplete='off' >
                                    <option value="12">Jawa Tengah</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type='date' class='form-control' name='tgl_lahir' id='tgl_lahir' autofocus required autocomplete='off'>
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password">Your Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        <input type="password" placeholder="Password" class="form-control" id="password" required>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="confirm_password">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        <input type="password" placeholder="Confirm Password" class="form-control" id="confirm_password" required>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="remember">
                                        <label class="form-check-label fw-normal mb-0" for="remember">
                                            I agree to the <a href="#" class="fw-bold">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">Sign up</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">
                                Sudah Punya Akun?
                                <a href="{{ route('login') }}" class="fw-bold">Login disini</a>
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
        $("#form-register").on("submit", function(e) {
            e.preventDefault();
            if ($("#nik").val().length == 0 || $("#nik").val().length == 0) {
                notification('error', 'Mohon isi semua field.');
                return false;
            }
            register();
        });
    });
</script>
@endsection
@endsection