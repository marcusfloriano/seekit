<?php
namespace SeekIt\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SeekItDocumentsFieldsFixture
 *
 */
class SeekItDocumentsFieldsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'document_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'field_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'document_id' => ['type' => 'index', 'columns' => ['document_id'], 'length' => []],
            'field_id' => ['type' => 'index', 'columns' => ['field_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'seek_it_documents_fields_ibfk_1' => ['type' => 'foreign', 'columns' => ['document_id'], 'references' => ['seek_it_documents', 'id'], 'update' => 'noAction', 'delete' => 'setNull', 'length' => []],
            'seek_it_documents_fields_ibfk_2' => ['type' => 'foreign', 'columns' => ['field_id'], 'references' => ['seek_it_fields', 'id'], 'update' => 'noAction', 'delete' => 'setNull', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'document_id' => 1,
            'field_id' => 1
        ],
    ];
}
