<?php

use App\Models\User;
use App\Models\Comment;
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
        Schema::create('comment_upvotes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Comment::class);
            $table->foreignIdFor(User::class);
            $table->boolean('upvote')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_upvotes');
    }
};
