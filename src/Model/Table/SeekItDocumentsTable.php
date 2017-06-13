<?php
namespace SeekIt\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SeekItDocuments Model
 *
 * @method \SeekIt\Model\Entity\SeekItDocument get($primaryKey, $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocument newEntity($data = null, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocument[] newEntities(array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocument|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocument[] patchEntities($entities, array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocument findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SeekItDocumentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('seek_it_documents');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('SeekItDocumentFields')
            ->setForeignKey('seek_it_documents_id')
            ->setDependent(true);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->allowEmpty('subtitle');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        $validator
            ->allowEmpty('refid');

        $validator
            ->allowEmpty('reftype');

        $validator
            ->allowEmpty('serialized');

        return $validator;
    }
}
