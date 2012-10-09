<?php

class CityController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'city';

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
	
	public $province;

	public function lookupdata()
	{
	  $this->province=new Province('searchwstatus');
	  $this->province->unsetAttributes();  // clear any default values
	  if(isset($_GET['Province']))
		$this->province->attributes=$_GET['Province'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
		$this->lookupdata();
		$model=new City;
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
					'province'=>$this->province), true)
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
				'cityid'=>$model->cityid,
				'provinceid'=>$model->provinceid,
				'provincename'=>($model->province!==null)?$model->province->provincename:"",
				'cityname'=>$model->cityname,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
					'province'=>$this->province), true)
				));
            Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['City'], $_POST['City']['cityid']);
    }

	public function actionWrite()
	{
		parent::actionWrite();
		if(isset($_POST['City']))
		{
			$messages = $this->ValidateData(
                array(
					array($_POST['City']['provinceid'],'emptyprovincename','emptystring'),
					array($_POST['City']['cityname'],'emptycityname','emptystring'),
				)
			);
			if ($messages == '') {
				//$dataku->attributes=$_POST['City'];
				if ((int)$_POST['City']['cityid'] > 0)
				{
					$model=$this->loadModel($_POST['City']['cityid']);
					$model->cityname = $_POST['City']['cityname'];
					$model->provinceid = $_POST['City']['provinceid'];
					$model->recordstatus = $_POST['City']['recordstatus'];
				}
				else
				{
					$model = new City();
					$model->attributes=$_POST['City'];
				}
				try
				{
					if($model->save())
					{
						$this->DeleteLock($this->menuname, $_POST['City']['cityid']);
						$this->GetSMessage('cciinsertsuccess');
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
	  $model=new City('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['City']))
			$model->attributes=$_GET['City'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
			'province'=>$this->province
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
						$model=City::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new City();
						}
						$model->cityid = (int)$data[0];
						$province = Province::model()->findbyattributes(array('provincename'=>$data[1]));
						if ($province !== null)
						{
							$model->provinceid = $province->provinceid;
						}
						$model->cityname = $data[2];
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
		$sql = "select a.cityid,b.provincename,a.cityname,a.recordstatus from city a
			left join province b on b.provinceid = a.provinceid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.cityid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='City List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C'));
		$this->pdf->setwidths(array(40,60,40,40));
		$this->pdf->Row(array('Province','City'));
		$this->pdf->setaligns(array('L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['provincename'],$row1['cityname']));
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
		$model=City::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='city-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
