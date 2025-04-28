@extends('admin.layout')
@section('title')
    SCAN OUT GOING
@endsection
@section('breadcrumb')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Dashboard</a></li>
            <li class="breadcrumb-item text-danger">Scan Out Going</li>
        </ol>
    </nav>
    {{-- <hr> --}}
@endsection('breadcrumb')
@section('content')
    <div class="card shadow mt-3" id="card1">
        <div class="card-body mt-2">
            <form id="form_out_going">
                @csrf
                {{-- <span class="text-center">REQUEST QTY</span> --}}
                <div class="form-outline mb-2 position-relative">
                    <h3 id="po-label" class="text-danger mt-2"><b><i>*Po No*</i></b></h3>
                    <span id="po-display" class="text-success position-absolute top-0 end-0"
                        style="font-size: 14px;"></span>
                </div>

                <div class="form-outline mb-4" id="po-input-container">
                    <input type="text" class="form-control" id="input1" name="input1" required style="width: 100%;">
                </div>

                <div class="form-outline mb-4 d-none" id="kanban-container">
                    <h3 class="text-danger mt-2"><b><i>*Kanban No*</i></b></h3>
                    <input type="text" class="form-control" id="input2" name="input2" required style="width: 100%;">
                </div>


                <div class="table-responsive">
                    <table id="tbl_outgoing" class="table  table-hover bg-primary" style="width:99.5%">
                        <thead class="text-center" style="text-transform: uppercase; font-size: 12px;">
                            <tr>
                                <th scope="col"
                                    style="width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Itemcode</th>
                                <th scope="col"
                                    style="width:150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Part No</th>
                                <th scope="col"
                                    style="width: 500px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Part Name</th>

                                <th scope="col"
                                    style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Seq</th>
                                <th scope="col"
                                    style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Qty</th>
                                <th scope="col"
                                    style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Sloc</th>
                                <th scope="col"
                                    style="width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Action</th>
                            </tr>

                        </thead>
                        <tbody id="body">
                            <!-- Isi tabel disini -->
                        </tbody>
                    </table>
                </div>

                <br>
                <div class="form-group d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-primary" id="post" style="font-size: 15px;">GET BPB</button>
                    <button type="button" class="btn btn-secondary" id="clear" style="font-size: 15px;">CLEAR</button>
                </div>

        </div>
        <audio id="Audiosucces" src="{{ asset('audio\succes.mp3') }}"></audio>
        <audio id="Audioerror" src="{{ asset('audio\error.mp3') }}"></audio>
        <div class="loading-spinner-container">
            <div class="loading-spinner"></div>
            <span>Loading..</span>
        </div>
        </form>
    </div>
    </div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    @include('scan-out-going.ajax')
@endsection('content')
