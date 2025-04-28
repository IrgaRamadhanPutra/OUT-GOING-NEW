<script>
    $(document).ready(function() {
        // Element references
        const input1 = $("#input1");
        const input2 = $("#input2");
        const poInputContainer = $("#po-input-container");
        const kanbanContainer = $("#kanban-container");
        const poDisplay = $("#po-display");
        const poLabel = $("#po-label");


        var table = $('#tbl_outgoing').DataTable({
            processing: true, // Menampilkan spinner pemrosesan
            serverSide: true, // Menggunakan pemrosesan di server
            ajax: {
                url: "{{ route('get_datatables_outtrans') }}", // URL untuk mengambil data
            },
            order: [
                [0, 'desc'] // Urutkan berdasarkan kolom pertama secara menurun
            ],
            responsive: true, // Tabel responsif untuk tampilan yang lebih kecil
            columns: [{
                    data: 'item_code',
                    name: 'item_code'
                }, // Itemcode
                {
                    data: 'part_no',
                    name: 'part_no'
                }, // Part No
                {
                    data: 'part_name',
                    name: 'part_name'
                }, // Part Name

                {
                    data: 'seq',
                    name: 'seq',
                    class: 'text-center'
                }, // Seq
                {
                    data: 'qty',
                    name: 'qty',
                    class: 'text-center'
                }, // Qty
                {
                    data: 'sloc',
                    name: 'sloc',
                    class: 'text-center'
                }, // Sloc
                {
                    data: 'action',
                    name: 'action',
                    orderable: false, // Kolom aksi tidak bisa diurutkan
                    searchable: false // Kolom aksi tidak bisa dicari
                }
            ],
            paging: false, // Nonaktifkan paging (penomoran halaman)
            searching: false, // Nonaktifkan fitur pencarian
            ordering: false, // Nonaktifkan fitur pengurutan
            lengthChange: false, // Nonaktifkan opsi mengubah jumlah baris yang ditampilkan
            drawCallback: function(settings) {
                // Tambahkan border biru pada seluruh tabel
                $('#tbl_outgoing').css({
                    "border": "1px solid blue"
                });
                // Tambahkan border biru pada sel header
                $('#tbl_outgoing thead th').css({
                    "border": "1px solid blue"
                });
                // Tambahkan border biru pada sel data
                $('#tbl_outgoing tbody td').css({
                    "border": "1px solid blue"
                });
            }
        });

        function showLoading() {
            $('.loading-spinner-container').show(); // Show loading spinner
        }

        function hideLoading() {
            $('.loading-spinner-container').hide(); // Hide loading spinner
        }

        /*  input1.focus();
         // Input field 1
         input1.on("keydown", function(e) {
             if (e.key === "Enter") {
                 e.preventDefault(); // Prevent default form submission

                 if (input1.val() !== "") {
                     var value = input1.val();
                     if (value.includes(',')) {
                         var splitData = value.split(',');
                         if (splitData.length > 1) {
                             console.log(splitData);

                             var itemCode = splitData[1];
                             var seq = splitData[2];

                             // console.log("Itemcode:", itemCode);
                             // console.log("Seq:", seq);

                             // Panggil function untuk get data kanban
                             store_data_trans(itemCode, seq);

                         } else {
                             input1.val("");
                             input1.focus();
                         }
                     } else {
                         input1.val("");
                         input1.focus();
                     }
                 }
             }
         }); */
        // Focus ke input1 saat load
        input1.focus();

        // Ketika tekan Enter di input1 (PO NO)
        input1.on("keydown", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();

                const poValue = input1.val().trim();

                if (poValue !== "") {
                    // $.ajax({
                    //     url: "{{ route('validasi_po') }}",
                    //     method: 'GET',
                    //     data: {
                    //         poValue: poValue,
                    //         _token: '{{ csrf_token() }}' // Token CSRF untuk keamanan
                    //     },
                    //     success: function(response) {
                    //         // Update tampilan PO NO di kanan atas
                    //         poDisplay.html('<b>PO NO : ' + poValue + '</b>');

                    //         // Sembunyikan input1 dan labelnya
                    //         poInputContainer.addClass("d-none");
                    //         poLabel.addClass("d-none");

                    //         // Tampilkan input2 (kanban)
                    //         kanbanContainer.removeClass("d-none");

                    //         // Fokus ke input2
                    //         input2.focus();
                    //     },
                    //     error: function(error) {
                    //         // Menyembunyikan SweetAlert loading
                    //         Swal.close(); // Menutup loading

                    //         // Menangani respons error
                    //         let errorMessage = error.responseJSON?.message ||
                    //             'Unknown error occurred'; // Pesan error dari response
                    //         Swal.fire({
                    //             icon: 'error',
                    //             title: 'Error',
                    //             text: errorMessage, // Ganti dengan pesan error dari controller
                    //         });
                    //     }
                    // });
                    // Update tampilan PO NO di kanan atas
                    poDisplay.html('<b>PO NO : ' + poValue + '</b>');

                    // Sembunyikan input1 dan labelnya
                    poInputContainer.addClass("d-none");
                    poLabel.addClass("d-none");

                    // Tampilkan input2 (kanban)
                    kanbanContainer.removeClass("d-none");

                    // Fokus ke input2
                    input2.focus();

                }
            }
        });
        // Event untuk input2 (Kanban No)
        // Event untuk input2 (Kanban No)
        input2.on("keydown", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();

                if (input2.val().trim() !== "") {
                    var value = input2.val().trim();

                    if (value.includes(',')) {
                        var splitData = value.split(',');
                        if (splitData.length > 2) {
                            var itemCode = splitData[1].trim();
                            var seq = splitData[2].trim();

                            // Ambil semua data dari tabel
                            var table = $('#tbl_outgoing').DataTable();
                            var data = table.rows().data().toArray();

                            // Cek apakah itemCode dan seq sudah ada di tabel
                            var isDuplicate = data.some(function(row) {
                                return row.item_code === itemCode && row.seq == seq;
                            });

                            if (isDuplicate) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Duplicate Data',
                                    text: 'Data dengan Item Code ' + itemCode + ' dan Seq ' +
                                        seq + ' sudah ada!',
                                });

                                input2.val('').focus();
                            } else {
                                // Lanjutkan kalau tidak duplicate
                                store_data_trans(itemCode, seq);
                            }

                        } else {
                            input2.val("").focus();
                        }
                    } else {
                        input2.val("").focus();
                    }
                }
            }
        });
        // Function untuk ambil data kanban dengan AJAX ( ENRTY SEMENTARA)
        function store_data_trans(itemcode, seq) {
            $.ajax({
                url: "{{ route('store_data_trans') }}",
                type: "POST",
                data: {
                    itemcode: itemcode,
                    seq: seq,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(response) {
                    // console.log("Response dari server:", response);
                    if (response.success) {
                        // Menampilkan data di input form
                        $('#tbl_outgoing').DataTable().ajax.reload(); // Reload tabel
                        input2.val("").focus();
                        $('#input2').focus();
                    } else {
                        // SweetAlert untuk data tidak ditemukan
                        input2.val("").focus();
                        $('#input2').focus();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Not Found',
                            text: response.message || 'Data tidak ditemukan!',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    // SweetAlert untuk data tidak ditemukan
                    input2.val("").focus();
                    $('#input2').focus();
                    // SweetAlert untuk error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengambil data!',
                    });
                }
            });
        }

        // delete data out chuter for datatables
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();

            var id = $(this).attr('row-id');
            var itemcode_database = $(this).attr('data-item_code');
            // Menampilkan SweetAlert loading
            Swal.fire({
                title: 'Please wait...',
                text: 'Deleting the record...',
                allowOutsideClick: false, // Menghindari klik di luar swal
                onOpen: () => {
                    Swal.showLoading(); // Menampilkan loading
                }
            });

            $.ajax({
                url: 'delete_outgoing_datatables', // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    id: id,
                    itemcode_database: itemcode_database,
                    _token: '{{ csrf_token() }}' // Token CSRF untuk keamanan
                },
                success: function(response) {
                    // Menyembunyikan SweetAlert loading
                    Swal.close(); // Menutup loading

                    // Menampilkan pesan sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message, // Pesan sukses dari controller
                    });
                    // Reload atau update tabel jika diperlukan
                    $('#tbl_outgoing').DataTable().ajax.reload();
                    $('#input1').focus();
                },
                error: function(error) {
                    // Menyembunyikan SweetAlert loading
                    Swal.close(); // Menutup loading

                    // Menangani respons error
                    let errorMessage = error.responseJSON?.message ||
                        'Unknown error occurred'; // Pesan error dari response
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage, // Ganti dengan pesan error dari controller
                    });
                }
            });
        });

        // Button click event for posting data
        document.getElementById('post').addEventListener('click', function() {
            // Retrieve the DataTable instance
            var table = $('#tbl_outgoing').DataTable();

            // Initialize an array to store the table data
            var tableData = [];

            // Loop through each row in the DataTable
            table.rows().every(function() {
                var rowData = this.data(); // Ambil data dari setiap baris
                if (rowData) {
                    tableData.push(rowData);
                }
            });

            // Check if tableData is empty
            if (tableData.length === 0) {
                document.getElementById('Audioerror').play();

                Swal.fire({
                    icon: 'error',
                    title: 'Data Not Found',
                    text: 'No data available in the table to BPB.',
                    showConfirmButton: true // Show OK button
                }).then(() => {
                    // Set focus to input1 after the alert is closed
                    $('#input1').focus();
                });

                return; // Exit the function if there's no data
            }
            // Show SweetAlert loading message
            Swal.fire({
                title: 'Processing...',
                text: 'Please wait for Get BPB.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var input1Value = $("#input1").val();
            $.ajax({
                url: 'post_bpb',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    input1: input1Value
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while processing BPB.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.close();

                    // Periksa jika response mengandung BPB NO
                    if (response.message === 'Data post successfully' && response.bpb_no) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            text: `BPB NO: "${response.bpb_no}"`, // Menampilkan BPB NO dari response
                        });

                        $('#tbl_outgoing').DataTable().ajax.reload(); // Reload tabel
                        // $('#input1').focus(); // Fokus pada input1
                        resetForm();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unexpected response from server.',
                        });
                    }
                },
                error: function(xhr) {
                    Swal.close();

                    let errorMessage = xhr.responseJSON?.message ||
                        'Unknown error occurred';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                }
            });

        });

        // button clear
        $("#clear").on("click", function() {
            resetForm();
        });

        // reset
        function resetForm() {
            // Kosongkan nilai input
            input1.val('');
            input2.val('');

            // Kosongkan PO display text
            poDisplay.html('');

            // Tampilkan kembali PO input dan label
            poInputContainer.removeClass("d-none");
            poLabel.removeClass("d-none");

            // Sembunyikan Kanban container
            kanbanContainer.addClass("d-none");

            // Fokus ke input1
            input1.focus();
        }


    });
</script>
