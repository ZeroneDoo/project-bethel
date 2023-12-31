<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkjKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkj_keluargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("kkj_id")->constrained()->onDelete("cascade");
            $table->string("nama");
            $table->enum("jk", ['L', 'P']);
            $table->string("tmpt_lahir");
            $table->date("tgl_lahir");
            $table->string("pendidikan");
            $table->string("pekerjaan")->nullable();
            $table->enum("diserahkan", ['Y', "T"]);
            $table->enum("baptis", ['Y', "T"]);
            $table->enum("nikah", ['Y', "T"]);
            $table->string('hubungan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kkj_keluargas');
    }
}
