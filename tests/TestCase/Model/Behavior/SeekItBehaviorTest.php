<?php
namespace SeekIt\Test\TestCase\Model\Behavior;

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\ORM\Entity;

use Cake\TestSuite\TestCase;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;

use SeekIt\Model\Behavior\SeekItBehavior;
use SeekIt\Model\Table\SeekItDocumentsTable;


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
                'refid' => 'id',
                'title' => 'title',
                'subtitle' => 'subtitle',
                'body' => 'content'
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
     * Test basic before save
     *
     * @return void
     */
    public function testSaveDocumentOnBeforeSave()
    {
        $event = new Event("Before.save", null, null);
        $entity = new Entity([],[]);
        $entity->id = "ABCDEFG";
        $entity->title = "Title of article";
        $entity->subtitle = "Sub title of article";
        $entity->content = "Content of article";

        $this->SeekIt->beforeSave($event, $entity);

        $seek_document_for_delete = $this->SeekItDocuments->find()->where(['refid' => 'ABCDEFG'])->first();
        $this->assertNotNull($seek_document_for_delete);
        $this->assertEquals($seek_document_for_delete->refid,"ABCDEFG");
        $this->assertEquals($seek_document_for_delete->title,"Title of article");
        $this->assertEquals($seek_document_for_delete->subtitle,"Sub title of article");
        $this->assertEquals($seek_document_for_delete->body,"Content of article");
        $this->assertEquals($seek_document_for_delete->reftype,"Cake\ORM\Entity");
        $unserialized = unserialize($seek_document_for_delete->serialized);
        $this->assertNotNull($unserialized);
        $this->assertEquals(get_class($unserialized),"Cake\ORM\Entity");
    }

    /**
     * Test update the document
     *
     * @return void
     */
    public function testUpdateDocumentOnBeforeSave()
    {
        $event = new Event("Before.save", null, null);
        $entity = new Entity([],[]);
        $entity->id = "ABCDEFG";
        $entity->title = "Title of article";
        $entity->subtitle = "Sub title of article";
        $entity->content = "Content of article";

        $this->SeekIt->beforeSave($event, $entity);

        $seek_document_for_delete = $this->SeekItDocuments->find()->where(['refid' => 'ABCDEFG'])->first();
        $this->assertNotNull($seek_document_for_delete);
        $this->assertEquals($seek_document_for_delete->refid,"ABCDEFG");
        $this->assertEquals($seek_document_for_delete->title,"Title of article");
        $this->assertEquals($seek_document_for_delete->subtitle,"Sub title of article");
        $this->assertEquals($seek_document_for_delete->body,"Content of article");
        $this->assertEquals($seek_document_for_delete->reftype,"Cake\ORM\Entity");
        $unserialized = unserialize($seek_document_for_delete->serialized);
        $this->assertNotNull($unserialized);
        $this->assertEquals(get_class($unserialized),"Cake\ORM\Entity");

        $entity->title = "Title of article UPDATE";
        $this->SeekIt->beforeSave($event, $entity);

        $seek_document_for_deletes = $this->SeekItDocuments->find()->where(['refid' => 'ABCDEFG']);
        $this->assertEquals(1, $seek_document_for_deletes->count());
        $seek_document_for_delete = $seek_document_for_deletes->first();
        $this->assertEquals("Title of article UPDATE", $seek_document_for_delete->title);

    }

    public function testDeleteDocumentOnBeforeDelete()
    {
        $event = new Event("Before.save", null, null);
        $entity = new Entity([],[]);
        $entity->id = "ABCDEFG";
        $entity->title = "Title of article";
        $entity->subtitle = "Sub title of article";
        $entity->content = "Content of article";

        $this->SeekIt->beforeSave($event, $entity);

        $seek_document_for_delete = $this->SeekItDocuments->find()->where(['refid' => 'ABCDEFG'])->first();
        $this->assertNotNull($seek_document_for_delete);
        $this->assertEquals($seek_document_for_delete->refid,"ABCDEFG");
        $this->assertEquals($seek_document_for_delete->title,"Title of article");
        $this->assertEquals($seek_document_for_delete->subtitle,"Sub title of article");
        $this->assertEquals($seek_document_for_delete->body,"Content of article");
        $this->assertEquals($seek_document_for_delete->reftype,"Cake\ORM\Entity");
        $unserialized = unserialize($seek_document_for_delete->serialized);
        $this->assertNotNull($unserialized);
        $this->assertEquals(get_class($unserialized),"Cake\ORM\Entity");

        $event = new Event("Before.delete", null, null);
        $entity = new Entity([],[]);
        $entity->id = "ABCDEFG";
        $entity->title = "Title of article";
        $entity->subtitle = "Sub title of article";
        $entity->content = "Content of article";

        $this->SeekIt->beforeDelete($event, $entity);

        $seek_document_for_deletes = $this->SeekItDocuments->find()->where(['refid' => 'ABCDEFG']);
        $this->assertEquals(0, $seek_document_for_deletes->count());
    }
}
