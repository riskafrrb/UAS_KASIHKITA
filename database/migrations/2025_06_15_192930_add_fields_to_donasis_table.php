<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->string('rekening')->nullable();
            $table->string('bank')->nullable();
            $table->string('kontak')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->dropColumn([
                'judul', 'penerima', 'kategori', 'target',
                'rekening', 'bank', 'kontak', 'user_id'
            ]);
        });
    }
};
