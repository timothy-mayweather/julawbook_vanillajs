<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('shift');
            $table->foreignUuid('user_id');
            $table->foreignUuid('branch_id');
            $table->foreignUuid('parent_id');
            $table->double('opening');
            $table->double('closing');
            $table->double('stock')->default(0);
            $table->double('sales');
            $table->boolean('readonly')->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->foreignUuid('user_');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('parent_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
}
