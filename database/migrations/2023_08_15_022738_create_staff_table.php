<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id('id_staff');
            $table->string('name_staff');
            $table->integer('nik');
            $table->string('lahir');
            $table->date('tgl_lahir');
            $table->enum('status', ['ACTIVE', 'NOT ACTIVE']);
            $table->date('created_date');
            $table->string('created_by');
            $table->date('update_date')->nullable();
            $table->string('update_by')->nullable();
            $table->string('void')->nullable();
            // $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
