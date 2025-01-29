<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $filePath = database_path('data/world.sql');

        if (File::exists($filePath)) {
            $sql = File::get($filePath);
            DB::unprepared($sql);
        } else {
            throw new Exception("Arquivo SQL não encontrado: $filePath");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
