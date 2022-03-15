<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignInPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id");


      
            $table->foreign("user_id") // indichiamo che user_id è una foreign key
              ->references("id") // indichiamo che fa riferimento alla colonna id
              ->on("users"); // sulla tabella users
      
            // Versione più stitica
            // per forza di cose, il nome della colonna dovrà contenere il nome della tabella
            // di destinazione al singolare più il nome della colonna a cui fa riferimento.
            $table->foreignId("category_id")


              ->constrained();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
