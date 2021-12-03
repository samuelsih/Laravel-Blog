<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //schema untuk hubungan many to many dari tabel posts dan categories
        //untuk menjalankan laravel 'magic', penamaan table yang berelasi harus berurutan abjad, dan dipisah _ (underscore)
        //jadi harus category_post, bukan post_category
        //pemberian foreignID di schema juga harus berurutan abjad
        Schema::create('category_post', function (Blueprint $table) {
            //post_id ->foreign key untuk ke tabel posts
            //category_id -> foreign key untuk ke tabel categories
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('post_id')->constrained('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_categories');
    }
}
