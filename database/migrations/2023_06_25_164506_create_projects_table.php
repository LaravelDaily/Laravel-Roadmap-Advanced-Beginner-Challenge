<?php

use App\Enums\ProjectStatuses;
use App\Models\Client;
use App\Models\User;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->date('deadline');
            $table->string('status')->default('open');

            $table->foreignIdFor(User::class)
                ->constrained();

            $table->foreignIdFor(Client::class)
                ->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('projects');
        }
    }
};
