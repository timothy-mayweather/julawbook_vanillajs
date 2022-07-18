<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeTables extends Migration
{
    public function defColumn1 (Blueprint $table): void{
        $table->enum('active',['No','Yes'])->nullable()->default('Yes');
        $table->foreignId('user_');
        $table->foreignId('user_d')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
        $table->softDeletes();
        $table->foreign('user_')->references('id')->on('users');
    }

    //branched
    public function defColumn2 (Blueprint $table): void
    {
        $table->foreignId('user_');
        $table->foreignId('branch_id');
        $table->foreignId('user_d')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
        $table->softDeletes();
        $table->foreign('user_')->references('id')->on('users');
        $table->foreign('branch_id')->references('id')->on('branches');
    }

    //user nullable
    public function defColumn3 (Blueprint $table): void
    {
        $table->enum('active',['No','Yes'])->nullable()->default('Yes');
        $table->foreignId('user_')->nullable();
        $table->foreignId('user_d')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
        $table->softDeletes();
    }
    //branched
    public function defColumn4 (Blueprint $table): void
    {
        $table->enum('active',['No','Yes'])->nullable()->default('Yes');
        $table->foreignId('user_');
        $table->foreignId('branch_id');
        $table->foreignId('user_d')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
        $table->softDeletes();
        $table->foreign('user_')->references('id')->on('users');
        $table->foreign('branch_id')->references('id')->on('branches');
    }

    public function defColumn5 (Blueprint $table, string $table_name): void
    {
        $table->id();
        $table->foreignId('user_');
        $table->foreignId('branch_id');
        $table->foreignId('user_d')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
        $table->softDeletes();

        $table->tinyInteger('readonly')->default(0);
        $table->integer('shift');
        $table->unsignedBigInteger('branch_int_date');
        $table->date('record_date');
        $table->unsignedBigInteger('user_shift_date');
        $table->index('branch_int_date',$table_name.'_branch_int_date');
        $table->index('record_date',$table_name.'_record_date');
        $table->index('user_shift_date',$table_name.'_user_shift_date');
        $table->unsignedBigInteger('unique_int')->unique();

        $table->foreign('user_')->references('id')->on('users');
        $table->foreign('branch_id')->references('id')->on('branches');
    }

    public function defColumn6(Blueprint $table, string $table_name): void
    {
        $table->id();
        $table->foreignId('user_');
        $table->foreignId('branch_id');
        $table->foreignId('user_d')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
        $table->softDeletes();
        $table->tinyInteger('readonly')->default(0);
        $table->unsignedBigInteger('branch_int_date');
        $table->date('record_date');
        $table->index('branch_int_date',$table_name.'_branch_int_date');
        $table->index('record_date',$table_name.'_record_date');
        $table->unsignedBigInteger('unique_int')->unique();
        $table->foreign('user_')->references('id')->on('users');
        $table->foreign('branch_id')->references('id')->on('branches');
    }

    public function mk_tables($name, $call): void
    {
        Schema::create($name, function (Blueprint $table) use ($name, $call) {
            $this->defColumn5($table, $name);
            $call($table);
        });

        $name = 'main_'.$name;
        Schema::create($name, function (Blueprint $table) use ($name, $call) {
            $this->defColumn6($table, $name);
            $call($table);
        });
    }

    public function up(): void
    {
        $connection = config('database.default');
        if ($connection !== 'pgsql' && $connection !== 'sqlite') { return; }
//        Schema::create('meters', function (Blueprint $table) {
//            $this->defColumn5($table,'meters');
//            $table->decimal('opening',12,2,true);
//            $table->decimal('rtt',12,2,true);
//            $table->decimal('closing',12,2,true);
//            $table->decimal('price',12,2,true);
//            $table->string('new_price_details')->nullable();
//            $table->foreignId('user_id');
//            $table->foreignId('nozzle_id');
//            $table->foreign('nozzle_id')->references('id')->on('nozzles');
//            $table->foreign('user_id')->references('id')->on('users');
//        });
//
//        Schema::create('main_meters', function (Blueprint $table) {
//            $this->defColumn6($table, 'main_meters');
//            $table->decimal('opening',12,2,true);
//            $table->decimal('rtt',12,2,true);
//            $table->decimal('closing',12,2,true);
//            $table->decimal('price',12,2,true);
//            $table->decimal('markup', 12, 2, true)->default(0);
//            $table->string('new_price_details')->nullable();
//            $table->foreignId('nozzle_id');
//            $table->foreign('nozzle_id')->references('id')->on('nozzles');
//        });
//        $this->mk_tables('prepaids',function (Blueprint $table){
//            $table->foreignId('parent_id');
//            $table->string('description')->nullable();
//            $table->decimal('deposit',12)->nullable();
//            $table->decimal('taken',12)->nullable();
//            $table->foreign('parent_id')->references('id')->on('customers');
//        });
    }

    public function down(): void
    {
        $tables = ['meters'];
        foreach ($tables as $table){
            Schema::dropIfExists($table);
            Schema::dropIfExists('main_'.$table);
        }
    }
}
