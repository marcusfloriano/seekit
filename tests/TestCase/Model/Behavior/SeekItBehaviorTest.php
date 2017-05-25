<?php
namespace SeekIt\Test\TestCase\Model\Behavior;

use Cake\ORM\TableRegistry;
use SeekIt\Model\Table\SeekItDocumentsTable;
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
     * Table where saved content on the real process
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

        $config = TableRegistry::exists('SeekItDocuments') ? [] : ['className' => 'SeekIt\Model\Table\SeekItDocumentsTable'];
        $this->SeekItDocuments = TableRegistry::get('SeekItDocuments', $config);

        $article_table = $this->getMockBuilder(Table::class)->getMock();
        $this->SeekIt = new SeekItBehavior($article_table, [
            'entity_properties'=> [
                'title' => 'title'
            ]
        ]);
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
     * Test correct use for before save
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $event = new Event("Before.save", null, null);
        $this->SeekIt->beforeSave(
            $event, 
            $this->getMockBuilder(EntityInterface::class)->getMock());

        $seek_document_for_delete = $this->SeekItDocuments->find()->where(['refid' => 'ABCDEFG'])->first();
        $this->assertNotNull($seek_document_for_delete);
        $this->assertEquals($seek_document_for_delete->refid,"ABCDEFG");

    }
}
