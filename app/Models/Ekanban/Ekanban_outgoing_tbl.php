<?php

namespace App\Models\Ekanban;

use Illuminate\Database\Eloquent\Model;

class Ekanban_outgoing_tbl extends Model
{
    protected $connection = 'ekanban'; // Explicitly define database name
    protected $table = 'ekanban_outgoing_tbl'; // Explicitly define table name
    protected $primaryKey = 'id'; // Define primary key

    public $timestamps = false; // Set to true if `created_at` and `updated_at` exist

    protected $fillable = [
        'bpb_no',
        'po_no',
        'ekanban_no',
        'item_code',
        'part_name',
        'part_no',
        'seq',
        'qty',
        'created_by',
        'creation_date',
        'sloc',
        'branch'
    ];
}
