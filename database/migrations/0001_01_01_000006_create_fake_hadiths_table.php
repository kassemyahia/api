<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void {
Schema::create('fake_hadiths', function (Blueprint $table) {
$table->id();
$table->foreignId('SubValid')->nullable();
$table->text('FakeHadithText');
$table->string('Ruling')->nullable();
$table->timestamps();
});
}
public function down(): void {
Schema::dropIfExists('fake_hadiths');
}
};
