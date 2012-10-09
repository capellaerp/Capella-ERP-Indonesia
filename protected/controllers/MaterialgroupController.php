<?php

class MaterialgroupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'materialgroup';

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
	  $parentmatgroup=new Materialgroup('searchwstatus');
	  $parentmatgroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Parentmatgroup']))
		$parentmatgroup->attributes=$_GET['Parentmatgroup'];

      	  $materialtype=new Materialtype('searchwstatus');
	  $materialtype->unsetAttributes();  // clear any default values
	  if(isset($_GET['Materialtype']))
		$materialtype->attributes=$_GET['Materialtype'];

		$model=new Materialgroup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'parentmatgroup'=>$parentmatgroup,
                    'materialtype'=>$materialtype), true)
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
	   $parentmatgroup=new Materialgroup('searchwstatus');
	  $parentmatgroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Parentmatgroup']))
		$parentmatgroup->attributes=$_GET['Parentmatgroup'];

      $materialtype=new Materialtype('searchwstatus');
	  $materialtype->unsetAttributes();  // clear any default values
	  if(isset($_GET['Materialtype']))
		$materialtype->attributes=$_GET['Materialtype'];
		$id=$_POST['id'];
	  $model=$this->loadModel($id[0]);
if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'materialgroupid'=>$model->materialgroupid,
				'materialgroupcode'=>$model->materialgroupcode,
				'description'=>$model->description,
				'parentmatgroupid'=>$model->parentmatgroupid,
				'parentmatgroupcode'=>($model->parentmatgroup!==null)?$model->parentmatgroup->materialgroupcode:"",
				'materialtypeid'=>$model->materialtypeid,
				'materialtypename'=>($model->materialtype!==null)?$model->materialtype->description:"",
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
				  'parentmatgroup'=>$parentmatgroup,
                    'materialtype'=>$materialtype), true)
				));
            Yii::app()->end();
        }
        }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Materialgroup'], $_POST['Materialgroup']['materialgroupid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Materialgroup']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Materialgroup']['materialgroupcode'],'emptymaterialgroupcode','emptystring'),
                array($_POST['Materialgroup']['description'],'emptydescription','emptystring'),
                array($_POST['Materialgroup']['materialtypeid'],'emptymaterialtype','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Materialgroup'];
		if ((int)$_POST['Materialgroup']['materialgroupid'] > 0)
		{
		  $model=$this->loadModel($_POST['Materialgroup']['materialgroupid']);
		  $model->materialgroupcode = $_POST['Materialgroup']['materialgroupcode'];
		  $model->description = $_POST['Materialgroup']['description'];
		  $model->materialtypeid=$_POST['Materialgroup']['materialtypeid'];
		  $model->parentmatgroupid=$_POST['Materialgroup']['parentmatgroupid'];
		  $model->recordstatus = $_POST['Materialgroup']['recordstatus'];
		}
		else
		{
		  $model = new Materialgroup();
		  $model->attributes=$_POST['Materialgroup'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Materialgroup']['materialgroupid']);
              $this->GetSMessage('pmmginsertsuccess');
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
	   $parentmatgroup=new Materialgroup('searchwstatus');
	  $parentmatgroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Parentmatgroup']))
		$parentmatgroup->attributes=$_GET['Parentmatgroup'];
      $materialtype=new Materialtype('searchwstatus');
	  $materialtype->unsetAttributes();  // clear any default values
	  if(isset($_GET['Materialtype']))
		$materialtype->attributes=$_GET['Materialtype'];
		$model=new Materialgroup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Materialgroup']))
			$model->attributes=$_GET['Materialgroup'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
				  'parentmatgroup'=>$parentmatgroup,
            'materialtype'=>$materialtype
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
			  $model=Materialgroup::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Materialgroup();
			  }
			  $model->materialgroupid = (int)$data[0];
			  $model->materialgroupcode = $data[1];
			  $model->description = $data[2];
			  $model->parentmatgroupid = (int)$data[3];
			  $model->recordstatus = (int)$data[4];
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
    $pdf->title='Material Group List';
    $pdf->AddPage('P');
    $pdf->setFont('Arial','B',12);

    // definisi font
    $pdf->setFont('Arial','B',8);

    // menuliskan tabel
    $connection=Yii::app()->db;
    $sql = "select a.materialgroupcode, a.description,
      b.materialgroupcode as parentgroupcode,c.materialtypecode as materialtype
      from materialgroup a
      left join materialgroup b on b.materialgroupid = a.parentmatgroupid 
      left join materialtype c on c.materialtypeid = a.materialtypeid";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();

    $pdf->setaligns(array('C','C','C','C'));
    $pdf->setwidths(array(30,50,30,30));
    $pdf->Row(array('Code','Material Type','Description','Parent Group Code'));
    $pdf->setaligns(array('L','L','L','L'));
    foreach($dataReader as $row1)
    {
      $pdf->row(array($row1['materialgroupcode'],$row1['description'],
          $row1['materialtype'],$row1['parentgroupcode']));
    }
    // me-render ke browser
    $pdf->Output('materialgroup.pdf','D');
  }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Materialgroup::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='materialgroup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
