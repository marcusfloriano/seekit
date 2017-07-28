<?php
namespace SeekIt\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Cake\Core\Configure;

/**
 * Results helper
 */
class SeekResultsHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'fields' => ['Type', 'Title']
    ];

    private function getFields() {
        $extra_fields = Configure::read('SeekIt.fields');
        if(!empty($extra_fields)) {
            return $extra_fields;
        }
        return $this->_defaultConfig['fields'];;
    }
    
    public function showHeadTable() {
        
        $head = "";
        $head .= "<thead>";
        $head .= "  <tr>";

        foreach($this->getFields() as $field) {
            $head .= "      <th>".$field."</th>";    
        }

        $head .= "  </tr>";
        $head .= "</thead>";

        return $head;
    }

    public function showTrBodyTable($item) {
        if(empty($item)) {
            return "";
        }
        $html = "";
        $html .= "<tr>";
        foreach($this->getFields() as $field) {
            if($field == "Type") {
                $html .= "  <td>".$item->reftype."</td>";
            } elseif($field == "Title") {
                $html .= "  <td>".$item->title."</td>";
            } else {
                
                if(!empty($item->seek_it_document_fields) && count($item->seek_it_document_fields) > 0) {
                    foreach ($item->seek_it_document_fields as $value) {
                        if($value->name == $field) {
                            $html .= "  <td>".$value->value."</td>";
                        }
                    }
                } else {
                    $html .= "  <td>-</td>";
                }
            }
        }
        $html .= "</tr>";
        return $html;
    }

}
