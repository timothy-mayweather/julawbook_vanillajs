<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\Traits\Definition;
use Illuminate\Support\Facades\Schema;

class CreateDispensingTables extends Migration
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

        Schema::create('fuel_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('short_name')->unique();
            $table->string('description')->nullable();
            $this->defColumn1($table);
        });

        Schema::create('branch_fuel_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->decimal('price',12,2,true);
            $this->defColumn4($table);
            $table->foreign('product_id')->references('id')->on('fuel_products');
        });

        Schema::create('tanks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('capacity');
            $table->decimal('reserve');
            $table->string('description')->nullable();
            $table->foreignId('fuel_id');
            $this->defColumn4($table);
            $table->unique(['name','branch_id']);
            $table->foreign('fuel_id')->references('id')->on('branch_fuel_products');
        });

        Schema::create('pumps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $this->defColumn4($table);
            $table->unique(['name','branch_id']);
        });

        Schema::create('nozzles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('pump_id');
            $table->foreignId('tank_id');
            $this->defColumn1($table);
            $table->foreign('pump_id')->references('id')->on('pumps');
            $table->foreign('tank_id')->references('id')->on('tanks');
        });

        Schema::create('fuel_stock', function (Blueprint $table) {
            $this->defColumn6($table,'fuel_stock');
            $table->decimal('unit_price');
            $table->decimal('quantity');
            $table->tinyInteger('stock_no');
            $table->foreignId('supplier_id');
            $table->foreignId('document_id')->nullable();
            $table->foreignId('fuel_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('fuel_id')->references('id')->on('branch_fuel_products');
        });

        Schema::create('tank_stock', function (Blueprint $table) {
            $this->defColumn6($table,'tank_stock');
            $table->decimal('quantity');
            $table->foreignId('tank_id');
            $table->foreignId('stock_id');
            $table->foreign('tank_id')->references('id')->on('tanks');
            $table->foreign('stock_id')->references('id')->on('fuel_stock');
        });

        Schema::create('dips', function (Blueprint $table) {
            $this->defColumn6($table,'dips');
            $table->foreignId('tank_id');
            $table->decimal('opening',12,2,true);
            $table->decimal('closing',12,2,true);
            $table->foreign('tank_id')->references('id')->on('tanks');
        });

        Schema::create('meters', function (Blueprint $table) {
            $this->defColumn5($table,'meters');
            $table->decimal('opening',12,2,true);
            $table->decimal('rtt',12,2,true);
            $table->decimal('closing',12,2,true);
            $table->decimal('price',12,2,true);
            $table->string('new_price_details')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('nozzle_id');
            $table->foreign('nozzle_id')->references('id')->on('nozzles');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('main_meters', function (Blueprint $table) {
            $this->defColumn6($table, 'main_meters');
            $table->decimal('opening',12,2,true);
            $table->decimal('rtt',12,2,true);
            $table->decimal('closing',12,2,true);
            $table->decimal('price',12,2,true);
            $table->string('new_price_details')->nullable();
            $table->decimal('markup', 12, 2, true)->default(0);
            $table->foreignId('nozzle_id');
            $table->foreign('nozzle_id')->references('id')->on('nozzles');
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
        Schema::dropIfExists('main_meters');
        Schema::dropIfExists('meters');
        Schema::dropIfExists('dips');
        Schema::dropIfExists('tank_stock');
        Schema::dropIfExists('fuel_stock');
        Schema::dropIfExists('nozzles');
        Schema::dropIfExists('pumps');
        Schema::dropIfExists('tanks');
        Schema::dropIfExists('branch_fuel_products');
        Schema::dropIfExists('fuel_products');
    }
}
