<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>Dashboard - NiceAdmin Bootstrap Template</title> --}}
    <title> @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- Favicon and Apple Touch Icon -->
    <link href="{{ asset('assets/img/logo3.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo4.png') }}" rel="apple-touch-icon">

    <link rel="stylesheet" href="{{ asset('assets\fontawesome-free-6.2.1\css\all.css') }}">


    <!-- Google Fonts -->
    {{-- <link href="https://fonts.gstatic.com" rel="preconnect"> --}}

    {{-- C:\xampp\dashboard_niceAdmin\dashboard\public\assets\css\family.css --}}
    <link href="{{ asset('assets/css/family.css') }}" rel="stylesheet">
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"> --}}

    <!-- Vendor CSS Files -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Link CSS Select2 -->
    <link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery1.dataTables.min.css') }}" rel="stylesheet">
    <!-- Header bagian lainnya -->
    {{-- <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">



    {{-- penempatan jqeury harus di atas jquery datatables --}}
    <!-- jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
    {{-- <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>


    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    {{--  --}}
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}

    {{-- yang ke dua script  --}}


    <!-- Vendor CSS Files -->
    {{-- ini cdn  --}}
    {{-- <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet"> --}}
    {{-- ini public --}}
    <link rel="stylesheet" href="{{ asset('assets/css/css.css') }}">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<style>
    .card-header.hoverable:hover {
        background-color: #000000;

        cursor: pointer;
    }

    html,
    body {
        height: 100%;
    }

    /* Create a flex container for the page layout */
    #page-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        /* Use vh (viewport height) to ensure min-height covers the whole viewport */
    }

    /* Push the footer to the bottom */
    #main {
        flex: 1;
        /* Flex to take up remaining space */
    }

    /* Style your footer as needed */
    #footer {
        /* Your footer styling */
    }



    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* loading */
    .loading-spinner-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        z-index: 9999;
    }

    .loading-spinner {
        border: 10px solid rgba(0, 0, 0, 0.3);
        border-top: 10px solid #1371af;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }



    /* css untuk sideber */
    .nav-item.active .nav-link.collapsed {
        background: rgb(19, 95, 135);
        background: linear-gradient(90deg, rgba(19, 95, 135, 0) 0%, rgba(0, 22, 142, 0.32816876750700286) 100%);

    }

    .nav-item.active .nav-link.collapsed span {
        display: inline-block;

        padding: 5px;

        border-radius: 4px;

    }

    /* Styles for cardSearchitemcode and cardSearchchuter */
    #cardSearchitemcode,
    #cardSearchchuter {
        display: none;
        /* Initially hide the card */
        opacity: 0;
        /* Set opacity to 0 for animation */
        transition: opacity 0.5s ease;
        /* Animate opacity */
    }

    #cardSearchitemcode.show,
    #cardSearchchuter.show {
        display: block;
        /* Show the card */
        opacity: 1;
        /* Fade in */
    }

    #cardSearchitemcode.hide,
    #cardSearchchuter.hide {
        opacity: 0;
        /* Fade out */
        pointer-events: none;
        /* Prevent interaction during fade out */
    }
</style>

<body>
    <div id="page-container">
        <!-- Header -->
        <header id="header" class="header fixed-top d-flex align-items-center"
            style="background: #020024;
background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(93, 93, 97, 1) 37%, rgba(89, 118, 133, 1) 100%);">

            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="assets/img/logo4.png" alt="" style="width: 15%">
                    {{-- <span class="d-none d-lg-block text-white">ADMINISTRATOR</span> --}}
                </div>
                <i class="bi bi-list toggle-sidebar-btn text-white ml-3"></i>
            </div><!-- End Logo -->


            {{--   <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="POST" action="#">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div><!-- End Search Bar --> --}}

            <nav class="header-nav ms-auto">
                @include('admin.navbar')
            </nav><!-- End Icons Navigation -->
            <!-- ... Your header content ... -->
        </header>

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-body-tertiary">
            <!-- ... Your sidebar content ... -->
            @include('admin.sidebar')
        </aside>

        <!-- Main Content -->
        <main id="main" class="main">
            <!-- ... Your main content ... -->
            <div class="pagetitle">

                @yield('breadcrumb')

            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">
                    @yield('content')

                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer id="footer" class="footer">
            <!-- ... Your footer content ... -->
            <div class="copyright">
                &copy; Copyright <strong><span></span>{{ date('Y') }}</strong> All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Developed by IT Dept <a href="">PT Trimitra Chitrahasta.</a>
            </div>
        </footer>
    </div>

    <!-- ... Your scripts ... -->
    <!-- Vendor JS Files -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    {{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/datatables.js') }}"></script> --}}
    <script src="{{ asset('assets/js/sweetalert2@11.6.15.all.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/datatables.min.js') }}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> --}}
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Tambahkan DataTables script dan jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <!-- Template Main JS File -->
    {{-- <script src="assets/js/main.js"></script> --}}

    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- select2  --}}
    <script src="{{ asset('assets/js/select2.js') }}"></script>
</body>


</html>
