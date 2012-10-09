<?php

class ProvinceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'province';

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
	
	public $country;

	public function lookupdata()
	{
	  $this->country=new Country('searchwstatus');
	  $this->country->unsetAttributes();  // clear any default values
	  if(isset($_GET['Country']))
		$this->country->attributes=$_GET['Country'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
		$this->lookupdata();
		$model=new Province;
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
					'country'=>$this->country), true)
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
				'provinceid'=>$model->provinceid,
				'countryid'=>$model->countryid,
				'countryname'=>($model->country!==null)?$model->country->countryname:"",
				'provincename'=>$model->provincename,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
					'country'=>$this->country), true)
				));
            Yii::app()->end();
        }
      }
	}

       public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Province'], $_POST['Province']['provinceid']);
    }


	public function actionWrite()
	{
      parent::actionWrite();
	  if(isset($_POST['Province']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Province']['countryid'],'emptycountrycode','emptystring'),
                array($_POST['Province']['provincename'],'emptyprovincename','emptystring'),
            )
        );
        if ($messages == '') {
          //$dataku->attributes=$_POST['Province'];
          if ((int)$_POST['Province']['provinceid'] > 0)
          {
            $model=$this->loadModel($_POST['Province']['provinceid']);
            $model->provincename = $_POST['Province']['provincename'];
            $model->countryid = $_POST['Province']['countryid'];
            $model->recordstatus = $_POST['Province']['recordstatus'];
          }
          else
          {
            $model = new Province();
            $model->attributes=$_POST['Province'];
          }
          try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Province']['provinceid']);
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
	  $model=new Province('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Province']))
			$model->attributes=$_GET['Province'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
			'country'=>$this->country
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
						$model=Province::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Province();
						}
						$model->provinceid = (int)$data[0];
						$country = Country::model()->findbyattributes(array('countryname'=>$data[1]));
						if ($country !== null)
						{
							$model->countryid = $country->countryid;
						}
						$model->provincename = $data[2];
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
		$sql = "select b.countryname, a.provincename
				from province a 
				left join country b on b.countryid = a.countryid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.provinceid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Province List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C'));
		$this->pdf->setwidths(array(40,40,40,40));
		$this->pdf->Row(array('Country','Province'));
		$this->pdf->setaligns(array('L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['countryname'],$row1['provincename']));
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
		$model=Province::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='province-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
