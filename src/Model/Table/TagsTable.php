<?php
namespace Tags\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tags Model
 *
 * @property \Tags\Model\Table\TaggedItemsTable|\Cake\ORM\Association\HasMany $TaggedItems
 *
 * @method \Tags\Model\Entity\Tag get($primaryKey, $options = [])
 * @method \Tags\Model\Entity\Tag newEntity($data = null, array $options = [])
 * @method \Tags\Model\Entity\Tag[] newEntities(array $data, array $options = [])
 * @method \Tags\Model\Entity\Tag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Tags\Model\Entity\Tag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Tags\Model\Entity\Tag[] patchEntities($entities, array $data, array $options = [])
 * @method \Tags\Model\Entity\Tag findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TagsTable extends Table
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

        $this->setTable('tags');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('TaggedItems', [
            'foreignKey' => 'tag_id',
            'className' => 'Tags.TaggedItems'
        ]);
    }

    public static function slug($str)
    {

        $str = preg_replace('/[\s]/mu', '-', $str);
        $str = preg_replace('/\W/my', '', $str);
        return strtolower($str);
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
            ->allowEmpty('slug');

        return $validator;
	}
	public function getTagID($tag)
	{

        $tag = trim(strtolower($tag));
        $slug = static::slug($tag);

        $result = $this->findBySlug($slug,['contain'=>false])->first();

        if(!empty($result->id)) {
            return $result->id;
        }

		$result = $this->save($this->newEntity([
			'name'=>$tag,
			'slug'=>$slug
		]));

        return $result->id;

    }

	public function handleCommaSeperatedTags($csv)
	{

		$tags = explode(",", $csv);

		$out = [];

		foreach($tags as $tag) {

			$id = $this->getTagID($tag);

			$out[] = ['id'=>$id];

		}

		return $out;

	}

	public function attachTag($tag,$model,$foreignKey)
	{

        $id = $this->getTagID($tag);

        $item = $this->TaggedItems->newEntity([
                    "tag_id"=>$id,
                    "model"=>$model,
                    "foreign_key"=>$foreignKey
                ]);
        return $this->TaggedItems->save($item);
    }

	public function handleDelete($TagID)
	{

        $conn = \Cake\Datasource\ConnectionManager::get("default");

        $conn->begin();

        $tag = $this->find()->contain("TaggedItems")->where(["id"=>$TagID])->first();

        foreach($tag->tagged_items as $item) {
            if(!$this->TaggedItems->delete($item)) {
                $conn->rollback();
                return false;
            }
        }

        if($this->delete($tag,['atomic'=>true])) {
            $conn->commit();
            return true;
        }

        $conn->rollback();
        
        return false;

    }
}
