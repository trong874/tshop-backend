<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->integer('quantity')->default(0);
            $table->decimal('price_input')->default(0);
            $table->decimal('price_old')->default(0);
            $table->decimal('price')->default(0);
            $table->set('status',[0,1])->default(1);
            $table->string('seo_slug');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
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
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
