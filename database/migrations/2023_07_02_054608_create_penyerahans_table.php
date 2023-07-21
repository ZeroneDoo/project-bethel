<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyerahansTable extends Migration
{
    public function up()
    {
        Schema::create('penyerahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kkj_anak_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('kkj_keluarga_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamp('waktu');
            $table->string('pendeta');
            $table->string('foto');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penyerahans');
    }
}
