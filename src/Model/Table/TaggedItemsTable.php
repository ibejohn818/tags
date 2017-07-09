<?php
namespace Tags\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaggedItems Model
 *
 * @property \Tags\Model\Table\TagsTable|\Cake\ORM\Association\BelongsTo $Tags
 *
 * @method \Tags\Model\Entity\TaggedItem get($primaryKey, $options = [])
 * @method \Tags\Model\Entity\TaggedItem newEntity($data = null, array $options = [])
 * @method \Tags\Model\Entity\TaggedItem[] newEntities(array $data, array $options = [])
 * @method \Tags\Model\Entity\TaggedItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Tags\Model\Entity\TaggedItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Tags\Model\Entity\TaggedItem[] patchEntities($entities, array $data, array $options = [])
 * @method \Tags\Model\Entity\TaggedItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TaggedItemsTable extends Table
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

        $this->setTable('tagged_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
            'className' => 'Tags.Tags'
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

        $validator
            ->allowEmpty('model');

        $validator
            ->allowEmpty('foreign_key');

        $validator
            ->integer('display_order')
            ->allowEmpty('display_order');

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
        $rules->add($rules->existsIn(['tag_id'], 'Tags'));

        return $rules;
    }
}
