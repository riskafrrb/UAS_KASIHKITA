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
    Schema::create('donasis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi ke users
        $table->string('judul');
        $table->string('penerima');
        $table->string('kontak');
        $table->string('kategori');
        $table->decimal('target', 12, 2);
        $table->string('rekening');
        $table->string('bank');
        $table->text('keterangan')->nullable();
        $table->string('status')->default('Pending');
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
