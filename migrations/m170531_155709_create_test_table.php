<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test`.
 */
class m170531_155709_create_test_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
//        $this->createTable('test', [
//            'id' => $this->primaryKey(),
//        ]);

        $this->execute("CREATE TABLE test2
        (
          name character varying(64) NOT NULL,
          type smallint NOT NULL,
          description text,
          rule_name character varying(64),
          data bytea,
          created_at integer)");
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('test');
    }

}
