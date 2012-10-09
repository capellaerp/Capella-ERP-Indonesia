<?php

class AbsruleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'absrule';

	public $absschedule,$absstatus;

	public function lookupdata()
	{
	  $this->absschedule=new Absschedule('searchwstatus');
	  $this->absschedule->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$this->absschedule->attributes=$_GET['Absschedule'];

	  $this->absstatus=new Absstatus('searchwstatus');
	  $this->absstatus->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absstatus']))
		$this->absstatus->attributes=$_GET['Absstatus'];
	}

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
	  $this->lookupdata();
	  $model=new Absrule;

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
	  'absschedule'=>$this->absschedule,
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
if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'absruleid'=>$model->absruleid,
			  'absscheduleid'=>$model->absscheduleid,
			  'absschedulename'=>($model->absschedule!==null)?$model->absschedule->absschedulename:"",
			  'difftimein'=>$model->difftimein,
			  'difftimeout'=>$model->difftimeout,
			  'absstatusid'=>($model->absstatus!==null)?$model->absstatus->absstatusid:"",
			  'shortstat'=>($model->absstatus!==null)?$model->absstatus->shortstat:"",
			  'recordstatus'=>$model->recordstatus,
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
		'absschedule'=>$this->absschedule,
		'absstatus'=>$this->absstatus), true)
			  ));
		  Yii::app()->end();
        }
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Absrule'], $_POST['Absrule']['absruleid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Absrule']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Absrule']['absscheduleid'],'emptyabsschedulename','emptystring'),
                array($_POST['Absrule']['difftimein'],'emptydifftimein','emptystring'),
                array($_POST['Absrule']['difftimeout'],'emptydifftimeout','emptystring'),
                array($_POST['Absrule']['absstatusid'],'emptyabsstatus','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Absrule'];
		if ((int)$_POST['Absrule']['absruleid'] > 0)
		{
		  $model=$this->loadModel($_POST['Absrule']['absruleid']);
		  $model->absscheduleid = $_POST['Absrule']['absscheduleid'];
		  $model->difftimein = $_POST['Absrule']['difftimein'];
		  $model->difftimeout = $_POST['Absrule']['difftimeout'];
		  $model->absstatusid = $_POST['Absrule']['absstatusid'];
		  $model->recordstatus = $_POST['Absrule']['recordstatus'];
		}
		else
		{
		  $model = new Absrule();
		  $model->attributes=$_POST['Absrule'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname,$_POST['Absrule']['absruleid']);
              $this->GetSMessage('hrtmarinsertsuccess');
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
	
	  $model=new Absrule('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absrule']))
			$model->attributes=$_GET['Absrule'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		'model'=>$model,
		'absschedule'=>$this->absschedule,
		'absstatus'=>$this->absstatus,
	  ));
	}

	public function actionUpload()
	{
	  parent::actionUpload();
	 $folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';// folder for uploaded files
		$file = $folder . basename($_FILES['uploadfile']['name']); 
		if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) 
		{ 
			$row = 0;
			if (($handle = fopen($file, "r")) !== FALSE) 
			{
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
				{
					if ($row>0) {
			  $model=Absrule::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Absrule();
			  }
			  $model->absruleid = (int)$data[0];
              $absschedule = Absschedule::model()->findbyattributes(array('absschedulename'=>$data[1]));
              if ($absschedule != null)
              {
                $model->absscheduleid = $absschedule->absscheduleid;
              }
			  $model->difftimein = $data[2];
			  $model->difftimeout = $data[3];
              $absstatus = Absstatus::model()->findbyattributes(array('shortstat'=>$data[4]));
              if ($absstatus != null)
              {
                $model->absstatusid = $absstatus->absstatusid;
              }
			  $model->recordstatus = 1;
			 try
						{
							if(!$model->save())
							{
								$this->messages = $this->messages . Catalogsys::model()->getcatalog(' upload error at '.$data[0]);
							}
						}
						catch (Exception $e)
						{
							$this->messages = $this->messages .  $e->getMessage();
						}
					}
					$row++;
				}
			}
			else
			{
				$this->messages = $this->messages . ' memory or harddisk full';
			}
			fclose($handle);
		}
		else
		{
			$this->messages = $this->messages . ' check your directory permission';
		}
		if ($this->messages == '') {
			$this->messages = 'success';
		}		
		echo $this->messages;
  }

  public function actionDownload()
  {
    parent::actionDownload();
    $sql = "select b.absschedulename,a.difftimein,a.difftimeout,c.shortstat
      from absrule a
      left join absschedule b on b.absscheduleid = a.absscheduleid
      left join absstatus c on c.absstatusid = a.absstatusid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.absruleid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Absence Rule List';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    $this->pdf->setaligns(array('C','C','C','C'));
    $this->pdf->setwidths(array(30,30,30,30));
    $this->pdf->Row(array('Schedule','Time In','Time Out','Status'));
    $this->pdf->setaligns(array('C','C','C','C'));
    foreach($dataReader as $row1)
    {
      $this->pdf->row(array($row1['absschedulename'],$row1['difftimein'],
          $row1['difftimeout'],$row1['shortstat']));
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
		$model=Absrule::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='absrule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
