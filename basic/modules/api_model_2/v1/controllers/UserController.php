<?php
namespace app\modules\api_model_2\v1\controllers;


use yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;


class UserController extends Controller
{

    public function behaviors() {
      return [
          'verbs' => [
              'class' => \yii\filters\VerbFilter::className(),
              'actions' => [
                  'index'  => ['GET'],
                  'view'   => ['GET'],
                  'create' => ['GET', 'POST'],
                  'update' => ['GET', 'PUT', 'POST'],
                  'delete' => ['POST', 'DELETE'],
              ],
          ],         
          [
            'class' => \yii\filters\ContentNegotiator::className(),
            //'only' => ['index', 'view'],
            'formats' => [
              'application/json' => \yii\web\Response::FORMAT_JSON,
            ],         
          ],
      ];
    }


    public function actionIndex() {   
        return [
          ['id' => 1, 'name' => 'Username-1'],
          ['id' => 2, 'name' => 'Username-2'] 
        ];
    }


    public function actionView($id) { 
        $users = [];
        $users[] = ['id' => 1, 'name' => 'Username-1'];
        $users[] = ['id' => 2, 'name' => 'Username-2'];

        $user = [];
        foreach($users as $key => $value) {
            if($users[$key]["id"] == $id){
              $user = $users[$key];
              break;
            }
        }

        if($user == []){
            // Response - Not found
            throw new NotFoundHttpException(
              'Object not found: ' . $model->id, 0
            );
        }  

        return $user;
    }

}
