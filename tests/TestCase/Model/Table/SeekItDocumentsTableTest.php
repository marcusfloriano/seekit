<?php
namespace SeekIt\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SeekIt\Model\Table\SeekItDocumentsTable;

/**
 * SeekIt\Model\Table\SeekItDocumentsTable Test Case
 */
class SeekItDocumentsTableTest extends TestCase
{

    /**
     * Test subject
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
        $config = TableRegistry::exists('SeekItDocuments') ? [] : ['className' => 'SeekIt\Model\Table\SeekItDocumentsTable'];
        $this->SeekItDocuments = TableRegistry::get('SeekItDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeekItDocuments);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testCreateNewDocument()
    {
        $seek_document = $this->SeekItDocuments->newEntity();
        $seek_document->title = "New document for add";
        $seek_document->subtitle = "The subtitle of new document";
        $seek_document->body = "The body of document, this contains all text that represent this document.";
        $seek_document->refid = "ABCDFG";
        $seek_document->reftype = "content";
        if($this->SeekItDocuments->save($seek_document)){
            $this->assertGreaterThan(1, $seek_document->id);
        }
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
}
