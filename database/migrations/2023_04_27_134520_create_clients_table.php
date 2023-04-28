<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50)->unique();       
            $table->string('last_name', 50)->unique();
            $table->string('company', 100);
            $table->string('email', 50)->unique();
            $table->string('phone', 20);
            $table->string('country', 50);
            $table->string('client_status', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
