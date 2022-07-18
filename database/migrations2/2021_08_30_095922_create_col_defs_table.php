<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColDefsTable extends Migration
{
    /**
     * Run the migrations.
     *create table colDef(id serial primary key , def text unique, def_j text not null );
 
     * @return void
     */
    public function up(): void
    {
        Schema::create('col_defs', function (Blueprint $table) {
            $table->id();
            $table->longText('def')->unique();
            $table->longText('def_j');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('col_defs');
    }
}
