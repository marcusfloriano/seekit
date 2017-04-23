<?php
namespace SeekIt\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SeekItDocumentsFields Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Documents
 * @property \Cake\ORM\Association\BelongsTo $SeekItFields
 *
 * @method \SeekIt\Model\Entity\SeekItDocumentsField get($primaryKey, $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentsField newEntity($data = null, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentsField[] newEntities(array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentsField|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentsField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentsField[] patchEntities($entities, array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItDocumentsField findOrCreate($search, callable $callback = null)
 */
class SeekItDocumentsFieldsTable extends Table
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

        $this->table('seek_it_documents_fields');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Documents', [
            'foreignKey' => 'document_id',
            'className' => 'SeekIt.Documents'
        ]);
        $this->belongsTo('SeekItFields', [
            'foreignKey' => 'field_id',
            'className' => 'SeekIt.SeekItFields'
        ]);
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
        $rules->add($rules->existsIn(['document_id'], 'Documents'));
        $rules->add($rules->existsIn(['field_id'], 'SeekItFields'));

        return $rules;
    }
}
