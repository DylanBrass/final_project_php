<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('message_id');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('receiver_id');
            //useless since there is no delete
            $table->foreign('sender_id')->references('id')->on('chat_users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('chat_users')->onDelete('cascade');
            $table->foreign('message_id')->references('id')->on('chat_messages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_messages');
    }
};