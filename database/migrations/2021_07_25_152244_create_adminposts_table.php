<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminposts', function (Blueprint $table) {
            $table->id();
            $table->string('saleRent');
            $table->string('category');
            $table->string('address');
            $table->string('township');
            $table->string('price');
            $table->string('money');
            $table->string('mainImage');
            $table->text('otherImage');
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->string('floor')->nullable();
            $table->integer('square_feet')->nullable();
            $table->string('carpark')->nullable();
            $table->text('description');
            $table->boolean('taken')->default(0);
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
        Schema::dropIfExists('adminposts');
    }
}
