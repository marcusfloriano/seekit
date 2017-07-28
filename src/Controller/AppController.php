<?php

namespace SeekIt\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    public $helpers = [
        'SeekIt.SeekResults',
        'SeekIt.SeekFilter'
    ];
}
