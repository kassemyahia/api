<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rawi', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->enum('Gender', ['M', 'F'])->nullable();
            $table->text('halalrawi')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('narrators');
    }
};
