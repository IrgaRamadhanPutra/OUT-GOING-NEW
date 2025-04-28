@extends('admin.layout')
@section('title')
    DASHBOARD OUT GOING
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">Home</li> --}}
            <li class="breadcrumb-item ">Dashboard</li>
        </ol>
    </nav>
@endsection('breadcrumb')
@section('content')
    {{-- @section('content') --}}
    {{-- <div class="col-lg-12">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card chuter-card shadow">

                    <div class="card-body card-button border-top">
                        <h5 class="card-title text-center">CHUTER LANTAI 1</h5>
                        <a href="{{ route('index_chuter1_Abnormality') }}" class="btn btn-primary"
                            style="background: rgb(8, 50, 129)">
                            <span>Klik Disini</span>
                            <i class="bi bi-hand-index-thumb-fill"></i>
                        </a>

                    </div>



                </div>

            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card chuter-card shadow">
                    <div class="card-body card-button border-top">
                        <h5 class="card-title text-center">CHUTER LANTAI 2</h5>
                        <a href="{{ route('index_chuter2_Abnormality') }}" class="btn btn-primary"
                            style="background: rgb(8, 50, 129)">
                            <span>Klik Disini</span>
                            <i class="bi bi-hand-index-thumb-fill"></i>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $(".card-button").hover(
                function() {
                    $(this).addClass("hovered");
                },
                function() {
                    $(this).removeClass("hovered");
                }
            );
        });
    </script>
@endsection('content')

{{-- @endsection --}}
