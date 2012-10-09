<?php

class SnrodetController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'snrodet';

	public function actionHelp()
	{
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $this->txt = '_help'; break;
				case 2 : $this->txt = '_helpmodif'; break;
			}
		}
	  parent::actionHelp();
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
		$model=new Snrodet;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model), true)
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
      if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'snrodid'=>$model->snrodid,
				'snroid'=>$model->snroid,
				'curdd'=>$model->curdd,
				'curmm'=>$model->curmm,
				'curyy'=>$model->curyy,
				'curvalue'=>$model->curvalue,
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)
				));
            Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Snrodet'], $_POST['Snrodet']['snrodid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Snrodet']))
	  {
		$messages = $this->ValidateData(
                array(array($_POST['Snrodet']['snroid'],'emptysnro','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Snrodet'];
		if ((int)$_POST['Snrodet']['snrodid'] > 0)
		{
		  $model=$this->loadModel($_POST['Snrodet']['snrodid']);
		  $model->snroid = $_POST['Snrodet']['snroid'];
		  $model->curdd = $_POST['Snrodet']['curdd'];
		  $model->curmm = $_POST['Snrodet']['curmm'];
		  $model->curyy = $_POST['Snrodet']['curyy'];
		  $model->curvalue = $_POST['Snrodet']['curvalue'];
		}
		else
		{
		  $model = new Snrodet();
		  $model->attributes=$_POST['Snrodet'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Snrodet']['snrodid']);
              $this->GetSMessage('scoinsertsuccess');
            }
            else
            {
              $this->GetMessage($model->getErrors());
            }
          }
          catch (Exception $e)
          {
            $this->GetMessage($e->getMessage());
          }
		}
	  }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
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
    $model=new Snrodet('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Snrodet']))
			$model->attributes=$_GET['Snrodet'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionDownload()
	{
		parent::actionDownload();
		$sql = "SELECT s.snrodid, a.description, s.curdd, s.curmm, s.curyy, s.curvalue, 
		s.curcc, s.curpt, s.curpp
FROM snrodet s
left join snro a on a.snroid = s.snroid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.snrodid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='SNRO Detail List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C','C','C','C','C'));
		$this->pdf->setwidths(array(40,20,20,20,20,20,20,20));
		$this->pdf->Row(array('SNRO','DD','MM','YY',
			'CC','PT','PP','Value'));
		$this->pdf->setaligns(array('L','L','L','L','L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['description'],$row1['curdd'],$row1['curmm']
		  ,$row1['curyy'],$row1['curcc'],$row1['curpt'],$row1['curpp'],$row1['curvalue']));
		}
		$this->pdf->Output();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Snrodet::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='snrodet-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
