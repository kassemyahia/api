<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            // Add columns from ERD if not already present
            if (!Schema::hasColumn('users', 'UserName')) {
                $table->string('UserName')->unique()->after('id');
            }

            if (!Schema::hasColumn('users', 'FullName')) {
                $table->string('FullName')->nullable()->after('UserName');
            }

            if (!Schema::hasColumn('users', 'Gender')) {
                $table->enum('Gender', ['Male', 'Female'])->nullable()->after('FullName');
            }

            if (!Schema::hasColumn('users', 'BirthDate')) {
                $table->date('BirthDate')->nullable()->after('Gender');
            }

            if (!Schema::hasColumn('users', 'UserType')) {
                $table->enum('UserType', ['Admin', 'Scholar', 'User'])->default('User')->after('BirthDate');
            }

            if (!Schema::hasColumn('users', 'SearchID')) {
                $table->foreignId('SearchID')->nullable()->constrained('search_histories')->onDelete('set null');
            }
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignIdIfExists('SearchID');
            $table->dropColumn(['UserName', 'FullName', 'Gender', 'BirthDate', 'UserType']);
        });
    }
};
