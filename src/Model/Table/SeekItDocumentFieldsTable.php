<?php
namespace SeekIt\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SeekItDocumentFields Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SeekItDocuments
 *
 * @method \SeekIt\Model\Entity\SeekItDocumentField get($primaryKey, $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentField newEntity($data = null, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentField[] newEntities(array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentField|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentField[] patchEntities($entities, array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentField findOrCreate($search, callable $callback = null, $options = [])
 */
class SeekItDocumentFieldsTable extends Table
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

        $this->table('seek_it_document_fields');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('SeekIt.SeekItDocuments');
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('value_string');

        $validator
            ->integer('value_integer')
            ->allowEmpty('value_integer');

        $validator
            ->dateTime('value_datetime')
            ->allowEmpty('value_datetime');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }
}
