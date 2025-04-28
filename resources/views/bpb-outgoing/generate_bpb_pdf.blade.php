<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pengeluaran Barang</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
        } */

        .container {
            width: 100%;
            /* margin: 0 auto; */
        }

        .header {
            text-align: center;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 1px;
            text-align: center;
        }

        .custom-cell {
            padding-right: 3pt;
            padding-left: 3pt;
            font-size: 10px;
        }

        .table-row {
            padding: 5px;
            text-align: left;
        }

        .label {
            display: inline-block;
            /* Make the label occupy only the necessary space */
            width: 100px;
            /* Set a fixed width for the labels */
        }
    </style>
</head>

<body>

    <div class="container hight-container">
        <div style="width: 100%; border: 1px solid black; padding: 0px; margin-top: -10px;">
            <!-- Added border and adjusted margin-top -->
            <table style="width: 100%; margin-top: 0px;">
                <tr>
                    <td style="padding: 1px; text-align: left; font-weight: bold; margin: 0;">
                        PT. TRIMITRA CHITRAHASTA
                    </td>
                    <td style="padding: 1px; text-align: right; vertical-align: top;">
                        No : {{ $data->first()->bpb_no ?? 'Null' }}

                    </td>
                </tr>
            </table>

            <div style="text-align: center; margin-bottom: 5px; position: relative;">
                <h3 style="margin: 0px 0; display: inline-block; text-align: center;">BUKTI PENGELUARAN BARANG</h3>
                @if ($data->isNotEmpty() && $data->first()->bpb_no)
                    <img src="data:image/png;base64,{{ base64_encode($qrcode) }}" alt="QR Code"
                        style="width: 60px; height: 60px; position: absolute; top: 25px; right: 10px;">
                @endif
                <p style="margin: 0;">(Part, Carrier, Box, Skid)</p>
            </div>
            <div class="row" style="margin-bottom: 2px; padding: 3px;"> <!-- Reduced margin-bottom -->
                <div class="col text-center"> <!-- Column for Hari/Tanggal -->
                    <span style="font-size:12px;" class="label">Hari/Tanggal</span>
                    <span style="font-size:12px;">
                        :
                        {{ optional($data->first())->creation_date? \Carbon\Carbon::parse($data->first()->creation_date)->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d-F-Y'): '-' }}
                    </span>

                </div>
                <div class="col text-center"> {{-- po no --}}
                    <span style="font-size:12px;" class="label">PO No</span>
                    <span style="font-size:12px;">
                        : {{ $data->first()->po_no ?? 'Null' }}
                    </span>
                </div>
                <div class="col text-center"> <!-- Column for Cycle No/Route -->
                    <span style="font-size:12px;" class="label">Cycle No/Route</span>
                    <span style="font-size:12px;">
                        :
                    </span>
                </div>
                <div class="col text-center"> <!-- Column for Jam -->
                    <span style="font-size:12px;" class="label">Jam</span>
                    <span style="font-size:12px;">
                        : {{ \Carbon\Carbon::parse($data->first()->creation_date)->format('H:i:s') }}
                    </span>
                </div>
            </div>
            <table style="width: 100%;margin-top:0px;"> <!-- Added border to table -->
                <tr>
                    <td rowspan="2" colspan="5" style="padding-right: 3pt; padding-left: 3pt; text-align: left;">
                    </td>
                    <td colspan="8"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1px 3px; font-size:10px;">
                        Actual Delivery
                    </td>
                    <td rowspan="2" style="padding-right: 3pt; padding-left: 3pt;">
                    </td>
                </tr>


                <tr>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 1pt; padding-left: 1pt;font-size:10px; ">
                        Qty Delivery (pcs)
                    </td>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 1pt; padding-left: 1pt;font-size:10px; ">
                        Qty Carier (Unit)
                    </td>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 1pt; padding-left: 1pt;font-size:10px; ">
                        Qty BOX (Unit)
                    </td>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 1pt; padding-left: 1pt;font-size:10px; ">
                        Qty Skid (Unit)
                    </td>
                </tr>
                <tr>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        No
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 1pt; padding-left: 1pt; font-size:10px;  white-space: nowrap; width: 150px;">
                        Part No / Part Name&nbsp;
                    </td>
                    {{-- <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 1pt; padding-left: 1pt; font-size:10px;  white-space: nowrap; width: 150px;">
                        Part No / Part Name&nbsp;
                    </td> --}}
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Qty
                        <br>
                        Packing
                        <br>
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Qty
                        <br>
                        Box
                        <br>
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Total
                        <br>
                        Qty Pack
                        <br>
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Plan
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Act. Check
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Plan/
                        <br>
                        kirim
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Act.Check/
                        <br>
                        Terima
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Plan/
                        <br>
                        Kirim
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Act.Check/
                        <br>
                        Terima
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Plan/
                        <br>
                        Kirim
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Act.Check/
                        <br>
                        Terima
                    </td>
                    <td
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        No. PO/DN
                    </td>

                </tr>
                @foreach ($data as $index => $item)
                    <tr>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px;">
                            {{ $index + 1 }}
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:9px; text-align:left">
                            {{ $item->part_name }}
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px;">
                            {{ $item->qty_per_kanban }}
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                            {{ $item->total_kanban }}
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                            {{ $item->total_qty }}

                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                            {{-- {{ $item->total_qty }} --}}
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                        </td>
                        <td
                            style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding: 1pt; font-size:11px; ">
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Diserahkan Oleh
                    </td>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Diketahui Oleh
                    </td>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Di Terima Oleh
                    </td>
                    <td rowspan="4" colspan="8"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt; font-size:10px; text-align: left;">
                        Note :
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">

                    </td>
                    <td rowspan="3" colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">

                    </td>
                    <td style="padding-right: 3pt; padding-left: 3pt;font-size:10px;">
                    </td>
                    <td style="padding-right: 3pt; padding-left: 3pt;font-size:10px;">
                        &nbsp;
                        <br>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 3pt; padding-left: 3pt;">
                    </td>
                    <td style="padding-right: 3pt; padding-left: 3pt;">
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 3pt; padding-left: 3pt;">
                    </td>
                    <td style="padding-right: 3pt; padding-left: 3pt;">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Warehouse
                    </td>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Security
                    </td>
                    <td colspan="2"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                        Driver
                    </td>
                    <td colspan="8"
                        style="border-width: 1px; border-style: solid; border-color: rgb(0, 0, 0); padding-right: 3pt; padding-left: 3pt;font-size:10px; ">
                    </td>
                </tr>
            </table>
        </div>
        <span style="font-size: 12px">LD-INV-02 rev.1</span>
    </div>
</body>

</html>
