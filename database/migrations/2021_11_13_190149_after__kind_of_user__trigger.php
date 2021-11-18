<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AfterKindOfUserTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Trigger Para la insercion 
        // DELIMITER $$
        DB::unprepared('DROP TRIGGER IF EXISTS `AfIsn_KindOfUser_trigger`');
        DB::unprepared('CREATE TRIGGER AfIsn_KindOfUser_trigger AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                DECLARE all_usr INT;
                IF NEW.kind_Id = 1
                THEN
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 1
                    UPDATE kind_of_users SET count = all_usr + 1 WHERE id = 1
                ELSEIF NEW.kind_Id = 2
                THEN
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 2
                    UPDATE kind_of_users SET count = all_usr + 1 WHERE id = 2
                ELSE
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 3
                    UPDATE kind_of_users SET count = all_usr + 1 WHERE id = 3
                END IF;
        ');

        // Trigger Para la Modificacion 
        // DELIMITER $$
        DB::unprepared('DROP TRIGGER IF EXISTS `AfMod_KindOfUser_trigger`');
        DB::unprepared('CREATE TRIGGER AfMod_KindOfUser_trigger AFTER UPDATE ON users
            FOR EACH ROW
            BEGIN
                DECLARE all_usr INT;
                IF NEW.kind_Id = 1
                THEN
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 1
                    UPDATE kind_of_users SET count = all_usr + 1 WHERE id = 1
                ELSEIF NEW.kind_Id = 2
                THEN
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 2
                    UPDATE kind_of_users SET count = all_usr + 1 WHERE id = 2
                ELSE
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 3
                    UPDATE kind_of_users SET count = all_usr + 1 WHERE id = 3
                END IF;
        ');

        // Trigger Para la Eliminacion 
        // DELIMITER $$
        DB::unprepared('DROP TRIGGER IF EXISTS `BeDel_KindOfUser_trigger`');
        DB::unprepared('CREATE TRIGGER AfDel_KindOfUser_trigger BEFORE DELETE ON users
            FOR EACH ROW
            BEGIN
                DECLARE all_usr INT;
                IF OLD.kind_Id = 1 THEN
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 1
                    UPDATE kind_of_users SET count = all_usr - 1 WHERE id = 1
                ELSEIF OLD.kind_Id = 2 THEN
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 2
                    UPDATE kind_of_users SET count = all_usr - 1 WHERE id = 2
                ELSE
                    SELECT count INTO all_usr FROM kind_of_users WHERE id = 3
                    UPDATE kind_of_users SET count = all_usr - 1 WHERE id = 3
                END IF;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXIST `AfIsn_KindOfUser_trigger`');
        DB::unprepared('DROP TRIGGER IF EXIST `AfMod_KindOfUser_trigger`');
        DB::unprepared('DROP TRIGGER IF EXIST `BeDel_KindOfUser_trigger`');
    }
}
