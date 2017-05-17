<?php
namespace SeekIt\Model\Entity;

use Cake\ORM\Entity;

/**
 * SeekItDocument Entity
 *
 * @property int $id Id of document added in SeekIt
 * @property string $title Title of document
 * @property string $subtitle Sub-title of document
 * @property string $body Body of document, used for full search, this content should represent all information of document
 * @property string $refid Reference ID it represent the real document indexed
 * @property string $reftype Reference TYPE it represent the type of document, used for create the object from document
 * @property string $serialized Object serialized reference of the real document
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class SeekItDocument extends Entity
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
