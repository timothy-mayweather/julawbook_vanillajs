<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateChangeTables extends Migration
{
    public function __construct()
    {
        $this->connection = config('database.default');
    }

    public function up(): void
    {

    }

    public function down(): void
    {
    }
}
