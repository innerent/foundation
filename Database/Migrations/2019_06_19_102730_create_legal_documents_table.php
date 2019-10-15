<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->string('number');
            $table->string('dispatcher');
            $table->string('state');
            $table->string('country');
            $table->morphs('entity');

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('legal_documents');
        Schema::enableForeignKeyConstraints();
    }
}
