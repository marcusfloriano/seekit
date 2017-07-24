<?php
namespace SeekIt\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use SeekIt\View\Helper\ResultsHelper;

/**
 * SeekIt\View\Helper\ResultsHelper Test Case
 */
class ResultsHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SeekIt\View\Helper\ResultsHelper
     */
    public $Results;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Results = new ResultsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Results);

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
