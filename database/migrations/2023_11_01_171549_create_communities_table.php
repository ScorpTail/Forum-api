<?php

use App\Models\Categories;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->comment('Avtor of community');
            $table->foreignIdFor(Categories::class, 'category_id');
            $table->string('name');
            $table->text('description');
            $table->string('type')->comment('Public or private');
            $table->boolean('disclaimer')->comment('18+ or not');
            $table->string('avatar_path');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communities');
    }
};
