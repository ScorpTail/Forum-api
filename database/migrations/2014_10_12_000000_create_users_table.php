<?php

use App\Models\Role;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Role::class, 'role_id')->default(3);

            $table->string('name');
            $table->string('nickName')->nullable()->unique();

            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('about')->nullable();


            $table->string('avatar')->default('public/user-image/user-avatar.svg');
            $table->string('baner')->nullable();
            $table->json('flags')->nullable();
            $table->timestamp('email_verified_at')->nullable();


            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->text('provider_token')->nullable();
            $table->text('provider_refresh_token')->nullable();


            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
