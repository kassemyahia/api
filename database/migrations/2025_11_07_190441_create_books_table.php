<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('BookName');
            $table->string('Muhaddith')->nullable();
            $table->integer('NumOfHadiths')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('books');
    }
};
