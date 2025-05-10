<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFirstNameAndLastNameToUserstable extends Migration
{
    public function up()
    {
        $this->forge->addColumn("users", [
            "first_name" => [
                "type" => "VARCHAR",
                "constraint" => 64,
                "null" => false,
            ]
        ]);

        $this->forge->addColumn("users", [
            "last_name" => [
                "type" => "VARCHAR",
                "constraint" => 64,
                "null" => false,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn("users", "first_name");
        $this->forge->dropColumn("users", "last_name");
    }
}
