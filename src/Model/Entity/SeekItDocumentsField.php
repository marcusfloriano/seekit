<?php
namespace SeekIt\Model\Entity;

use Cake\ORM\Entity;

/**
 * SeekItDocumentsField Entity
 *
 * @property int $id
 * @property int $document_id
 * @property int $field_id
 *
 * @property \SeekIt\Model\Entity\Document $document
 * @property \SeekIt\Model\Entity\SeekItField $seek_it_field
 */
class SeekItDocumentsField extends Entity
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
