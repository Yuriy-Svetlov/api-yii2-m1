<?php
namespace app\modules\api\v1\models;

use Yii;
//use app\modules\v1\component\classes_bd\Log_userDB;
//use app\modules\v1\component\classes_bd\Result_search_wordDB;

// \yii\base\Model
use yii\db\ActiveRecord;

class User extends ActiveRecord
{

    public $id;
	

    /**
     * DB name
     */
    public static function tableName()
    {
        return 'user';
    }


    /*
        The return data from db
     */
    /*
    public function fields()
    {
        var_dump("expression");

        return ['id', 'name', 'email'];
    }
    */
    




    /*
        If use controller `yii\rest\ActiveController` data validation will be called for all
        class actions except actionIndex and actionView
     */
    public function rules()
    {
        return [
            [
                [   
                    'id', 
                    'name'
                ], 
            'required'],
        ];
    }

}