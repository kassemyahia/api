<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reference_hadiths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('MainHadith')->constrained('hadiths')->onDelete('cascade');
            $table->foreignId('RefHadith')->constrained('hadiths')->onDelete('cascade');
            $table->string('Note')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('reference_hadiths');
    }
};
