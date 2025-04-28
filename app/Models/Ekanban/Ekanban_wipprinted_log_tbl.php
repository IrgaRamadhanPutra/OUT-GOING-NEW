<?php

namespace App\Models\Ekanban;

use Illuminate\Database\Eloquent\Model;

class EkanbanWipPrintedLogTbl extends Model
{
    protected $connection = 'ekanban'; // Explicitly define database name
    protected $table = 'ekanban_wipprinted_log_tbl'; // Define table name
    protected $primaryKey = 'id'; // Define primary key

    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'ekanban_no',
        'item_code',
        'part_name',
        'part_no',
        'base_unit',
        'seq',
        'seq_index',
        'seq_tot',
        'seq_print_key',
        'mpname',
        'kanban_qty',
        'kanban_qty_tot',
        'doc_no_rec',
        'doc_no_send',
        'created_by',
        'creation_date',
        'msg_sap',
        'type_sap',
        'from_sloc',
        'to_sloc',
        'branch'
    ];
}
