<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pair_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_code')->unique();
            $table->string('driver_name');
            $table->string('navigator_name');
            $table->integer('turn_duration')->default(10);
            $table->enum('current_role', ['driver', 'navigator'])->default('driver');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pair_sessions');
    }
};
