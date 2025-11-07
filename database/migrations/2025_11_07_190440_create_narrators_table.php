<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('narrators', function (Blueprint $table) {
            $table->id('NarratorID');
            $table->string('Name');
            $table->enum('Gender', ['Male', 'Female'])->nullable();
            $table->enum('NarratorType', ['Companion', 'Follower', 'Scholar'])->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('narrators');
    }
};
