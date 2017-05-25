<?php
namespace SeekIt\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;

class SeekItBehaviorException extends \Exception { }

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

    protected $_config = [];

    public function initialize(array $config)
    {
        if (
            !isset($config['entity_properties']) || 
            !isset($config['entity_properties']['title'])) {
            throw new SeekItBehaviorException('Not defined the entity properties for get the values and create new dowcument');
        }
        $this->_config = $config;
    }

    public function beforeSave(Event $event, EntityInterface $entity)
    {
        $config = $this->_config;
        $value = $entity->get($config['entity_properties']['title']);
    }
}
