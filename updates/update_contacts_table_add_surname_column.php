<?php

namespace Fytinnovations\Contacts\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateContactsTableAddSurnameColumn extends Migration
{
    public function up()
    {
        Schema::table('fytinnovations_contacts_contacts', function (Blueprint $table) {
            $table->string('surname')->after('name');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_contacts_contacts', function (Blueprint $table) {
            $table->dropColumn('surname');
        });
    }
}
