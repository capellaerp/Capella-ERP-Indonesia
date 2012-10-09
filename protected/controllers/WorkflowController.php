<?php

class WorkflowController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'workflow';

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
      $model=new Workflow;
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
              'workflowid'=>$model->workflowid,
              'wfname'=>$model->wfname,
              'wfdesc'=>$model->wfdesc,
              'wfminstat'=>$model->wfminstat,
              'wfmaxstat'=>$model->wfmaxstat,
              'recordstatus'=>$model->recordstatus,
              'div'=>$this->renderPartial('_form', array('model'=>$model), true)
              ));
          Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Workflow'], $_POST['Workflow']['workflowid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Workflow']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Workflow']['wfname'],'emptywfname','emptystring'),
            array($_POST['Workflow']['wfdesc'],'emptywfdesc','emptystring'),
            array($_POST['Workflow']['wfminstat'],'emptywfminstat','emptystring'),
            array($_POST['Workflow']['wfmaxstat'],'emptywfmaxstat','emptystring'),
            )
        );
        if ($messages == '') {
          //$_POST['Workflow']=$_POST['Workflow'];
          if ((int)$_POST['Workflow']['workflowid'] > 0)
          {
            $model=$this->loadModel($_POST['Workflow']['workflowid']);
            $model->wfname = $_POST['Workflow']['wfname'];
            $model->wfdesc = $_POST['Workflow']['wfdesc'];
            $model->wfminstat = $_POST['Workflow']['wfminstat'];
            $model->wfmaxstat = $_POST['Workflow']['wfmaxstat'];
            $model->recordstatus = $_POST['Workflow']['recordstatus'];
          }
          else
          {
            $model = new Workflow();
            $model->attributes=$_POST['Workflow'];
          }
          try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Workflow']['workflowid']);
              $this->GetSMessage('swfinsertsuccess');
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
    $model=new Workflow('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Workflow']))
			$model->attributes=$_GET['Workflow'];
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
						$model=Workflow::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Workflow();
						}
						$model->workflowid = (int)$data[0];
						$model->wfname = $data[1];
						$model->wfdesc = $data[2];
						$model->wfminstat = $data[3];
						$model->wfmaxstat = $data[4];
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
		$sql = "select a.wfname, a.wfdesc, a.wfminstat, a.wfmaxstat
				from workflow a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.workflowid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Workflow List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C'));
		$this->pdf->setwidths(array(40,40,40,40));
		$this->pdf->Row(array('Workflow','Description','Min Stat','Max Stat'));
		$this->pdf->setaligns(array('L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['wfname'],$row1['wfdesc']));
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
		$model=Workflow::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='workflow-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
