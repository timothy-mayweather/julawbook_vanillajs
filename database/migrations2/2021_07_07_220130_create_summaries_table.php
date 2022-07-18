<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();
            $table->integer('shift');
            $table->foreignUuid('user_id');
            $table->foreignUuid('branch_id');
            $table->integer('price_adjustment')->nullable();
            $table->integer('banked')->nullable();
            $table->integer('shortage');
            $table->integer('cash');
            $table->boolean('readonly')->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('summaries');
    }
}
