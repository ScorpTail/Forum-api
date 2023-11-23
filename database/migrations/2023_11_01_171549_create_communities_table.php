<?php

use App\Models\User;
use App\Models\Category;
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
            $table->foreignIdFor(Category::class, 'category_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->char('type', 15)->comment('Public or private');
            $table->boolean('disclaimer')->default(false)->comment('18+ or not');
            $table->string('avatar_path')->nullable();
            $table->string('banner_path')->nullable();

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
