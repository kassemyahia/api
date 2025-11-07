<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('explainings', function (Blueprint $table) {
            $table->id('EID');
            $table->text('ETEXT');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('explainings');
    }
};
