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
}
