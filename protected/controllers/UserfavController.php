<?php

class UserfavController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
protected $menuname = 'userfav';

	public function actionHelp()
	{
	  $txt = '';
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $txt = '_help'; break;
				case 2 : $txt = '_helpmodif'; break;
			}
		}
	  parent::actionHelp($txt);
	}
	
	public $menuaccess,$useraccess;

	public function lookupdata()
	{
	  $this->menuaccess = new Menuaccess('searchwstatus');
	  $this->menuaccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Menuaccess']))
		$this->menuaccess->attributes=$_GET['Menuaccess'];

		$this->useraccess = new Useraccess('searchwstatus');
	  $this->useraccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Useraccess']))
		$this->useraccess->attributes=$_GET['Useraccess'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
	  $model=new Userfav;
	  $this->lookupdata();
	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
				'menuaccess'=>$this->menuaccess,
				'useraccess'=>$this->useraccess), true)
			  ));
		  Yii::app()->end();
	  }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
	  parent::actionUpdate();
	  $id=$_POST['id'];
	  $model=$this->loadModel($id[0]);
	  $this->lookupdata();

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'userfavid'=>$model->userfavid,
			  'useraccessid'=>$model->useraccessid,
			  'realname'=>$model->useraccess->realname,
			  'menuaccessid'=>$model->menuaccessid,
			  'menuname'=>$model->menuaccess->menuname,
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
				'menuaccess'=>$this->menuaccess,
				'useraccess'=>$this->useraccess), true)
			  ));
		  Yii::app()->end();
	  }
	}

	public function actionWrite()
	{
		parent::actionWrite();
	  if(isset($_POST['Userfav']))
	  {
		$dataku->attributes=$_POST['Userfav'];
		if ((int)$dataku->attributes['userfavid'] > 0)
		{
		  $model=$this->loadModel($dataku->attributes['userfavid']);
		  $model->useraccessid = $dataku->attributes['useraccessid'];
		  $model->menuaccessid = $dataku->attributes['menuaccessid'];
		}
		else
		{
		  $model = new Userfav();
		  $model->attributes=$_POST['Userfav'];
		}
		try
		{
		  if($model->save())
		  {
			if (Yii::app()->request->isAjaxRequest)
			  {
				echo CJSON::encode(array(
				  'status'=>'success',
				  'div'=>"Data saved"
				));
			  }
		  }
		  else
		  {
			$errormessage=$model->getErrors();
			if (Yii::app()->request->isAjaxRequest)
			{
			  echo CJSON::encode(array(
				'status'=>'failure',
				'div'=>$errormessage
              ));
            }
		  }
		}
		catch (Exception $e)
		{
		  $errormessage=$e->getMessage();
		  if (Yii::app()->request->isAjaxRequest)
			{
			  echo CJSON::encode(array(
				'status'=>'failure',
				'div'=>$errormessage
              ));
            }
		}
	  }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
	  parent::actionDelete();
	  $id=$_POST['id'];
	  foreach($id as $ids)
	  {
		$model=$this->loadModel($ids);
		$model->delete();
	  }
	  echo CJSON::encode(array(
			  'status'=>'success',
			  'div'=>'Data deleted'
			  ));
	  Yii::app()->end();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	  parent::actionIndex();
	  $this->lookupdata();
		$model=new Userfav('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Userfav']))
			$model->attributes=$_GET['Userfav'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
				'menuaccess'=>$this->menuaccess,
				'useraccess'=>$this->useraccess
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Userfav::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='userfav-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
