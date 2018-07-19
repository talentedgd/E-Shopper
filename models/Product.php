<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 19.07.2018
 * Time: 21:06
 */

namespace app\models;

use yii\db\ActiveRecord;


class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}