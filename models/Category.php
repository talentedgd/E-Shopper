<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 19.07.2018
 * Time: 21:06
 */

namespace app\models;

use yii\db\ActiveRecord;


class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
}