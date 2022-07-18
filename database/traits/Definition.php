<?php

namespace Database\Traits;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait Definition
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

    public function defColumn3 (Blueprint $table): void
    {
        $table->enum('active',['No','Yes'])->nullable()->default('Yes');
        $table->foreignId('user_')->nullable();
        $table->foreignId('user_d')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
        $table->softDeletes();
    }

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
}
