<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignLogsTable extends Migration
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
        Schema::create('foreign_logs', function (Blueprint $table) {
            $table->id();
            $table->string('table_key')->unique();
            $table->longText('original');
            $table->integer('def_id');
            $table->longText('updates')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('foreign_logs');
    }
}
