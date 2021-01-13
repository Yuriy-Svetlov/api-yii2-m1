<?php
namespace app\modules\api_model_1_default\v1\controllers;

use yii;
use yii\rest\ActiveController;
//use app\modules\api\v1\UserModel;
use app\modules\api_model_1_default\v1\models\User;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UnprocessableEntityHttpException;
use yii\base\DynamicModel;
use yii\data\Pagination;


class UserController extends ActiveController
{


  public $modelClass = 'app\modules\api_model_1_default\v1\models\User';


  public function behaviors() {
      return [
          [
              'class' => \yii\filters\ContentNegotiator::className(),
              //'only' => ['index', 'view'],
              'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
              ],
          ],
      ];
  }


  public function actions()
  {
      $actions = parent::actions();

      // disable the "delete" and "create" actions
      //unset($actions['delete'], $actions['create']);
      unset(
        $actions['index'],
        $actions['view']
      );

      // customize the data provider preparation with the "prepareDataProvider()" method
      //$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider2'];
      
      return $actions;
  }


  /*
    Overwrite action Index
    By default, the action View will not be call validate() in model.
   */
  public function actionIndex()
  {   
      /**
        Pagination
        https://www.yiiframework.com/doc/api/2.0/yii-data-activedataprovider
       */
      /*
      $provider = new ActiveDataProvider([
          'query' => User::find(),
          'pagination' => [
              'pageSize' => 2,
              'page' => 1,
          ],
      ]);

      $posts = $provider->getModels();

      return $posts;
      */

      return User::find()->all();
  }


  /*
    Overwrite action View
    By default, the action View will not be call validate() in model.
   */
  public function actionView($id)
  {   
      $model = new DynamicModel(compact('id'));
      $model
      ->addRule(['id'], 'required')
      ->addRule(['id'], 'integer')
      //->addRule(['id'], 'in', ['range' => [1, 2, 3]])
      ->addRule(['id'], 'number', ['min' => 1, 'max' => 3])
      ->validate();

      // Response - error of validation
      // ------------------------------
      if ($model->hasErrors()) {
          Yii::$app->response->setStatusCode(422, 'Data Validation Failed.');
          
          $errors = [];
          foreach ($model->getErrors() as $key => $value) {
              $errors[] = ["field" => $key, "message" => $value[0]];
          } 

          return $errors;
      }  
      // ------------------------------
      
      // Get data
      // ------------------------------ 
      $users = User::find()->where(['id' => $model->id])->limit(1)->one();
      // ------------------------------

      // Response - Not found
      // ------------------------------
      if($users == null){
          throw new NotFoundHttpException(
            'Object not found: ' . $model->id, 0
          );
      }
      // ------------------------------
      // 
      return $users;
  }


  /*
    Overwrite action Create
   */
  /*
  public function actionCreate($id)
  {

  }
  */
 

  /*
    Overwrite action Create
   */
  /*
  public function actionUpdate($id)
  {

  }
  */


  /*
    Overwrite action Update
   */
  /*
  public function actionUpdate($id)
  {

  }
  */


  /*
    Overwrite action Delete
   */
  /*
  public function actionDelete($id)
  {

  }
  */


  /*
  public function prepareDataProvider2()
  {
      // prepare and return a data provider for the "index" action
      $provider = new ActiveDataProvider([
          'query' => User::find(),
          'pagination' => [
              'pageSize' => 1,
          ],
      ]);

    // get the posts in the current page
    $posts = $provider->getModels();

    return $posts;
  }
  */


  /**
   * Checks the privilege of the current user.
   *
   * This method should be overridden to check whether the current user has the privilege
   * to run the specified action against the specified data model.
   * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
   *
   * @param string $action the ID of the action to be executed
   * @param \yii\base\Model $model the model to be accessed. If `null`, it means no specific model is being accessed.
   * @param array $params additional parameters
   * @throws ForbiddenHttpException if the user does not have access
   */
  /*
  public function checkAccess($action, $model = null, $params = [])
  {
      // check if the user can access $action and $model
      // throw ForbiddenHttpException if access should be denied
      if ($action === 'update' || $action === 'delete') {
          if ($model->author_id !== \Yii::$app->user->id)
              throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
      }
  }
  */

}
