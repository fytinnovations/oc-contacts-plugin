<?php

namespace Fytinnovations\Contacts\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateBackendUserMessageReadsTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_contacts_backend_user_message_reads', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('backend_user_id')->unsigned();
            $table->integer('message_id')->unsigned();
            $table->timestamp('read_at')->useCurrent();
        });

        Schema::table('fytinnovations_contacts_backend_user_message_reads', function (Blueprint $table) {
            $table->foreign('backend_user_id', 'fc_backend_user_message_reads_backend_user_id_foreign')->references('id')->on('backend_users');
            $table->foreign('message_id', 'fc_backend_user_message_reads_message_id_foreign')->references('id')->on('fytinnovations_contacts_messages');
            $table->unique(['backend_user_id', 'message_id'], 'fc_backend_user_message_reads_backend_user_id_message_id_unique');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_contacts_backend_user_message_reads', function (Blueprint $table) {
            $table->dropForeign('fc_backend_user_message_reads_backend_user_id_foreign');
            $table->dropForeign('fc_backend_user_message_reads_message_id_foreign');
            $table->dropUnique('fc_backend_user_message_reads_backend_user_id_message_id_unique');
        });

        Schema::dropIfExists('fytinnovations_contacts_backend_user_message_reads');
    }
}
