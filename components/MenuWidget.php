<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 19.07.2018
 * Time: 21:22
 */

namespace app\components;

use yii\base\Widget;
use app\models\Category;

class MenuWidget extends Widget
{
    public $tpl; // Параметр, который передается из вида, который указывает как отобразить виджет
    public $data; // Массив категорий из БД
    public $tree; // Результат работы функции, которая будет строить из обычного массива массив дерева
    public $menuHtml; // Готовый HTML код в зависимости от шаблона $tpl

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
        $this->data = Category::find()->asArray()->indexBy('id')->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        return $this->menuHtml;
    }

    /**
     * Преобразование массива, полученного из БД в дерево для отображения
     *
     * @return array
     */
    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree)
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }

    protected function catToTemplate($category)
    {
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}