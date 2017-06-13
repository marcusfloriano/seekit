<?php
use Migrations\AbstractMigration;
use Cake\Datasource\ConnectionManager;

class CreateSeekIt extends AbstractMigration
{
    /**
     * Create the struct of tables for SeekIt
     * @return void
     */
    public function up()
    {
        /**
         * Create the SeekItDocuments table
         */
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
        $table->addIndex(['title','subtitle','body'],['type' => 'fulltext']);
        $table->create();

        /**
         * Create the SeekItDocumentsFields table
         */
        $table = $this->table('seek_it_document_fields');
        $table->addColumn('seek_it_documents_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addForeignKey(
            'seek_it_documents_id', 'seek_it_documents', 'id',
            array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION')
        );
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

    }

    public function down() {
        $this->dropTable('seek_it_document_fields');
        $this->dropTable('seek_it_documents');
    }
}
