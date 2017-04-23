<?php
use Migrations\AbstractMigration;
use Cake\Datasource\ConnectionManager;

class CreateSeekIt extends AbstractMigration
{
    /**
     * Create the table SeekItDocuments for contain the data of searching
     * @return void
     */
    public function up()
    {
        $table = $this->table('seek_it_documents');
        
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])->addIndex(['title'],['type' => 'fulltext']);

        $table->addColumn('subtitle', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])->addIndex(['subtitle'],['type' => 'fulltext']);

        $table->addColumn('body', 'text', [
            'default' => null,
            'null' => false,
        ])->addIndex(['body'],['type' => 'fulltext']);
        
        $table->addColumn('refid', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);

        $table->addColumn('reftype', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);

        $table->addColumn('serialized', 'text', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();

        $table = $this->table('seek_it_fields');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('value_string', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('value_integer', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('value_datetime', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();

        $table = $this->table('seek_it_documents_fields');
        $table->addColumn('document_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addForeignKey(
            'document_id', 'seek_it_documents', 'id',
            array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION')
        );
        $table->addColumn('field_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addForeignKey(
            'field_id', 'seek_it_fields', 'id',
            array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION')
        );
        $table->create();

    }

    public function down() {
        $this->dropTable('seek_it_documents_fields');
        $this->dropTable('seek_it_fields');
        $this->dropTable('seek_it_documents');
    }
}
