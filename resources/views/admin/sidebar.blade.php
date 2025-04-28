{{-- <ul class="sidebar-nav" id="sidebar-nav" style="background: rgb(255, 187, 42);"> --}}
<!-- Sidebar Navigation -->
<ul class="sidebar-nav bg-body-tertiary mt-2" id="sidebar-nav">

    <!-- Chutter Option -->
    <ul class="sidebar-nav bg-body-tertiary mt-4 " id="sidebar-nav">
        <li class="nav-item mt-4 {{ Request::is('index_out_going') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('index_out_going') }}">
                <i class="bi bi-arrow-left-square-fill"></i>

                <span>Scan Out Going</span>
            </a>
        </li><!-- End Login Page Nav -->
        <li class="nav-item mt-4 {{ Request::is('index_bpb') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('index_bpb') }}">
                <i class="bi bi-file-earmark-fill"></i>
                <span>Bpb Generate</span>
            </a>
        </li>
    </ul>

</ul>
