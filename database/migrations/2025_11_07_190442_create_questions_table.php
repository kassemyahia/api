<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asker')->constrained('users')->nullOnDelete();
            $table->text('QuestionText');
            $table->dateTime('QuestionDate')->default(now());
            $table->foreignId('answerer')->nullable()->constrained('users')->nullOnDelete();
            $table->text('AnswerText')->nullable();
            $table->dateTime('AnswerDate')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('questions');
    }
};
