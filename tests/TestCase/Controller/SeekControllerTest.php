<?php
namespace SeekIt\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use SeekIt\Controller\SeekController;

/**
 * SeekIt\Controller\SeekController Test Case
 */
class SeekControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.seek_it.seek_it_documents_fields',
        'plugin.seek_it.seek_it_documents',
        'plugin.seek_it.seek_it_fields'
    ];

    /**
     * SetUp for each test
     *
     * @return void
     */
    public function setUp()
    {
        
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $_SERVER['REQUEST_URI'] = "/seek-it/seek";
        $this->get($_SERVER['REQUEST_URI']);
        debug($this->_response);
        $this->assertResponseSuccess();
        $this->assertResponseCode(200);
        $this->assertResponseContains("Audência Una");
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
