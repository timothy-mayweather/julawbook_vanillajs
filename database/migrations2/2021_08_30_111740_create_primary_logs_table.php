<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $connection = config('database.default');
        if($connection!=='pgsql'&&$connection!=='sqlite'){
            return;
        }
        Schema::create('primary_logs', function (Blueprint $table) {
            $table->id();
            $table->string('table_key')->unique();
            $table->longText('original');
            $table->integer('def_id');
            $table->longText('updates')->nullable();
        });
    
        Schema::table('primary_logs',function (Blueprint $table){
            $table->foreign('def_id')->references('id')->on('col_defs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('primary_logs');
    }
}
