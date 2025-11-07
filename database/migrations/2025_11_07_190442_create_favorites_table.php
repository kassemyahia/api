<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id('FavoriteID');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('HadithID')->constrained('hadiths')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('favorites');
    }
};
