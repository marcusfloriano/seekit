<?php
namespace SeekIt\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

use Cake\Event\Event;
use Cake\Datasource\EntityInterface;

use SeekIt\Model\Table\SeekItDocumentsTable;

class SeekItBehaviorException extends \Exception
{

}

/**
 * SeekIt behavior
 */
class SeekItBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'entity_properties' => [
            'title' => null
        ]
    ];

    /**
     * Table Registry instance of SeekItDocuments
     *
     * @var SeekIt\Model\Table\SeekItDocumentsTable
     */
    protected $_seekItDocuments;

    protected $_config = [];

    public function initialize(array $config)
    {
        if (!isset($config['entity_properties']) ||
            !isset($config['entity_properties']['refid']) ||
            !isset($config['entity_properties']['title']) ||
            !isset($config['entity_properties']['subtitle']) ||
            !isset($config['entity_properties']['body'])) {
            throw new SeekItBehaviorException('Not defined the entity required properties for get the values and create new documents from entity.');
        }
        $this->_config = $config;
        $this->_seekItDocuments = TableRegistry::get('SeekIt.SeekItDocuments');
    }

    /**
     * Create or update new Document when the Entity is created or updated
     *
     * @param Event $event
     * @param EntityInterface $entity
     * @return void
     */
    public function beforeSave(Event $event, EntityInterface $entity)
    {
        $config = $this->_config;
        $seek_document = null;
        $seek_documents = $this->_seekItDocuments->find()->where(['refid' => $entity->get($config['entity_properties']['refid'])]);

        if ($seek_documents->count() == 0) {
            $seek_document = $this->_seekItDocuments->newEntity();
        } else {
            $seek_document = $seek_documents->first();
        }

        $seek_document->refid = $entity->get($config['entity_properties']['refid']);
        $seek_document->title = $entity->get($config['entity_properties']['title']);
        $seek_document->subtitle = $entity->get($config['entity_properties']['subtitle']);
        $seek_document->body = $entity->get($config['entity_properties']['body']);
        $seek_document->reftype = get_class($entity);
        $seek_document->serialized = serialize($entity);            

        try {
            if (!$this->_seekItDocuments->save($seek_document)) {
                throw new SeekItBehaviorException('Erro in save the document: ' . $seek_document->refid);
            }
        } catch (\Exception $e) {
            throw new SeekItBehaviorException($e->getMessage());
        }
    }

    public function beforeDelete(Event $event, EntityInterface $entity)
    {
        $config = $this->_config;
        $seek_document = null;
        $seek_documents = $this->_seekItDocuments->find()->where(['refid' => $entity->get($config['entity_properties']['refid'])]);
        if ($seek_documents->count() > 0) {
            $seek_document = $seek_documents->first();
            try {
                $this->_seekItDocuments->delete($seek_document);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                throw new SeekItBehaviorException('Erro in delete the document: ' . $e->getEntity());
            }
        }
    }
}
