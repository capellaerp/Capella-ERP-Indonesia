<?php

class UseraccessController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname='useraccess';

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
      $model=new Useraccess;

      // Uncomment the following line if AJAX validation is needed
      // $this->performAjaxValidation($model);

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
              'useraccessid'=>$model->useraccessid,
              'username'=>$model->username,
              'password'=>$model->password,
              'realname'=>$model->realname,
              'email'=>$model->email,
			  'phoneno'=>$model->phoneno,
			  'languageid'=>$model->languageid,
			  'languagename'=>($model->language!==null)?$model->language->languagename:"",
              'recordstatus'=>$model->recordstatus,
              'div'=>$this->renderPartial('_form', array('model'=>$model), true)
              ));
          Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Useraccess'], $_POST['Useraccess']['useraccessid']);
    }

	public function actionWrite()
	{
      parent::actionWrite();
	  if(isset($_POST['Useraccess']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Useraccess']['realname'],'suaemptyrealname','emptystring'),
            array($_POST['Useraccess']['username'],'suaemptyusername','emptystring'),
            array($_POST['Useraccess']['email'],'suaemptyemailname','emptystring'),
            )
        );
        if ($messages == '') {
          $oldpass=$_POST['passhide'];
          if ((int)$_POST['Useraccess']['useraccessid'] > 0)
          {
            $model=$this->loadModel($_POST['Useraccess']['useraccessid']);
            $model->username = $_POST['Useraccess']['username'];
            $model->realname = $_POST['Useraccess']['realname'];
            $model->password = $model->hashPassword($_POST['Useraccess']['password'],$model->salt);
            if ($model->password == $oldpass)
            {
              $model->password = $oldpass;
            }
            $model->email = $_POST['Useraccess']['email'];
            $model->phoneno = $_POST['Useraccess']['phoneno'];
            $model->languageid = $_POST['Useraccess']['languageid'];
            $model->recordstatus = $_POST['Useraccess']['recordstatus'];
          }
          else
          {
            $model = new Useraccess();
            $model->attributes=$_POST['Useraccess'];
            $model->salt = $model->generateSalt();
            $model->password=$model->hashPassword($model->password,$model->salt);
          }
          try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Useraccess']['useraccessid']);
              $this->GetSMessage('suainsertsuccess');
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
    $model=new Useraccess('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Useraccess']))
			$model->attributes=$_GET['Useraccess'];
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
						$model=$this->loadModel((int)$data[0]);
						if ($model=== null) {
							$model = new Useraccess();
						}
						$model->useraccessid = $data[0];
						$model->username = $data[1];
						$model->realname = $data[2];
						$model->email = $data[3];
						$model->phoneno = $data[4];
						$model->salt = $model->generatesalt();
						$model->password = $model->hashpassword('demo',$model->salt);
						$language = Language::model()->findbyattributes(array('languagename'=>$data[5]));
						if ($language !== null)
						{
							$model->languageid = $language->languageid;
						}
						$model->recordstatus = (int)$data[6];
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
		$sql = "select a.username, a.realname, a.password, a.salt, a.email, a.phoneno, b.languagename
				from useraccess a 
				left join language b on b.languageid = a.languageid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.useraccessid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='User Access List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C','C'));
		$this->pdf->setwidths(array(40,40,40,30,30));
		$this->pdf->Row(array('User Name','Real Name','Email','Phone No','Language'));
		$this->pdf->setaligns(array('L','L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['username'],$row1['realname'],$row1['email'],$row1['phoneno'],$row1['languagename']));
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
		$model=Useraccess::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='useraccess-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
