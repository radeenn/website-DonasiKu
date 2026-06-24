<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('documentation_files')) {
            Schema::create('documentation_files', function (Blueprint $table) {
                $table->id();
                $table->string('title', 100);
                $table->string('file_path');
                $table->string('file_type', 20);
                $table->timestamps();
            });

            return;
        }

        if (!Schema::hasColumn('documentation_files', 'title')) {
            Schema::table('documentation_files', function (Blueprint $table) {
                $table->string('title', 100)->nullable();
            });
        }

        if (!Schema::hasColumn('documentation_files', 'file_path')) {
            Schema::table('documentation_files', function (Blueprint $table) {
                $table->string('file_path')->nullable();
            });
        }

        if (!Schema::hasColumn('documentation_files', 'file_type')) {
            Schema::table('documentation_files', function (Blueprint $table) {
                $table->string('file_type', 20)->nullable();
            });
        }

        if (!Schema::hasColumn('documentation_files', 'created_at')) {
            Schema::table('documentation_files', function (Blueprint $table) {
                $table->timestamp('created_at')->nullable();
            });
        }

        if (!Schema::hasColumn('documentation_files', 'updated_at')) {
            Schema::table('documentation_files', function (Blueprint $table) {
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Kolom hasil perbaikan tidak dihapus agar data lama tetap aman.
    }
};
