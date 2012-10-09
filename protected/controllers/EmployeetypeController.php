<?php

class EmployeetypeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'employeetype';

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

	public $snro,$sicksnro,$sickstatus;

	public function lookupdata()
	{
	  $this->snro=new Snro('searchwstatus');
	  $this->snro->unsetAttributes();  // clear any default values
	  if(isset($_GET['Snro']))
		$this->snro->attributes=$_GET['Snro'];

	  $this->sicksnro=new Snro('searchwstatus');
	  $this->sicksnro->unsetAttributes();  // clear any default values
	  if(isset($_GET['Snro']))
		$this->sicksnro->attributes=$_GET['Snro'];

	  $this->sickstatus=new Absstatus('searchwstatus');
	  $this->sickstatus->unsetAttributes();  // clear any default values
	  if(isset($_GET['Sickstatus']))
		$this->sickstatus->attributes=$_GET['Sickstatus'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
	  $this->lookupdata();
	  $model=new Employeetype;
	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
	'snro'=>$this->snro,
	'sicksnro'=>$this->sicksnro,
	'sickstatus'=>$this->sickstatus), true)
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
			'employeetypeid'=>$model->employeetypeid,
			'employeetypename'=>$model->employeetypename,
			'snroid'=>$model->snroid,
			'snroname'=>$model->snro->description,
			'sicksnroid'=>$model->sicksnroid,
			'sicksnroname'=>$model->sicksnro->description,
			'sickstatusid'=>$model->sickstatusid,
			'sickstatusname'=>$model->sickstatus->shortstat,
			'recordstatus'=>$model->recordstatus,
			'div'=>$this->renderPartial('_form', array('model'=>$model,
				'snro'=>$this->snro,
				'sicksnro'=>$this->sicksnro,
				'sickstatus'=>$this->sickstatus), true)
			));
		Yii::app()->end();
        }
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Employeetype'],
              $_POST['Employeetype']['employeetypeid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Employeetype']))
	  {
        $messages = $this->ValidateData(
                array(
				array($_POST['Employeetype']['employeetypename'],'emptyemployeetypename','emptystring'),
				array($_POST['Employeetype']['snroid'],'emptysnroid','emptystring'),
				array($_POST['Employeetype']['sicksnroid'],'emptysnroid','emptystring'),
				array($_POST['Employeetype']['sickstatusid'],'emptysickstatusid','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Employeetype'];
		if ((int)$_POST['Employeetype']['employeetypeid'] > 0)
		{
		  $model=$this->loadModel($_POST['Employeetype']['employeetypeid']);
		  $model->employeetypename = $_POST['Employeetype']['employeetypename'];
		  $model->snroid = $_POST['Employeetype']['snroid'];
		  $model->sicksnroid = $_POST['Employeetype']['sicksnroid'];
		  $model->sickstatusid = $_POST['Employeetype']['sickstatusid'];
		  $model->recordstatus = $_POST['Employeetype']['recordstatus'];
		}
		else
		{
		  $model = new Employeetype();
		  $model->attributes=$_POST['Employeetype'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Employeetype']['employeetypeid']);
              $this->GetSMessage('hrmetinsertsuccess');
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
    $model=new Employeetype('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employeetype']))
			$model->attributes=$_GET['Employeetype'];

		$this->render('index',array(
			'model'=>$model,
      'snro'=>$this->snro,
      'sicksnro'=>$this->sicksnro,
      'sickstatus'=>$this->sickstatus
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
			  $model=Employeetype::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Employeetype();
			  }
			  $model->employeetypeid = (int)$data[0];
			  $model->employeetypename = $data[1];
              $snro = Snro::model()->findbyattributes(array('description'=>$data[2]));
              if ($snro != null)
              {
                $model->snroid = $snro->snroid;
              }
              $snro = Snro::model()->findbyattributes(array('description'=>$data[3]));
              if ($snro != null)
              {
                $model->sicksnroid = $snro->snroid;
              }
              $snro = Absstatus::model()->findbyattributes(array('shortstat'=>$data[4]));
              if ($snro != null)
              {
                $model->sickstatusid = $snro->absstatusid;
              }
			  $model->recordstatus = (int)$data[5];
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
    $sql = "select a.employeetypename, b.formatdoc, c.formatdoc as sicksnro, d.shortstat 
      from employeetype a
      left join snro b on b.snroid = a.snroid
      left join snro c on c.snroid = a.sicksnroid
      left join absstatus d on d.absstatusid = a.sickstatusid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.employeetypeid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Employee Type List';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    $this->pdf->setaligns(array('C','C','C','C'));
    $this->pdf->setwidths(array(50,40,40,40));
    $this->pdf->Row(array('Employee Type','Employee Format','Sick Format','Short Status'));
    $this->pdf->setaligns(array('L','L','L','C'));
    foreach($dataReader as $row1)
    {
      $this->pdf->row(array($row1['employeetypename'],$row1['formatdoc'],$row1['sicksnro'],
          $row1['shortstat']));
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
		$model=Employeetype::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='employeetype-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
