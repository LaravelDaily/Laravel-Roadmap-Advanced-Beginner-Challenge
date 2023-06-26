<?php

use App\Models\Client;
use App\Models\Project;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->string('status')->default('open');
            $table->tinyInteger('priority')->default(0);

            $table->foreignIdFor(User::class)
                ->constrained();
            $table->foreignIdFor(Client::class)
                ->constrained();
            $table->foreignIdFor(Project::class)
                ->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('tasks');
        }
    }
};
