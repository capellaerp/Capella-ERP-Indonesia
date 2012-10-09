<?php

class WfgroupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
 protected $menuname = 'wfgroup';

	public $workflow,$groupaccess;
  
	public function lookupdata()
	{
	  $this->workflow=new Workflow('searchwstatus');
	  $this->workflow->unsetAttributes();  // clear any default values
	  if(isset($_GET['Workflow']))
		$this->workflow->attributes=$_GET['Workflow'];

          $this->groupaccess=new Groupaccess('searchwstatus');
	  $this->groupaccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Groupaccess']))
		$this->groupaccess->attributes=$_GET['Groupaccess'];
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
	  $model=new Wfgroup;
	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				'workflow'=>$this->workflow,
				'groupaccess'=>$this->groupaccess), true)
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
			  'wfgroupid'=>$model->wfgroupid,
              'groupaccessid'=>$model->groupaccessid,
			  'groupname'=>($model->groupaccess!==null)?$model->groupaccess->groupname:"",
			  'workflowid'=>$model->workflowid,
			  'wfdesc'=>$model->workflow->wfdesc,
              'wfbefstat'=>$model->wfbefstat,
              'wfrecstat'=>$model->wfrecstat,
			  'recordstatus'=>$model->recordstatus,
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
				'workflow'=>$this->workflow,
				'groupaccess'=>$this->groupaccess), true)
			  ));
		  Yii::app()->end();
        }
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Wfgroup'], $_POST['Wfgroup']['wfgroupid']);
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

	public function actionWrite()
	{
	  if(isset($_POST['Wfgroup']))
	  {
		$messages = $this->ValidateData(
                array(array($_POST['Wfgroup']['workflowid'],'emptywfname','emptystring'),
            array($_POST['Wfgroup']['groupaccessid'],'emptygroupname','emptystring'),
            array($_POST['Wfgroup']['wfbefstat'],'emptywfbefstat','emptystring'),
            array($_POST['Wfgroup']['wfrecstat'],'emptywfrecstat','emptystring'),
            )
        );
        if ($messages == '') {
          if ((int)$_POST['Wfgroup']['wfgroupid'] > 0)
          {
            $model=$this->loadModel($_POST['Wfgroup']['wfgroupid']);
            $model->workflowid = $_POST['Wfgroup']['workflowid'];
            $model->groupaccessid = $_POST['Wfgroup']['groupaccessid'];
            $model->wfbefstat = $_POST['Wfgroup']['wfbefstat'];
            $model->wfrecstat = $_POST['Wfgroup']['wfrecstat'];
            $model->recordstatus = $_POST['Wfgroup']['recordstatus'];
          }
          else
          {
            $model = new Wfgroup();
            $model->attributes=$_POST['Wfgroup'];
          }
          try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Wfgroup']['wfgroupid']);
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
	  parent::actionIndex();
	  $this->lookupdata();

	  $model=new Wfgroup('searchwstatus');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Wfgroup']))
		  $model->attributes=$_GET['Wfgroup'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		  'model'=>$model,
				'workflow'=>$this->workflow,
				'groupaccess'=>$this->groupaccess
	  ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Wfgroup::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='wfgroup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDownload()
	{
		parent::actionDownload();
		$sql = "select b.wfname, c.groupname, a.wfbefstat, a.wfrecstat
				from wfgroup a 
				left join workflow b on b.workflowid = a.workflowid
				left join groupaccess c on c.groupaccessid = a.groupaccessid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.wfgroupid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Workflow Group Authorization List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C'));
		$this->pdf->setwidths(array(40,40,40,40));
		$this->pdf->Row(array('Workflow','Group Access','Before Status','After Status'));
		$this->pdf->setaligns(array('L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['wfname'],$row1['groupname'],$row1['wfbefstat'],$row1['wfrecstat']));
		}
		$this->pdf->Output();
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
						$model=Wfgroup::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Wfgroup();
						}
						$model->wfgroupid = (int)$data[0];
						$workflow = Workflow::model()->findbyattributes(array('wfname'=>$data[1]));
						if ($workflow !== null)
						{
							$model->workflowid = $workflow->workflowid;
						}
						$groupaccess = Groupaccess::model()->findbyattributes(array('wfname'=>$data[2]));
						if ($groupaccess !== null)
						{
							$model->groupaccessid = $groupaccess->groupaccessid;
						}
						$model->wfbefstat = $data[3];
						$model->wfrecstat = $data[4];
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
}
