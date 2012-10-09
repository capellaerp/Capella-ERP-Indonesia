<?php

class OnleavetypeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'onleavetype';

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

    public $snro,$absstatus;

    public function lookupdata()
    {
      $this->snro=new Snro('searchwstatus');
	  $this->snro->unsetAttributes();  // clear any default values
	  if(isset($_GET['Snro']))
		$this->snro->attributes=$_GET['Snro'];

		$this->absstatus=new Absstatus('searchwstatus');
	  $this->absstatus->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absstatus']))
		$this->absstatus->attributes=$_GET['Absstatus'];
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
	  $this->lookupdata();
      $model=new Onleavetype;
      if (Yii::app()->request->isAjaxRequest)
      {
          echo CJSON::encode(array(
              'status'=>'success',
              'div'=>$this->renderPartial('_form', array('model'=>$model,
          'snro'=>$this->snro,
          'absstatus'=>$this->absstatus), true)
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
	  $this->lookupdata();
      $id=$_POST['id'];
	  $model=$this->loadModel($id[0]);

	  //$this->performAjaxValidation($model);

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'onleavetypeid'=>$model->onleavetypeid,
				'onleavename'=>$model->onleavename,
				'cutimax'=>$model->cutimax,
				'cutistart'=>$model->cutistart,
				'snroid'=>$model->snroid,
				'description'=>$model->snro->description,
				'absstatusid'=>$model->absstatusid,
				'shortstat'=>$model->absstatus->shortstat,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
          'snro'=>$this->snro,
          'absstatus'=>$this->absstatus), true)
				));
            Yii::app()->end();
        }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Onleavetype'], $_POST['Onleavetype']['onleavetypeid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Onleavetype']))
	  {
        $messages = $this->ValidateData(
                array(
                array($_POST['Onleavetype']['onleavename'],'emptyonleavename','emptystring'),
                array($_POST['Onleavetype']['cutimax'],'emptycutimax','emptystring'),
                array($_POST['Onleavetype']['cutistart'],'emptycustistart','emptystring'),
                array($_POST['Onleavetype']['snroid'],'emptysnro','emptystring'),
                array($_POST['Onleavetype']['absstatusid'],'emptyabstatus','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Onleavetype'];
		if ((int)$_POST['Onleavetype']['onleavetypeid'] > 0)
		{
		  $model=$this->loadModel($_POST['Onleavetype']['onleavetypeid']);
		  $model->onleavename = $_POST['Onleavetype']['onleavename'];
		  $model->snroid = $_POST['Onleavetype']['snroid'];
		  $model->absstatusid = $_POST['Onleavetype']['absstatusid'];
		  $model->cutimax = $_POST['Onleavetype']['cutimax'];
		  $model->cutistart = $_POST['Onleavetype']['cutistart'];
		  $model->recordstatus = $_POST['Onleavetype']['recordstatus'];
		}
		else
		{
		  $model = new Onleavetype();
		  $model->attributes=$_POST['Onleavetype'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname,$_POST['Onleavetype']['onleavetypeid']);
              $this->GetSMessage('hpaoltinsertsuccess');
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
	  $this->lookupdata();
    $model=new Onleavetype('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Onleavetype']))
			$model->attributes=$_GET['Onleavetype'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
          'snro'=>$this->snro,
          'absstatus'=>$this->absstatus
		));
	}

	public function actionUpload()
	{
      parent::actionUpload();
	  $folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';// folder for uploaded files
	  $allowedExtensions = array("csv");
	  $sizeLimit = (int)Yii::app()->params['sizeLimit'];// maximum file size in bytes
	  $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
	  $result = $uploader->handleUpload($folder,true);
	  $row = 0;
	  if (($handle = fopen($folder.$uploader->file->getName(), "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if ($row>0) {
			  $model=Onleavetype::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Onleavetype();
			  }
			  $model->onleavetypeid = (int)$data[0];
			  $model->onleavename = $data[1];
			  $model->cutimax = (int)$data[2];
			  $model->cutistart = (int)$data[3];
			  $model->snroid = (int)$data[4];
			  $model->absstatusid = (int)$data[5];
			  $model->recordstatus = (int)$data[6];
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
	  $pdf->title='Schedule Master List';
	  $pdf->AddPage('P');
	  $pdf->setFont('Arial','B',12);

	  // definisi font
	  $pdf->setFont('Arial','B',8);

	  // menuliskan tabel
	  $connection=Yii::app()->db;
    $sql = "select a.onleavename, a.cutimax,a.cutistart,b.formatdoc,c.shortstat
      from onleavetype a
      left join snro b on b.snroid = a.snroid
      left join absstatus c on c.absstatusid = a.absstatusid";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();

    $pdf->setaligns(array('C','C','C','C','C'));
    $pdf->setwidths(array(50,20,20,50,20));
    $pdf->Row(array('Onleave','Cuti Max','Cuti Start','Format Doc','Cuti Status'));
    $pdf->setaligns(array('L','L','L','L','L'));
    foreach($dataReader as $row1)
    {
      $pdf->row(array($row1['onleavename'],$row1['cutimax'],$row1['cutistart'],
          $row1['formatdoc'],$row1['shortstat']));
    }
    // me-render ke browser
    $pdf->Output('onleavetype.pdf','D');
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Onleavetype::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='onleavetype-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
