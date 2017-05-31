<?php

use yii\db\Migration;

class m170531_161009_create_test_table2 extends Migration {

    
    public function up() {
        $path = Yii::getAlias('@app/migrations/create_table_test2.txt');
        $this->execute(file_get_contents($path));
    }

    public function down() {
        $this->dropTable('test2');
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
