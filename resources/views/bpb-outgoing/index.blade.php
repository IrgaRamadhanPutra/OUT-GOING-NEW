@extends('admin.layout')
@section('title')
    BPB GENERATOR
@endsection
@section('breadcrumb')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Dashboard</a></li>
            <li class="breadcrumb-item text-danger">Bukti Pengeluaran Barang</li>
        </ol>
    </nav>
    {{-- <hr> --}}
@endsection('breadcrumb')
@section('content')
    <div class="card shadow mt-3">
        <div class="card-header text-white text-uppercase"
            style="background-color: #7587a7; font-size: 16px; font-weight: bold;">
            BUKTI PENGELUARAN BARANG
        </div>
        <div class="card-body mt-2">
            <div class="table-responsive mt-lg-4">
                <table id="tblChutter" class="table table-hover bg-primary dt-responsive nowrap" style="width:99.5%">
                    <thead class="text-center" style="text-transform: uppercase; font-size: 12px;">
                        <tr>
                            <th scope="col"
                                style="width: 50px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                No
                            </th>
                            <th scope="col"
                                style="width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                Bpb No
                            </th>
                            <th scope="col"
                                style="width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                PO No
                            </th>
                            <th scope="col"
                                style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                Created By
                            </th>
                            <th scope="col"
                                style="width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                Created Date
                            </th>
                            <th scope="col"
                                style="width: 50px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="body">
                        <!-- Isi tabel disini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Initialize DataTable with responsive features
        $(document).ready(function() {
            var table = $('#tblChutter').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                ajax: {
                    url: "{{ route('get_datatables_bpb') }}",
                    type: 'GET'
                },
                order: [
                    [3, 'desc'] // Order by creation_date descending (or whichever column you prefer)
                ],
                columns: [{
                        data: null, // Use null for custom index
                        class: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart +
                                1; // Calculate correct index
                        }
                    }, // Auto-index column
                    {
                        data: 'bpb_no',
                        class: 'text-center'
                    },
                    {
                        data: 'po_no',
                        class: 'text-center'
                    },
                    {
                        data: 'created_by',
                        class: 'text-center'
                    },
                    {
                        data: 'creation_date',
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'text-center'
                    }
                ],
                drawCallback: function(settings) {
                    // Add black border to the entire table
                    $('#tblChutter').css({
                        "border": "1px solid black"
                    });
                    $('#tblChutter thead th').css({
                        "border": "1px solid black",
                        "background-color": "#6495ED", // Custom background color for thead
                        "color": "white" // Text color for thead
                    });
                    $('#tblChutter tbody td').css({
                        "border": "1px solid black",
                        "background-color": "#f8f9fa", // Custom background color for tbody
                        "color": "black" // Text color for tbody
                    });
                },
                initComplete: function() {
                    // Apply custom styles directly to DataTables controls
                    $('.dataTables_length').css({
                        'margin-bottom': '20px', // Space below "Show Entries"
                    });
                    $('.dataTables_filter').css({
                        'margin-bottom': '20px', // Space below search box
                    });
                    $('.dataTables_paginate').css({
                        'margin-top': '10px', // Space above pagination controls
                    });
                    // Optional: Add space between DataTables controls and the table
                    $('.dataTables_wrapper').css({
                        'margin-bottom': '20px' // Space below the entire wrapper
                    });
                }
            });

            // generate pdf
            $(document).on('click', '.pdf', function(e) {
                e.preventDefault();

                var id_database = $(this).attr('row-id'); // Use 'row-id' to match the attribute in the HTML
                var bpb_database = $(this).attr('data-bpb'); // This one is correct

                // Create dynamic route URL
                var route = "{{ route('generate_bpb_pdf', [':id', ':bpb']) }}";
                route = route.replace(':id', id_database);
                route = route.replace(':bpb', bpb_database);
                console.log(bpb_database);
                // Redirect to the route URL to trigger the PDF download
                // window.location.href = route;
                window.open(route, '_blank');
            });




        });
    </script>
@endsection('content')
