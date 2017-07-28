<?php
namespace SeekIt\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Cake\Core\Configure;

/**
 * SeekFilter helper
 */
class SeekFilterHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'filters' => []
    ];

    private function getFilters() {
        $filters = Configure::read('SeekIt.filters');
        if(!empty($filters)) {
            return $filters;
        }
        return $this->_defaultConfig['filters'];;
    }

    public function showFilters() {
        $options = "";

        foreach($this->getFilters() as $key => $value) {
            $options .= "<option>".$key."</option>";
        }

        return $options;
    }

}
