<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('topic_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('TopicID')->constrained('topics')->onDelete('cascade');
            $table->foreignId('HadithID')->constrained('hadiths')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('topic_classes');
    }
};
