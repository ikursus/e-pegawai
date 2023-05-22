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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_pekerja')->nullable();
            $table->string('telefon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('jawatan')->nullable();
            $table->string('bahagian')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('gambar')->nullable();
            $table->string('status')->nullable();
            $table->string('role')->nullable();
            $table->date('tarikh_mula_bekerja')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
