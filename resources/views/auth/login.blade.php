<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {{-- <title>Pages / Login - NiceAdmin Bootstrap Template</title> --}}
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo3.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo4.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    {{-- <link href="https://fonts.gstatic.com" rel="preconnect"> --}}
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/family.css') }}" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Updated: Jul 27 2023 with Bootstrap v5.3.1
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<style>
    .login-card {
        border: none;
        /* Remove the default card border */
        background-color: #ffffff;
        /* Set a light background color */
        box-shadow: 0 4px 10px rgba(192, 176, 176, 0.1);
        /* Add a subtle box shadow */
        border-radius: 8px;
        /* Round the corners */
    }

    .login-form {
        margin: 0;
        /* Remove margin for a cleaner look */
        padding: 100px;
        /* Add some padding inside the card */
    }

    .login-button {
        width: 100%;
        /* Make the login button full-width */
        margin-top: 10px;
        /* Add a little space between the button and the form fields */
    }

    .custom-login-form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #161616;
        border-radius: 5px;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .custom-login-form .form-check {
        margin-top: 10px;
    }

    .custom-login-form .btn-primary {
        width: 100%;
    }

    .custom-login-form .btn-link {
        display: block;
        text-align: center;
        color: #2ac952;
    }

    .custom-login-form .btn-link:hover {
        text-decoration: underline;
    }

    .custom-input {
        position: absolute;
    }
</style>

<body style="background: rgb(92, 95, 104);">

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
                style="max-width: 100%;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            {{--  --}}


                            <div class="card mb-6 login-card py-2">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="text-center mb-2">
                                                <img src="assets/img/logo4.png" alt="" class="img-fluid"
                                                    style="max-width: 100px; max-height: 100px;">
                                                <h5 class="card-title fs-4 mt-2">Login to Your Account</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}" class="custom-login">
                                        @csrf

                                        <div class="mb-3">
                                            <div id="messageContainer">

                                                @if (Session::has('message'))
                                                    <span class="text-danger font-italic">
                                                        {{ Session::get('message') }}
                                                    </span>
                                                @endif
                                                <br>
                                                @if (Session::has('error'))
                                                    <span class="text-danger font-italic">
                                                        {{ Session::get('error') }}
                                                    </span>
                                                @endif

                                            </div>
                                            <label for="user" class="form-label">User</label>
                                            <input id="user" type="text"
                                                class="form-control rounded-pill @error('user') is-invalid @enderror"
                                                name="user" value="{{ old('user') }}" required
                                                autocomplete="user">
                                            @error('user')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password"
                                                class="form-control rounded-pill @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit"
                                                class="btn btn-secondary custom-button rounded-pill">Login</button>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <div class="mt-3">
                                                <a class="btn btn-link" style="border-radius: 50px"
                                                    href="{{ route('password.request') }}">Forgot Your Password?</a>
                                            </div>
                                        @endif
                                    </form>


                                </div>

                            </div>


                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                <span class="text-white">Development by </span><a href="">IT Trimita
                                    Chitrahasta</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
            <!-- Section: Design Block -->
            {{-- <section class="">
                <!-- Jumbotron -->
                <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
                    <div class="container">
                        <div class="row gx-lg-5 align-items-center">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <h1 class="my-5 display-3 fw-bold ls-tight">
                                    The best offer <br />
                                    <span class="text-primary">for your business</span>
                                </h1>
                                <p style="color: hsl(217, 10%, 50.8%)">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                                    quibusdam tempora at cupiditate quis eum maiores libero
                                    veritatis? Dicta facilis sint aliquid ipsum atque?
                                </p>
                            </div>

                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="card">
                                    <div class="card-body py-5 px-md-5">
                                        <form>
                                            <!-- 2 column grid layout with text inputs for the first and last names -->
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <input type="text" id="form3Example1" class="form-control" />
                                                        <label class="form-label" for="form3Example1">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <input type="text" id="form3Example2" class="form-control" />
                                                        <label class="form-label" for="form3Example2">Last name</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <input type="email" id="form3Example3" class="form-control" />
                                                <label class="form-label" for="form3Example3">Email address</label>
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-4">
                                                <input type="password" id="form3Example4" class="form-control" />
                                                <label class="form-label" for="form3Example4">Password</label>
                                            </div>

                                            <!-- Checkbox -->
                                            <div class="form-check d-flex justify-content-center mb-4">
                                                <input class="form-check-input me-2" type="checkbox" value=""
                                                    id="form2Example33" checked />
                                                <label class="form-check-label" for="form2Example33">
                                                    Subscribe to our newsletter
                                                </label>
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                                Sign up
                                            </button>

                                            <!-- Register buttons -->
                                            <div class="text-center">
                                                <p>or sign up with:</p>
                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fab fa-facebook-f"></i>
                                                </button>

                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fab fa-google"></i>
                                                </button>

                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fab fa-twitter"></i>
                                                </button>

                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fab fa-github"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Jumbotron -->
            </section> --}}
            <!-- Section: Design Block -->
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


</body>

</html>
