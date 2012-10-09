<?php

class UsergroupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname = 'usergroup';
	public $useraccess,$groupaccess;

	public function lookupdata()
	{
	  $this->useraccess=new Useraccess('searchwstatus');
	  $this->useraccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Useraccess']))
		$this->useraccess->attributes=$_GET['Useraccess'];

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
		$model=new Usergroup;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'div'=>$this->renderPartial('_form', array('model'=>$model,
		'useraccess'=>$this->useraccess,
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
      $id=$_POST['id'];
      $model=$this->loadModel($id[0]);
      if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'usergroupid'=>$model->usergroupid,
				'useraccessid'=>$model->useraccessid,
				'username'=>$model->useraccess->username,
				'groupaccessid'=>$model->groupaccessid,
				'groupname'=>$model->groupaccess->groupname,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
		'useraccess'=>$this->useraccess,
		'groupaccess'=>$this->groupaccess), true)
				));
            Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Usergroup'], $_POST['Usergroup']['usergroupid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Usergroup']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Usergroup']['useraccessid'],'sougemptyusername','emptystring'),
            array($_POST['Usergroup']['groupaccessid'],'sougemptygroupname','emptystring'),
            )
        );
        if ($messages == '') {
          //$_POST['Usergroup']=$_POST['Usergroup'];
          if ((int)$_POST['Usergroup']['usergroupid'] > 0)
          {
            $model=$this->loadModel($_POST['Usergroup']['usergroupid']);
            $model->useraccessid = $_POST['Usergroup']['useraccessid'];
            $model->groupaccessid = $_POST['Usergroup']['groupaccessid'];
            $model->recordstatus = $_POST['Usergroup']['recordstatus'];
          }
          else
          {
            $model = new Usergroup();
            $model->attributes=$_POST['Usergroup'];
          }
          try
            {
              if($model->save())
              {
              $this->DeleteLock($this->menuname, $_POST['Usergroup']['usergroupid']);
                $this->GetSMessage('souginsertsuccess');
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
            parent::actionDelete;
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
		$model=new Usergroup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usergroup']))
			$model->attributes=$_GET['Usergroup'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
		'useraccess'=>$this->useraccess,
		'groupaccess'=>$this->groupaccess
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
			  $model=Usergroup::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Usergroup();
			  }
			  $model->usergroupid = (int)$data[0];
			  $useraccess = Useraccess::model()->findbyattributes(array('username'=>$data[1]));
			  if ($useraccess !== null)
			  {
				$model->useraccessid = $useraccess->useraccessid;
			}
			$groupaccess = Groupaccess::model()->findbyattributes(array('groupname'=>$data[2]));
			if ($groupaccess !== null)
			{
				$model->groupaccessid = $groupaccess->groupaccessid;
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
		$sql = "SELECT u.usergroupid,a.username,b.groupname,u.recordstatus
FROM usergroup u
left join useraccess a on a.useraccessid = u.useraccessid
left join groupaccess b on b.groupaccessid = u.groupaccessid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where u.usergroupid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='User Group List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C'));
		$this->pdf->setwidths(array(40,40,40,40));
		$this->pdf->Row(array('User Name','Group Name'));
		$this->pdf->setaligns(array('L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['username'],$row1['groupname']));
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
		$model=Usergroup::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='usergroup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
