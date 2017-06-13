<?php
namespace SeekIt\Model\Entity;

use Cake\ORM\Entity;

/**
 * SeekItDocumentField Entity
 *
 * @property int $id
 * @property int $seek_it_documents_id
 * @property string $name
 * @property string $value_string
 * @property int $value_integer
 * @property \Cake\I18n\Time $value_datetime
 *
 * @property \SeekIt\Model\Entity\Document $document
 */
class SeekItDocumentField extends Entity
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

    protected function _getValue() {
        if(!empty($this->value_string)) {
            return $this->value_string;
        } else if(!empty($this->value_integer)) {
            return $this->value_integer;
        } else if(!empty($this->value_datetime)) {
            return $this->value_datetime;
        }
    }
}
