<?php
namespace SeekIt\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SeekItFields Model
 *
 * @method \SeekIt\Model\Entity\SeekItField get($primaryKey, $options = [])
 * @method \SeekIt\Model\Entity\SeekItField newEntity($data = null, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItField[] newEntities(array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItField|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SeekIt\Model\Entity\SeekItField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItField[] patchEntities($entities, array $data, array $options = [])
 * @method \SeekIt\Model\Entity\SeekItField findOrCreate($search, callable $callback = null)
 */
class SeekItFieldsTable extends Table
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

        $this->table('seek_it_fields');
        $this->displayField('name');
        $this->primaryKey('id');
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
}
