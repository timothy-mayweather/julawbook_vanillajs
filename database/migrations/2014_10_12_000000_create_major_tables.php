<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
require 'database/traits/Definition.php';
use Database\Traits\Definition;

class CreateMajorTables extends Migration
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

        //TODO Initially, insert general branch for root and other major users
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('location');
            $this->defColumn3($table);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->enum('manager', ['No', 'Yes', 'Root'])->default('No');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('branch_id');
            $this->defColumn3($table);
            $table->foreign('user_')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches');
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->foreignId('branch_id');
            $table->foreignId('user_id')->nullable();
            $this->defColumn3($table);
            $table->foreign('user_')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches');
        });

        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique();
            $table->foreignId('user_');
            $table->foreignId('user_d')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('user_')->references('id')->on('users');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('short_name')->unique();
            $table->foreignId('type');
            $table->string('description')->nullable();
            $this->defColumn3($table);
            $table->foreign('type')->references('id')->on('product_types');
        });

        Schema::create('branch_products', function (Blueprint $table) {
            $table->id();
            $table->decimal('price',12,2,true);
            $table->foreignId('product_id');
            $this->defColumn4($table);
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('receivable_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $this->defColumn1($table);
        });

        Schema::create('branch_receivable_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recv_id');
            $this->defColumn4($table);
            $table->foreign('recv_id')->references('id')->on('receivable_types');
        });

        Schema::create('expense_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $this->defColumn1($table);
        });

        Schema::create('branch_expense_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exp_id');
            $this->defColumn4($table);
            $table->foreign('exp_id')->references('id')->on('expense_types');
        });

        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $this->defColumn1($table);
        });

        Schema::create('branch_transaction_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tr_id');
            $this->defColumn4($table);
            $table->foreign('tr_id')->references('id')->on('transaction_types');
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('short')->unique();
            $this->defColumn1($table);
        });

        Schema::create('branch_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $this->defColumn4($table);
            $table->enum('debtor',['No','Yes'])->default('Yes');
            $table->enum('prepaid',['No','Yes'])->default('No');
            $table->string('description')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
        });

        //TODO let suppliers, users and branches be registered online
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('location');
            $table->string('description')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $this->defColumn1($table);
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->date('record_date');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('branch_int_date');
            $table->index('record_date','record_date');
            $table->index('branch_int_date','branch_int_date');
            $this->defColumn2($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $connection = config('database.default');
        if ($connection !== 'pgsql' && $connection !== 'sqlite') { return; }
        Schema::dropIfExists('documents');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('branch_customers');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('branch_transaction_types');
        Schema::dropIfExists('transaction_types');
        Schema::dropIfExists('branch_expense_types');
        Schema::dropIfExists('expense_types');
        Schema::dropIfExists('branch_receivable_types');
        Schema::dropIfExists('receivable_types');
        Schema::dropIfExists('branch_products');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_types');
        Schema::dropIfExists('users');
        Schema::dropIfExists('branches');
    }
}
