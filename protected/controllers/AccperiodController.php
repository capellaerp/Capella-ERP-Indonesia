<?php

class AccperiodController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname = 'accperiod';

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
	  $model=new Accperiod;

	  if (Yii::app()->request->isAjaxRequest)
	  {
		echo CJSON::encode(array(
			'status'=>'success',
			'div'=>$this->renderPartial('_form', array('model'=>$model), true)
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
              'accperiodid'=>$model->accperiodid,
              'period'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->period)),
              'recordstatus'=>$model->recordstatus,
              'div'=>$this->renderPartial('_form', array('model'=>$model), true)
              ));
          Yii::app()->end();
        }
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Accperiod'], $_POST['Accperiod']['accperiodid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Accperiod']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Accperiod']['period'],'aapemptyperiod','emptystring'),
            )
        );
        if ($messages == '') 
        {
          //$dataku->attributes=$_POST['Accperiod'];
          if ((int)$_POST['Accperiod']['accperiodid'] > 0)
          {
            $model=$this->loadModel($_POST['Accperiod']['accperiodid']);
            $model->period = $_POST['Accperiod']['period'];
            $model->recordstatus = $_POST['Accperiod']['recordstatus'];
          }
          else
          {
            $model = new Accperiod();
            $model->attributes=$_POST['Accperiod'];
          }
          try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname,$_POST['Accperiod']['accperiodid']);
              $this->GetSMessage('aapinsertsuccess');
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
		$model->recordstatus=0;
		$model->save();
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
	  $model=new Accperiod('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Accperiod']))
		  $model->attributes=$_GET['Accperiod'];
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
	  $sql = "select period
				from accperiod a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.accperiodid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		$this->pdf->title='Account Period List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C'));
		$this->pdf->setwidths(array(90));
		$this->pdf->Row(array('Account Period'));
		$this->pdf->setaligns(array('L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['period']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Accperiod::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='accperiod-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
