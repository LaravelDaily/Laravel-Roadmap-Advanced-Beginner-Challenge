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

            $table->string('title_company');
            $table->text('description_company')->nullable();
            $table->unsignedInteger('vat_company');
            $table->unsignedInteger('zip_company');
            $table->string('name_manager');
            $table->string('email_manager')->unique();
            $table->string('phone_manager')->unique();
            $table->string('address_company');
            $table->string('city_company');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('clients');
        }
    }
};
