<?php

class MenuaccessController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'menuaccess';
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
	  $model=new Menuaccess;

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
				'menuaccessid'=>$model->menuaccessid,
				'menuname'=>$model->menuname,
				'menucode'=>$model->menucode,
				'menuurl'=>$model->menuurl,
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
      $this->DeleteLockCloseForm($this->menuname, $_POST['Menuaccess'], $_POST['Menuaccess']['menuaccessid']);
    }

    public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Menuaccess']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Menuaccess']['menucode'],'emptymenucode','emptystring'),
            array($_POST['Menuaccess']['menuname'],'emptymenuname','emptystring'),
            array($_POST['Menuaccess']['menuurl'],'emptymenuurl','emptystring'),
            )
        );
        if ($messages == '') {
          if ((int)$_POST['Menuaccess']['menuaccessid'] > 0)
          {
            $model=$this->loadModel($_POST['Menuaccess']['menuaccessid']);
            $model->menuname = $_POST['Menuaccess']['menuname'];
            $model->menucode = $_POST['Menuaccess']['menucode'];
            $model->menuurl = $_POST['Menuaccess']['menuurl'];
            $model->description = $_POST['Menuaccess']['description'];
            $model->recordstatus = $_POST['Menuaccess']['recordstatus'];
          }
          else
          {
            $model = new Menuaccess();
            $model->attributes=$_POST['Menuaccess'];
          }
          try
            {
              if($model->save())
              {
                $this->DeleteLock($this->menuname, $_POST['Menuaccess']['menuaccessid']);
                $this->GetSMessage('sumansertsuccess');
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
		$model=new Menuaccess('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Menuaccess']))
			$model->attributes=$_GET['Menuaccess'];
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
						$model=Menuaccess::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Menuaccess();
						}
						$model->menuaccessid = (int)$data[0];
						$model->menucode = $data[1];
						$model->menuname = $data[2];
						$model->description = $data[3];
						$model->menuurl = $data[4];
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
		$sql = "select a.menuname, a.menucode, a.menuurl, a.description
				from menuaccess a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.menuaccessid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Country List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C'));
		$this->pdf->setwidths(array(40,40,40,60));
		$this->pdf->Row(array('Menu Name','Menu Code','Menu Url','Description'));
		$this->pdf->setaligns(array('L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['menuname'],$row1['menucode'],$row1['menuurl'],$row1['description']));
		}
		$this->pdf->Output();
	}

public function actionAutocomplete() {
	$res =array();

	if (isset($_GET['term'])) {
		$qtxt ="SELECT menucode FROM menuaccess WHERE menucode LIKE :menucode";
		$command =Yii::app()->db->createCommand($qtxt);
		$command->bindValue(":menucode", '%'.$_GET['term'].'%', PDO::PARAM_STR);
		$res =$command->queryColumn();
	}

	echo CJSON::encode($res);
	Yii::app()->end();
}

public function actionMenuCodeClick() {
	if (isset($_POST['menucode'])) {
		$qtxt ="SELECT menuurl FROM menuaccess WHERE menucode LIKE :menucode";
		$command =Yii::app()->db->createCommand($qtxt);
		$command->bindValue(":menucode", '%'.$_POST['menucode'].'%', PDO::PARAM_STR);
		$res =$command->queryColumn();
		$this->redirect(array($res[0].'/index'));
	}
}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Menuaccess::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='menuaccess-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
