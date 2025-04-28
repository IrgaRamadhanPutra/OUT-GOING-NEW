<?php

namespace App\Models\Ekanban;

use Illuminate\Database\Eloquent\Model;

class Ekanban_outgoing_trans extends Model
{
    protected $connection = 'ekanban'; // Explicitly define database name
    protected $table = 'ekanban_outgoing_trans'; // Explicitly define table name
    protected $primaryKey = 'id'; // Define primary key

    public $timestamps = false; // Disable timestamps since they are not in the table

    protected $fillable = [
        'ekanban_no',
        'item_code',
        'part_name',
        'part_no',
        'seq',
        'created_by',
        'creation_date',
        'sloc',
        'qty',
        'branch'
    ];
}
