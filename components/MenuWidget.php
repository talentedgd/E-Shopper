<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 19.07.2018
 * Time: 21:22
 */

namespace app\components;

use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl;

    public function init()
    {
        parent::init();
        if ($this->tpl === null) {
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        return $this->tpl;
    }
}