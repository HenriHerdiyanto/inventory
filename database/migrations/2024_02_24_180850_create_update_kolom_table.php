<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            // Perbarui data yang memiliki nilai null
            DB::table('produks')->whereNull('id_kategori')->update(['id_kategori' => 0]);

            // Mengubah kolom id_kategori menjadi nullable
            $table->unsignedBigInteger('id_kategori')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            // Mengembalikan kolom id_kategori menjadi non-nullable
            $table->unsignedBigInteger('id_kategori')->nullable(false)->change();

            // Mengembalikan nilai null ke data yang telah diperbarui sebelumnya
            DB::table('produks')->where('id_kategori', 0)->update(['id_kategori' => null]);
        });
    }
};
