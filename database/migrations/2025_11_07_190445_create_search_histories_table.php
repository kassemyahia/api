<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id('SearchID');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('SelectText')->nullable();
            $table->text('SearchText')->nullable();
            $table->dateTime('SearchDate')->default(now());
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('search_histories');
    }
};
