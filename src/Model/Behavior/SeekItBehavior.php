<?php
namespace SeekIt\Model\Behavior;

use ArrayObject;

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
     * Table Registry instance for SeekItDocuments
     *
     * @var SeekIt\Model\Table\SeekItDocumentsTable
     */
    protected $_seekItDocuments;

    /**
     * Table Registry instance for SeekItDocumentFields
     *
     * @var SeekIt\Model\Table\SeekItDocumentFieldsTable
     */
    protected $_seekItDocumentFields;

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
        $this->_seekItDocumentFields = TableRegistry::get('SeekIt.SeekItDocumentFields');
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
        $seek_it_document = null;
        $seek_it_documents = $this->_seekItDocuments->find()->where(['refid' => $entity->get($config['entity_properties']['refid'])]);

        if ($seek_it_documents->count() == 0) {
            $seek_it_document = $this->_seekItDocuments->newEntity();
        } else {
            $seek_it_document = $seek_it_documents->first();
        }

        $seek_it_document->refid = $entity->get($config['entity_properties']['refid']);
        $seek_it_document->title = $entity->get($config['entity_properties']['title']);
        $seek_it_document->subtitle = $entity->get($config['entity_properties']['subtitle']);
        $seek_it_document->body = $entity->get($config['entity_properties']['body']);
        $seek_it_document->reftype = get_class($entity);
        $seek_it_document->serialized = serialize($entity);            

        try {
            if (!$this->_seekItDocuments->save($seek_it_document)) {
                throw new SeekItBehaviorException('Erro in save the document: ' . $seek_it_document->refid);
            }
        } catch (\Exception $e) {
            throw new SeekItBehaviorException($e->getMessage());
        }

        if(isset($config['fields'])) {
            foreach($config['fields'] as $key => $field) {
                $seek_it_document_field = null;
                if(empty($seek_it_document->SeekItDocumentFields)) {
                    $seek_it_document_field = $this->_seekItDocumentFields->newEntity();
                }
                $seek_it_document_field->seek_it_documents_id = $seek_it_document->id;
                $seek_it_document_field->name = $key;
                $seek_it_document_field->set("value_" . $field['type'], $entity->get($field['value']));
                try {
                    if (!$this->_seekItDocumentFields->save($seek_it_document_field)) {
                        throw new SeekItBehaviorException('Erro in save the field "' . $key . '" of document: ' . $seek_it_document->refid);
                    }
                } catch (\Exception $e) {
                    throw new SeekItBehaviorException($e->getMessage());
                }                
            }
        }
    }

    /**
     * Delete Document when the Entity is deleted
     *
     * @param Event $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options)
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
