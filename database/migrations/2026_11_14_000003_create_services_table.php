<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('serial_number')->nullable();
                $table->string('package_type');
                $table->decimal('price', 12, 2);
                $table->string('time_estimate');
                $table->timestamps();
            });
            return;
        }

        // Table already exists (older version without timestamps)
        foreach (['created_at', 'updated_at'] as $col) {
            if (! Schema::hasColumn('services', $col)) {
                Schema::table('services', function (Blueprint $table) use ($col) {
                    $table->timestamp($col)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
