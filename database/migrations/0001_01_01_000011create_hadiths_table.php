<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hadiths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('SubValid')->nullable();
            $table->foreignId('Explaining')->nullable()->constrained('explainings');
            $table->enum('HadithType', ['مرفوع', 'قدسي','موقوف','أثر للصحابة'])->nullable();
            $table->text('HadithText');
            $table->text('TextWithoutDiacritics')->nullable();
            $table->integer('HadithNumber')->nullable();
            $table->foreignId('RulingOfMuhaddith')->nullable()->constrained('ruling_of_hadiths')->nullOnDelete();
            $table->foreignId('FinalRuling')->nullable()->constrained('ruling_of_hadiths')->nullOnDelete();
            $table->foreignId('Rawi')->nullable()->constrained('rawis')->nullOnDelete();
            $table->foreignId('Source')->nullable()->constrained('books')->nullOnDelete();
            $table->foreignId('sanad')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hadiths');
    }
};
