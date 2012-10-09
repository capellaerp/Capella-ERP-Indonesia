<?php

class UnitofmeasureController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'unitofmeasure';

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
		$model=new Unitofmeasure;

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
				'unitofmeasureid'=>$model->unitofmeasureid,
				'uomcode'=>$model->uomcode,
				'description'=>$model->description,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)
				));
            Yii::app()->end();
        }
        }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Unitofmeasure'],
              $_POST['Unitofmeasure']['unitofmeasureid']);
    }

	public function actionWrite()
	{
      parent::actionWrite();
	  if(isset($_POST['Unitofmeasure']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Unitofmeasure']['uomcode'],'emptyuomcode','emptystring'),
                array($_POST['Unitofmeasure']['description'],'emptydescription','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Unitofmeasure']['unitofmeasureid'] > 0)
		{
		  $model=$this->loadModel($_POST['Unitofmeasure']['unitofmeasureid']);
		  $model->uomcode = $_POST['Unitofmeasure']['uomcode'];
		  $model->description = $_POST['Unitofmeasure']['description'];
		  $model->recordstatus = $_POST['Unitofmeasure']['recordstatus'];
		}
		else
		{
		  $model = new Unitofmeasure();
		  $model->attributes=$_POST['Unitofmeasure'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Unitofmeasure']['unitofmeasureid']);
              $this->GetSMessage('iuminsertsuccess');
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
		$model=new Unitofmeasure('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
			$model->attributes=$_GET['Unitofmeasure'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		'model'=>$model
	  ));
	}

	public function actionDownload()
  {
            parent::actionDownload();
      $pdf = new PDF();
	  $pdf->title='Unit of Measure List';
	  $pdf->AddPage('P');
	  $pdf->setFont('Arial','B',12);

	  // definisi font
	  $pdf->setFont('Arial','B',8);

	  // menuliskan tabel
	  $connection=Yii::app()->db;
    $sql = "select a.uomcode,a.description
      from unitofmeasure a";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();

    $pdf->setaligns(array('C','C','C','C'));
    $pdf->setwidths(array(50,90));
    $pdf->Row(array('Unit of Measure','Description'));
    $pdf->setaligns(array('L','L'));
    foreach($dataReader as $row1)
    {
      $pdf->row(array($row1['uomcode'],$row1['description']));
    }
    // me-render ke browser
    $pdf->Output('unitofmeasure.pdf','D');
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
			  $model=Absrule::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Absrule();
			  }
			  $model->absruleid = (int)$data[0];
			  $model->absscheduleid = (int)$data[1];
			  $model->difftimein = $data[2];
			  $model->difftimeout = $data[3];
			  $model->absstatusid = (int)$data[4];
			  $model->recordstatus = 1;
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Unitofmeasure::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='unitofmeasure-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
