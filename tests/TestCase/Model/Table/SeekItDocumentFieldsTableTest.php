<?php
namespace SeekIt\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SeekIt\Model\Table\SeekItDocumentFieldsTable;

/**
 * SeekIt\Model\Table\SeekItDocumentFieldsTable Test Case
 */
class SeekItDocumentFieldsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SeekIt\Model\Table\SeekItDocumentFieldsTable
     */
    public $SeekItDocumentFields;

    /**
     * Dependency of test subject
     *
     * @var \SeekIt\Model\Table\SeekItDocumentsTable
     */
    public $SeekItDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.seek_it.seek_it_document_fields',
        'plugin.seek_it.seek_it_documents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SeekItDocumentFields') ? [] : ['className' => 'SeekIt\Model\Table\SeekItDocumentFieldsTable'];
        $this->SeekItDocumentFields = TableRegistry::get('SeekItDocumentFields', $config);

        $config_documents = TableRegistry::exists('SeekItDocuments') ? [] : ['className' => 'SeekIt\Model\Table\SeekItDocumentsTable'];
        $this->SeekItDocuments = TableRegistry::get('SeekItDocuments', $config_documents);

    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeekItDocumentFields);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $seek_document = $this->SeekItDocuments->find()->first();

        $seek_document_fields = $this->SeekItDocumentFields->newEntity();
        $seek_document_fields->seek_it_documents_id = $seek_document->id;
        $seek_document_fields->name = 'fieldA';
        $seek_document_fields->value_string = 'valueOfFieldA';
        $this->SeekItDocumentFields->save($seek_document_fields);

        $seek_document_fields_salved = $this->SeekItDocumentFields->find()->where(['seek_it_documents_id' => $seek_document->id])->all();
        $this->assertNotNull($seek_document_fields_salved);
        $this->assertGreaterThan(1,$seek_document_fields_salved->count());
        $this->assertEquals('valueOfFieldA', $seek_document_fields_salved->last()->value_string);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
