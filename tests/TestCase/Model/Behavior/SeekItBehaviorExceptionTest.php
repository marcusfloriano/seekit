<?php
namespace SeekIt\Test\TestCase\Model\Behavior;

use Cake\TestSuite\TestCase;
use SeekIt\Model\Behavior\SeekItBehavior;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Table;

/**
 * SeekIt\Model\Behavior\SeekItBehavior Test Case
 */
class SeekItBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SeekIt\Model\Behavior\SeekItBehavior
     */
    public $SeekIt;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeekIt);

        parent::tearDown();
    }

    /**
    * Test exception on not set any config
    *
    * @return void
    */
    public function testExceptionNotSetAnyConfig()
    {
        $this->expectException(\SeekIt\Model\Behavior\SeekItBehaviorException::class);
        $article_table = $this->getMockBuilder(Table::class)->getMock();
        $this->SeekIt = new SeekItBehavior($article_table);
    }

    /**
    * Test exception on not set any config fields fields
    *
    * @return void
    */
    public function testExceptionNotSetAnyConfigFields()
    {
        $this->expectException(\SeekIt\Model\Behavior\SeekItBehaviorException::class);
        $article_table = $this->getMockBuilder(Table::class)->getMock();
        $this->SeekIt = new SeekItBehavior($article_table, ['entity_properties' => []]);
    }

    /**
    * Test don't show exception on not set any config
    *
    * @return void
    */
    public function testExceptionDontShow()
    {
        $article_table = $this->getMockBuilder(Table::class)->getMock();
        $this->SeekIt = new SeekItBehavior($article_table, ['entity_properties' => [
            'title' => 'title'
        ]]);
        $this->assertNotNull($this->SeekIt);
    }

}
