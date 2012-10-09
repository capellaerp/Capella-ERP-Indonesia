<?php

class OrgstructureController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'orgstructure';

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
	  $parent=new Orgstructure('searchwstatus');
	  $parent->unsetAttributes();  // clear any default values
	  if(isset($_GET['Orgstructure']))
		$parent->attributes=$_GET['Orgstructure'];
		$model=new Orgstructure;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'parent'=>$parent), true)
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
	  $parent=new Orgstructure('searchwstatus');
	  $parent->unsetAttributes();  // clear any default values
	  if(isset($_GET['Orgstructure']))
		$parent->attributes=$_GET['Orgstructure'];
		$id=$_POST['id'];
	  $model=$this->loadModel($id[0]);
if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'orgstructureid'=>$model->orgstructureid,
				'structurename'=>$model->structurename,
				'parentid'=>$model->parentid,
				'parentstructurename'=>($model->parent!==null)?$model->parent->structurename:"",
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
				  'parent'=>$parent), true)
				));
            Yii::app()->end();
        }
        }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Orgstructure'], $_POST['Orgstructure']['orgstructureid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Orgstructure']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Orgstructure']['structurename'],'emptystructurename','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Orgstructure'];
		if ((int)$_POST['Orgstructure']['orgstructureid'] > 0)
		{
		  $model=$this->loadModel($_POST['Orgstructure']['orgstructureid']);
		  $model->structurename = $_POST['Orgstructure']['structurename'];
		  $model->parentid = $_POST['Orgstructure']['parentid'];
		  $model->recordstatus = $_POST['Orgstructure']['recordstatus'];
		}
		else
		{
		  $model = new Orgstructure();
		  $model->attributes=$_POST['Orgstructure'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Orgstructure']['orgstructureid']);
              $this->GetSMessage('hoosinsertsuccess');
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
	  $parent=new Orgstructure('searchwstatus');
	  $parent->unsetAttributes();  // clear any default values
	  if(isset($_GET['Orgstructure']))
		$parent->attributes=$_GET['Orgstructure'];
		$model=new Orgstructure('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Orgstructure']))
			$model->attributes=$_GET['Orgstructure'];
		if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
				  'parent'=>$parent
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
			  $model=Orgstructure::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Orgstructure();
			  }
			  $model->orgstructureid = (int)$data[0];
			  $model->structurename = $data[1];
			  $model->parentid = $data[2];
			  $model->recordstatus = (int)$data[3];
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
    $sql = "select a.structurename,b.structurename as superior
      from orgstructure a 
      left join orgstructure b on b.orgstructureid = a.parentid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.orgstructureid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Organization Structure List';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    $this->pdf->setaligns(array('C','C'));
    $this->pdf->setwidths(array(90,90));
    $this->pdf->Row(array('Structure','Superior'));
    $this->pdf->setaligns(array('L','L'));
    foreach($dataReader as $row1)
    {
      $this->pdf->row(array($row1['structurename'],$row1['superior']));
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
		$model=Orgstructure::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='orgstructure-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
