<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('muhaddith')->nullable();
            $table->integer('num_of_hadiths')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('books');
    }
};
