<?php

namespace Fytinnovations\Contacts\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_contacts_messages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('contact_id')->unsigned()->nullable();
            $table->string('subject')->nullable();
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('fytinnovations_contacts_messages', function (Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('fytinnovations_contacts_contacts');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_contacts_messages', function (Blueprint $table) {
            $table->dropForeign('fytinnovations_contacts_messages_contact_id_foreign');
        });
        Schema::dropIfExists('fytinnovations_contacts_messages');
    }
}
