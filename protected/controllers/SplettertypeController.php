<?php

class SplettertypeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname = 'splettertype';

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
		$model=new Splettertype;
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
			  'splettertypeid'=>$model->splettertypeid,
			  'splettername'=>$model->splettername,
			  'description'=>$model->description,
			  'validperiod'=>$model->validperiod,
			  'recordstatus'=>$model->recordstatus,
			  'div'=>$this->renderPartial('_form', array('model'=>$model), true)
			  ));
		  Yii::app()->end();
        }
	  }
	}

        public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Splettertype'], $_POST['Splettertype']['splettertypeid']);
    }

	public function actionWrite()
	{
		parent::actionWrite();
	  if(isset($_POST['Splettertype']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Splettertype']['splettername'],'hmsptemptysplettername','emptystring'),
                    array($_POST['Splettertype']['description'],'hmsptemptydescription','emptystring'),
                    array($_POST['Splettertype']['validperiod'],'hmsptemptyvalidperiod','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Splettertype'];
		if ((int)$_POST['Splettertype']['splettertypeid'] > 0)
		{
		  $model=$this->loadModel($_POST['Splettertype']['splettertypeid']);
		  $model->splettername = $_POST['Splettertype']['splettername'];
		  $model->description = $_POST['Splettertype']['description'];
		  $model->validperiod = $_POST['Splettertype']['validperiod'];
		  $model->recordstatus = $_POST['Splettertype']['recordstatus'];
		}
		else
		{
		  $model = new Splettertype();
		  $model->attributes=$_POST['Splettertype'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Splettertype']['splettertypeid']);
              $this->GetSMessage('hrmbtinsertsuccess');
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
	  $model=new Splettertype('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Splettertype']))
		  $model->attributes=$_GET['Splettertype'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		  'model'=>$model,
	  ));
	}

	public function actionUpload()
	{
      parent::actionUpload();
	  Yii::import("ext.EAjaxUpload.qqFileUploader");
	  $folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';// folder for uploaded files
	  $allowedExtensions = array("csv");
	  $sizeLimit = (int)Yii::app()->params['sizeLimit'];// maximum file size in bytes
	  $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
	  $result = $uploader->handleUpload($folder,true);
	  $row = 0;
	  if (($handle = fopen($folder.$uploader->file->getName(), "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if ($row>0) {
			  $model=Splettertype::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Splettertype();
			  }
			  $model->splettertypeid = (int)$data[0];
			  $model->splettertypename = $data[1];
			  $model->recordstatus = (int)$data[2];
			  try
			  {
				if(!$model->save())
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
			$row++;
		  }
		  fclose($handle);
	  }
	  $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	  echo $result;
  }

	public function actionDownload()
	{
		parent::actionDownload();
	  $pdf = new PDF();
    $pdf->title='Employee Informal List';
    $pdf->AddPage('P');
    $sql1 = "select splettername, description, validperiod
      from splettertype a";
    $pdf->setFont('Arial','B',8);
    $connection=Yii::app()->db;
    $command1=$connection->createCommand($sql1);
    $dataReader1=$command1->queryAll();

    $pdf->text(10,40,'Course / Trainig / skill List');
    $pdf->SetY(45);
    $pdf->setaligns(array('C','C','C'));
    $pdf->setwidths(array(50,40,30));
    $pdf->Row(array('SP Letter Name','Description','Period'));
    $pdf->setaligns(array('L','L','L'));
    foreach($dataReader1 as $row1)
    {
      $pdf->row(array($row1['splettername'],$row1['description'],$row1['validperiod']));
    }
	  // me-render ke browser
	  $pdf->Output('splettertype.pdf','D');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Splettertype::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Splettertype-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
