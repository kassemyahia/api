<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ruling_of_hadiths', function (Blueprint $table) {
            $table->id('RulingID');
            $table->string('RulingText');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('ruling_of_hadiths');
    }
};
