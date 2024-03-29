<?php

class CountriesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete', 'enable'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        #Yii::import('application.test.*');
        #echo include_once(Yii::getPathOfAlias('application').'/test.php'); // protected/
        #echo Yii::getPathOfAlias('webroot').'<br>'; // root
        #echo Yii::getPathOfAlias('ext').'<br>'; // protected/extension
        #echo Yii::getPathOfAlias('zii').'<br>'; // framework/zii
        $dataProvider = new CActiveDataProvider('Countries');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Countries();
        if(isset($_POST['Countries'])) {
            $model->attributes = $_POST['Countries'];
            
            if($model->save()):
                Yii::app()->user->setFlash('success', 'Country created!');
                $this->redirect(array('index'));
            else:
                Yii::app()->user->setFlash('danger', 'Country not created!');
            endif;
        }

        $this->render('create', array('model' => $model));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Countries('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Countries']))
            $model->attributes=$_GET['Countries'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Countries']))
        {
            $model->attributes=$_POST['Countries'];
            if($model->save()):
                Yii::app()->user->setFlash('success', 'Country updated!');
                $this->redirect(array('view','id'=>$model->id));
            else:
                Yii::app()->user->setFlash('danger', 'Country not updated!');
            endif;
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            Yii::app()->user->setFlash('success', 'Country deleted!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Update status a particular model.
     * @param integer $id the ID of the model to be update status
     */
    public function actionEnable($id)
    {
        $model = $this->loadModel($id);
        if ($model->status == 1)
            $model->status = 0;
        else 
            $model->status = 1;
        $model->save();
        $this->redirect(array('index'));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Countries::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}