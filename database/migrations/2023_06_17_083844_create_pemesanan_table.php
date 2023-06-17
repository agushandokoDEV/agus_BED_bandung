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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('konser_id')->nullable();
            $table->uuid('kelas_id')->nullable();
            $table->string('nama_pemesan', 50)->nullable();
            $table->string('email_pemesan', 50)->nullable();
            $table->string('kode', 10)->nullable();
            $table->tinyInteger('status')->default(0);
            // $table->increments('inc');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
