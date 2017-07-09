<?php
namespace Tags\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaggedItem Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property string $model
 * @property string $foreign_key
 * @property int $display_order
 * @property int $tag_id
 *
 * @property \Tags\Model\Entity\Tag $tag
 */
class TaggedItem extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
