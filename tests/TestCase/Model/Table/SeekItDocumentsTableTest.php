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
        $article = $this->getMockBuilder('Article')
            ->setMethods(['getId','getTitle','getSubTitle','getBody'])
            ->getMock();
        $article->method('getId')->willReturn('ABCDEFG');
        $article->method('getTitle')->willReturn('New document for add');
        $article->method('getSubTitle')->willReturn("The subtitle of new document");
        $article->method('getBody')->willReturn("The body of document, this contains all text that represent this document.");
        
        $seek_document = $this->SeekItDocuments->newEntity();
        $seek_document->title = $article->getTitle();
        $seek_document->subtitle = $article->getSubTitle();
        $seek_document->body = $article->getBody();
        $seek_document->refid = $article->getId();
        $seek_document->reftype = get_class($article);
        $seek_document->serialize = serialize($article);

        if($this->SeekItDocuments->save($seek_document)){
            $this->assertGreaterThan(1, $seek_document->id);
            $article_unserialize = unserialize($seek_document->serialize);
            $this->assertEquals($article_unserialize->getId(),"ABCDEFG");
            $this->assertEquals($article_unserialize->getTitle(),"New document for add");
        }
    }

    public function testDeleteDocument()
    {
        $article = $this->getMockBuilder('Article')
            ->setMethods(['getId','getTitle','getSubTitle','getBody'])
            ->getMock();
        $article->method('getId')->willReturn('ABCDEFG');
        $article->method('getTitle')->willReturn('New document for add');
        $article->method('getSubTitle')->willReturn("The subtitle of new document");
        $article->method('getBody')->willReturn("The body of document, this contains all text that represent this document.");
        
        $seek_document = $this->SeekItDocuments->newEntity();
        $seek_document->title = $article->getTitle();
        $seek_document->subtitle = $article->getSubTitle();
        $seek_document->body = $article->getBody();
        $seek_document->refid = $article->getId();
        $seek_document->reftype = get_class($article);
        $seek_document->serialize = serialize($article);

        if($this->SeekItDocuments->save($seek_document)){
            $this->assertGreaterThan(1, $seek_document->id);
            $article_unserialize = unserialize($seek_document->serialize);
            $this->assertEquals($article_unserialize->getId(),"ABCDEFG");
            $this->assertEquals($article_unserialize->getTitle(),"New document for add");
        }

        $seek_document_for_delete = $this->SeekItDocuments->find()->where(['refid' => 'ABCDEFG'])->first();
        $this->assertNotNull($seek_document_for_delete);
        $this->assertEquals($seek_document_for_delete->refid,"ABCDEFG");

        $this->SeekItDocuments->delete($seek_document_for_delete);
        $this->assertEquals($this->SeekItDocuments->find()->count(), 1);
    }


}
