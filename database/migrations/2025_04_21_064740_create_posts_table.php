<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     * membuat skema
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->enum('status',['draft','publish'])->default('draft');
            $table->string('thumbnail')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    //onDelete cascade, berguna ketika menghapus user maka semua postingan yg pernah dibuat oleh user tersebut ikut hilang
                    ->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     * menghapus skema
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
