<?php

class AddressbookController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'addressbook';

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
	  $model=new Addressbook;
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
			'addressbookid'=>$model->addressbookid,
			'fullname'=>$model->fullname,
			'iscustomer'=>$model->iscustomer,
			'isemployee'=>$model->isemployee,
			'isapplicant'=>$model->isapplicant,
			'isvendor'=>$model->isvendor,
			'isinsurance'=>$model->isinsurance,
			'isbank'=>$model->isbank,
			'ishospital'=>$model->ishospital,
			'iscatering'=>$model->iscatering,
			'isstudent'=>$model->isstudent,
			'recordstatus'=>$model->recordstatus,
            'taxno'=>$model->taxno,
            'abno'=>$model->abno,
            'accpiutangid'=>$model->accpiutangid,
            'acchutangid'=>$model->acchutangid,
			'div'=>$this->renderPartial('_form', array('model'=>$model), true)
			));
		Yii::app()->end();
        }
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Addressbook'], $_POST['Addressbook']['addressbookid']);
    }


	public function actionWrite()
	{
	  if(isset($_POST['Addressbook']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Addressbook']['fullname'],'emptyfullname','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Addressbook'];
		if ((int)$_POST['Addressbook']['addressbookid'] > 0)
		{
		  $model=$this->loadModel($_POST['Addressbook']['addressbookid']);
		  $model->fullname = $_POST['Addressbook']['fullname'];
		  $model->iscustomer = $_POST['Addressbook']['iscustomer'];
		  $model->isemployee = $_POST['Addressbook']['isemployee'];
		  $model->isapplicant = $_POST['Addressbook']['isapplicant'];
		  $model->isvendor = $_POST['Addressbook']['isvendor'];
		  $model->isinsurance = $_POST['Addressbook']['isinsurance'];
		  $model->isbank = $_POST['Addressbook']['isbank'];
		  $model->ishospital = $_POST['Addressbook']['ishospital'];
		  $model->iscatering = $_POST['Addressbook']['iscatering'];
		  $model->isstudent = $_POST['Addressbook']['isstudent'];
		  $model->recordstatus = $_POST['Addressbook']['recordstatus'];
		}
		else
		{
		  $model = new Addressbook();
		  $model->attributes=$_POST['Addressbook'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Addressbook']['addressbookid']);
              $this->GetSMessage('coabinsertsuccess');
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
	  $model=new Addressbook('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Addressbook']))
			$model->attributes=$_GET['Addressbook'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		'model'=>$model
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
				$model = new Addressbook();
			  }
			  $model->fullname = $data[1];
			  $model->iscustomer = (int)$data[2];
			  $model->isemployee = (int)$data[3];
			  $model->isapplicant = (int)$data[4];
			  $model->isvendor = (int)$data[5];
			  $model->isinsurance = (int)$data[6];
			  $model->isbank = (int)$data[7];
			  $model->ishospital = (int)$data[8];
			  $model->iscatering = (int)$data[9];
			  $model->recordstatus = (int)$data[10];
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
		$sql = "select a.fullname,a.iscustomer,a.isemployee,a.isapplicant,a.isvendor,a.isinsurance,
				a.isbank, a.ishospital,a.iscatering,a.taxno,a.abno
				from addressbook a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.countryid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Address Book List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C','C','C','C','C','C','C','C'));
		$this->pdf->setwidths(array(30,20,20,20,15,15,20,10,15,15,15));
		$this->pdf->Row(array('Name','No','Customer','Employee','Applicant','Vendor','Insurance','Bank','Hospital','Catering','Tax No'));
		$this->pdf->setaligns(array('L','L','C','C','C','C','C','C','C','C','C'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['fullname'],$row1['abno'],
		  ($row1['iscustomer']!==1)?'V':'',
		  ($row1['isemployee']!==1)?'V':'',
		  ($row1['isapplicant']!==1)?'V':'',
		  ($row1['isvendor']!==1)?'V':'',
		  ($row1['isinsurance']!==1)?'V':'',
		  ($row1['isbank']!==1)?'V':'',
		  ($row1['ishospital']!==1)?'V':'',
		  ($row1['iscatering']!==1)?'V':'',
		  $row1['taxno'],
		  ));
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
		$model=Addressbook::model()->findByPk((int)$id);
		//if($model===null)
		//	throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='addressbook-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
