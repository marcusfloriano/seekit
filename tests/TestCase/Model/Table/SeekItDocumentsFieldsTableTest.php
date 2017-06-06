<?php
namespace SeekIt\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SeekIt\Model\Table\SeekItDocumentsFieldsTable;

/**
 * SeekIt\Model\Table\SeekItDocumentsFieldsTable Test Case
 */
class SeekItDocumentsFieldsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SeekIt\Model\Table\SeekItDocumentsFieldsTable
     */
    public $SeekItDocumentsFields;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.seek_it.seek_it_documents_fields',
        'plugin.seek_it.seek_it.documents',
        'plugin.seek_it.seek_it_fields'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SeekItDocumentsFields') ? [] : ['className' => 'SeekIt\Model\Table\SeekItDocumentsFieldsTable'];
        $this->SeekItDocumentsFields = TableRegistry::get('SeekItDocumentsFields', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeekItDocumentsFields);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
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
