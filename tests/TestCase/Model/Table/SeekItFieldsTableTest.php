<?php
namespace SeekIt\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SeekIt\Model\Table\SeekItFieldsTable;

/**
 * SeekIt\Model\Table\SeekItFieldsTable Test Case
 */
class SeekItFieldsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SeekIt\Model\Table\SeekItFieldsTable
     */
    public $SeekItFields;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('SeekItFields') ? [] : ['className' => 'SeekIt\Model\Table\SeekItFieldsTable'];
        $this->SeekItFields = TableRegistry::get('SeekItFields', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeekItFields);

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
