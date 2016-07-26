<?php

use yii\db\Migration;

class m160525_042323_insert_root_user extends Migration
{
    public function up()
    {
        $this->insert('user', array(
            'username' =>'root',
            'email' => 'root@dermaga.org',
            'password_hash' => '$2y$10$OCdc.CK/FmkaAi1yjd4N6ubKn1NoGBk4dkfa1mVoL05oOPSdebkna',
            'auth_key' => '4mCDzSkX5tr8CCVxBGWmyW3SthZMeV5S',
            'confirmed_at' => null,
            'unconfirmed_email' => null,
            'blocked_at' => null,
            'registration_ip' => '::1',
            'created_at' => 1464082991,
            'updated_at' => 1464093574,
            'flags' => 0,
         ));
    }

    public function down()
    {
        echo "m160525_042323_insert_root_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
