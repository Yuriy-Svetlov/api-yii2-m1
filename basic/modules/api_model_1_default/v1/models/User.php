<?php
namespace app\modules\api_model_1_default\v1\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{


    /**
     * 
     */
    public static function tableName()
    {
        return 'user';
    }


    /**
     * 
     */
    public function fields()
    {
        // Data from db
        $fields = parent::fields();
    
        return ['id', 'name', 'email'];
    }


    /**
     * http://mydomian.com/api/model_1/users?fields=id,email&expand=extra_data
     * 
     * https://www.yiiframework.com/doc/guide/2.0/en/rest-resources
     */
    public function extraFields()
    {
        return [
            'extra_data' => function($item){
                //$item->id;
                //$customer = Profile::find()->where(['id' => $item->id])->one();
                return ['test' => $item->id + 100];
            },           
        ]; 
    }


    /**
     * Called for all action expect Index and View
     */
    public function rules()
    {
        return [
            [[
                'name', 
                'email',
                'tel'
            ], 
            'required'],

            ['name', 'string', 'length' => [4, 22]],

            ['email', 'email'],
        ];
    }

}