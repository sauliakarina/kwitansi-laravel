<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberHasKwitansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_has_kwitansi', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->integer('kelas_id');
            $table->string('no_kwitansi')->nullable();
            $table->unsignedBigInteger('tagihan')->nullable();
            $table->text('bukti_pembayaran')->nullable();
            $table->integer('approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_has_kwitansi');
    }
}
