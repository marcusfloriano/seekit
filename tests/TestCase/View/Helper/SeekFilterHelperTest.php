<?php
namespace SeekIt\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use SeekIt\View\Helper\SeekFilterHelper;

/**
 * SeekIt\View\Helper\SeekFilterHelper Test Case
 */
class SeekFilterHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SeekIt\View\Helper\SeekFilterHelper
     */
    public $SeekFilter;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->SeekFilter = new SeekFilterHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeekFilter);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
