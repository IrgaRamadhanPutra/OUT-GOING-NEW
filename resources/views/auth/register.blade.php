@extends('admin.layout')
@section('breadcrumb')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Register</li>
        </ol>
    </nav>
@endsection('breadcrumb')
@section('content')
    <div class="card mb-6 login-card">
        <div class="card-body">
            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Register to Your Account</h5>
                {{-- <p class="text-center small">Enter your username & password to login</p> --}}
            </div>
            <form action="" class="custom-login-form" id="formLogin">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input id="nama" type="text" class="form-control" name="nama" pattern="[A-Za-z\s]+"
                            title="Only alphabetic characters are allowed" required autocomplete="nama">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email"
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" title="Enter a valid email address"
                            required autocomplete="email">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input id="nik" type="number" class="form-control" name="nik" required
                            autocomplete="nik">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="new-password">
                            <button class="btn btn-outline-secondary" type="button" id="password-toggle">
                                <i id="password-toggle-icon" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div> --}}
                <div class="card-footer bg-body-tertiary d-flex justify-content-between mt-3">
                    <button class="btn btn-primary col-8" style="background: rgb(16, 130, 175);"
                        id="addRegister">Save</button>
                    <button class="btn btn-secondary col-4">Reset</button>
                </div>
                {{-- @if (Route::has('password.request'))
                    <div class="mt-3">
                        <a class="btn btn-link" href="{{ route('password.request') }}">Forgot
                            Your Password?</a>
                    </div>
                @endif --}}
            </form>


        </div>
    </div>
    <script>
        $('#password-toggle').click(function() {
            var passwordInput = $('#password');
            var passwordToggleIcon = $('#password-toggle-icon');

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                passwordToggleIcon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                passwordToggleIcon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
        // $(document).ready(function() {
        //     $('#nama').focus();
        //     $('#addRegister').click(function(event) {
        //         // Menghentikan pengiriman form agar dapat melakukan validasi
        //         event.preventDefault();

        //         // Lakukan validasi form
        //         var nama = $('#nama').val();
        //         var email = $('#email').val();
        //         var nik = $('#nik').val();
        //         var password = $('#password').val();

        //         if (nama === '' || email === '' || nik === '' || password === '') {
        //             alert('Semua field harus diisi.');
        //         } else {
        //             // Jika semua field terisi, kirim form
        //             // this.submit();
        //             // alert('lanjut');
        //             $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //             });
        //             $.ajax({
        //                 url: "{{ route('addRegister') }}",
        //                 type: "POST",
        //                 data: $('#formLogin').serialize(),
        //                 dataType: 'json',
        //                 success: function(data) {
        //                     const succesAlert = document.getElementById("succesAlert");
        //                     $('#nama').val("");
        //                     $('#email').val("");
        //                     $('#nik').val("");
        //                     $('#password').val("");
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: 'Successfully!',
        //                         text: 'Data berhasil ditambahkan',
        //                         timer: 3000
        //                     }).then(function() {
        //                         // $('#create_kategori').card('hide');
        //                         // $('##masterStaff-datatables').DataTable().ajax.reload();
        //                         $('#nama').focus();
        //                         // $('#tableMaster')
        //                         //     .DataTable().ajax.reload();
        //                     });
        //                     // // console.log(data);
        //                     // clear_Masteradd();
        //                     // Swal.fire({
        //                     //     icon: 'success',
        //                     //     title: 'Successfully!',
        //                     //     text: 'Data berhasil ditambahkan',
        //                     //     timer: 3000
        //                     // }).then(function() {
        //                     //     $('#create_kategori').modal('hide');
        //                     //     // $('##masterStaff-datatables').DataTable().ajax.reload();
        //                     //     $('#masterdata-kategori-datatables')
        //                     //         .DataTable().ajax.reload();
        //                     // });
        //                 }
        //             });
        //         }
        //     });
        // });
        $(document).ready(function() {
            // Set focus to the "nama" input field when the page loads
            $('#nama').focus();

            // Attach a click event handler to the "Save" button with the id "addRegister"
            $('#addRegister').click(function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();

                // Retrieve values from input fields
                var nama = $('#nama').val();
                var email = $('#email').val();
                var nik = $('#nik').val();
                var password = $('#password').val();

                // Check if any of the fields are empty
                if (nama === '' || email === '' || nik === '' || password === '') {
                    alert('Semua field harus diisi.'); // Display an alert if any field is empty
                } else {
                    // If all fields are filled, you might proceed with form submission
                    // However, the actual form submission code is currently commented out
                    // this.submit();
                    // alert('lanjut');
                    $.ajax({
                        url: "{{ route('addRegister') }}",
                        type: "POST",
                        data: $('#formLogin').serialize(),
                        dataType: 'json',
                        success: function(data) {
                            $('#nama').val("");
                            $('#email').val("");
                            $('#nik').val("");
                            $('#password').val("");
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully!',
                                text: 'Data berhasil ditambahkan',
                                timer: 3000
                            }).then(function() {
                                // $('#create_kategori').card('hide');
                                // $('##masterStaff-datatables').DataTable().ajax.reload();
                                $('#nama').focus();
                                // $('#tableMaster')
                                //     .DataTable().ajax.reload();
                            });
                            // // console.log(data);
                            // clear_Masteradd();
                            // Swal.fire({
                            //     icon: 'success',
                            //     title: 'Successfully!',
                            //     text: 'Data berhasil ditambahkan',
                            //     timer: 3000
                            // }).then(function() {
                            //     $('#create_kategori').modal('hide');
                            //     // $('##masterStaff-datatables').DataTable().ajax.reload();
                            //     $('#mastc
                        }
                    })

                }
            });
        });
    </script>
@endsection
