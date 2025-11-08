<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('HadithID')->constrained('hadiths')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('Scholar')->nullable();
            $table->text('CommentText');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('comments');
    }
};
