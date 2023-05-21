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
        Schema::create('fb_long_tk', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger("user_id")->nullable();
             $table->bigInteger("client_id")->nullable();
            $table->string("long_lived_access_token");
             $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_facebook_long_access_tokens');
    }
};
