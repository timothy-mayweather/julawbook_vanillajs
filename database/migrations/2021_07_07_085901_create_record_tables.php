<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Traits\Definition;

class CreateRecordTables extends Migration
{
    use Definition;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $connection = config('database.default');
        if ($connection !== 'pgsql' && $connection !== 'sqlite') { return; }

        $this->mk_tables('product_sales',function (Blueprint $table) {
            $table->decimal('quantity',12, 2, true);
            $table->decimal('price',12, 2, true);
            $table->foreignId('parent_id');
            $table->foreign('parent_id')->references('id')->on('branch_products');
        });


        $this->mk_tables('receivables', function (Blueprint $table) {
            $table->decimal('amount',12, 2, true);
            $table->string('description')->nullable();
            $table->foreignId('parent_id');
            $table->foreign('parent_id')->references('id')->on('branch_receivable_types');
        });

        $this->mk_tables('transactions', function (Blueprint $table) {
            $table->foreignId('parent_id');
            $table->decimal('opening',12, 2, true);
            $table->decimal('closing',12, 2, true);
            $table->decimal('deposit',12, 2, true);
            $table->decimal('withdraw',12, 2, true);
            $table->foreign('parent_id')->references('id')->on('branch_transaction_types');
        });

        $this->mk_tables('expenses', function (Blueprint $table) {
            $table->foreignId('parent_id');
            $table->decimal('amount',12, 2, true);
            $table->string('description')->nullable();
            $table->foreign('parent_id')->references('id')->on('branch_expense_types');
        });

        $this->mk_tables('debts',function (Blueprint $table){
            $table->string('description')->nullable();
            $table->decimal('paid',12)->nullable();
            $table->decimal('taken',12)->nullable();
            $table->foreignId('customer')->nullable();
            $table->foreignId('employee')->nullable();
            $table->foreign('customer')->references('id')->on('customers');
            $table->foreign('employee')->references('id')->on('employee');
        });

        $this->mk_tables('prepaids',function (Blueprint $table){
            $table->foreignId('parent_id');
            $table->string('description')->nullable();
            $table->decimal('deposit',12)->nullable();
            $table->decimal('taken',12)->nullable();
            $table->foreign('parent_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $tables = ['prepaids','debts','expenses','transactions','receivables','product_sales'];
        foreach ($tables as $table){
            Schema::dropIfExists($table);
            Schema::dropIfExists('main_'.$table);
        }
    }
}
