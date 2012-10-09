<?php

class HospitalController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'hospital';

public function actionHelp()
	{
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $this->txt = '_help'; break;
				case 2 : $this->txt = '_helpmodif'; break;
				case 3 : $this->txt = '_helpaddress'; break;
				case 4 : $this->txt = '_helpaddressmodif'; break;
				case 5 : $this->txt = '_helpcontact'; break;
				case 6 : $this->txt = '_helpcontactmodif'; break;
			}
		}
		parent::actionHelp();
	}

	public $hospitaladdress,$hospitalcontact,$accpiutang;

		public function lookupdata()
	{
		$this->hospitaladdress=new Hospitaladdress('search');
	  $this->hospitaladdress->unsetAttributes();  // clear any default values
	  if(isset($_GET['Hospitaladdress']))
		$this->hospitaladdress->attributes=$_GET['Hospitaladdress'];

		$this->hospitalcontact=new Hospitalcontact('search');
	  $this->hospitalcontact->unsetAttributes();  // clear any default values
	  if(isset($_GET['Hospitalcontact']))
		$this->hospitalcontact->attributes=$_GET['Hospitalcontact'];

      $this->accpiutang=new Account('search');
	  $this->accpiutang->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$this->accpiutang->attributes=$_GET['Account'];

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
		$this->lookupdata();
		$model=new Hospital;
		$model->fullname='hospitalname';
		$model->ishospital=1;
		$model->recordstatus=0;
		if (Yii::app()->request->isAjaxRequest)
        {
        if ($model->save()) {
            echo CJSON::encode(array(
                'status'=>'success',
                'addressbookid'=>$model->addressbookid,
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
                'hospitaladdress'=>$this->hospitaladdress,
                'hospitalcontact'=>$this->hospitalcontact,
                    'accpiutang'=>$this->accpiutang), true)
				));
            Yii::app()->end();
        }
        }
	}

	public function actionCreateaddress()
	{
		parent::actionCreate();
		$this->lookupdata();

		$hospitaladdress=new Hospitaladdress;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formaddress',
				  array('model'=>$hospitaladdress), true)
				));
            Yii::app()->end();
        }
	}

	public function actionCreatecontact()
	{
		parent::actionCreate();
		$this->lookupdata();

		$hospitalcontact=new Hospitalcontact;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formcontact',
				  array('model'=>$hospitalcontact), true)
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
		$this->lookupdata();
	  if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addressbookid'=>$model->addressbookid,
			  'fullname'=>$model->fullname,
			  'taxno'=>$model->taxno,
			  'accountid'=>$model->accpiutangid,
			  'accpiutangname'=>($model->accpiutang!==null)?$model->accpiutang->accountname:"",
			  'recordstatus'=>$model->recordstatus,
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
			  'hospitaladdress'=>$this->hospitaladdress,
			  'hospitalcontact'=>$this->hospitalcontact,
                    'accpiutang'=>$this->accpiutang), true)
			  ));
		  Yii::app()->end();
        }
	  }
	}

	public function actionUpdateaddress()
	{
	  $id=$_POST['id'];
	  $hospitaladdress=$this->loadModeladdress($id[0]);

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addressid'=>$hospitaladdress->addressid,
			'addressbookid'=>$hospitaladdress->addressbookid,
			'fullname'=>($hospitaladdress->addressbook!==null)?$hospitaladdress->addressbook->fullname:"",
			'addresstypeid'=>$hospitaladdress->addresstypeid,
			'addresstypename'=>($hospitaladdress->addresstype!==null)?$hospitaladdress->addresstype->addresstypename:"",
			'addressname'=>$hospitaladdress->addressname,
			'rt'=>$hospitaladdress->rt,
			'rw'=>$hospitaladdress->rw,
			'cityid'=>$hospitaladdress->cityid,
			'cityname'=>$hospitaladdress->city->cityname,
			'kelurahanid'=>$hospitaladdress->kelurahanid,
			'kelurahanname'=>($hospitaladdress->kelurahan!==null)?$hospitaladdress->kelurahan->kelurahanname:"",
			'subdistrictid'=>$hospitaladdress->subdistrictid,
			'subdistrictname'=>($hospitaladdress->subdistrict!==null)?$hospitaladdress->subdistrict->subdistrictname:"",
              'phoneno'=>$hospitaladdress->phoneno,
			  'div'=>$this->renderPartial('_formaddress', array('model'=>$hospitaladdress), true)
			  ));
		  Yii::app()->end();
	  }
	}

	public function actionUpdatecontact()
	{
	  $id=$_POST['id'];
	  $hospitalcontact=$this->loadModelcontact($id[0]);

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addresscontactid'=>$hospitalcontact->addresscontactid,
			'addressbookid'=>$hospitalcontact->addressbookid,
			'fullname'=>$hospitalcontact->addressbook->fullname,
			'contacttypeid'=>$hospitalcontact->contacttypeid,
			'contacttypename'=>$hospitalcontact->contacttype->contacttypename,
			'addresscontactname'=>$hospitalcontact->addresscontactname,
              'phoneno'=>$hospitalcontact->phoneno,
              'mobilephone'=>$hospitalcontact->mobilephone,
              'emailaddress'=>$hospitalcontact->emailaddress,
			  'div'=>$this->renderPartial('_formcontact', array('model'=>$hospitalcontact), true)
			  ));
		  Yii::app()->end();
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Hospital'], $_POST['Hospital']['addressbookid']);
    }

	public function actionWrite()
	{
		parent::actionWrite();
	  if(isset($_POST['Hospital']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Hospital']['fullname'],'emptyfullname','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Hospital']['addressbookid'] > 0)
		{
		  $model=$this->loadModel($_POST['Hospital']['addressbookid']);
		  $model->fullname = $_POST['Hospital']['fullname'];
		  $model->taxno = $_POST['Hospital']['taxno'];
		  $model->accpiutangid = $_POST['Hospital']['accpiutangid'];
		  $model->fullname = $_POST['Hospital']['fullname'];
		  $model->recordstatus = $_POST['Hospital']['recordstatus'];
		}
		else
		{
		  $model = new Hospital();
		  $model->ishospital = 1;
		  $model->attributes=$_POST['Hospital'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Hospital']['addressbookid']);
              $this->GetSMessage('mmsinsertsuccess');
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

	public function actionWriteaddress()
	{
		parent::actionWrite();
	  if(isset($_POST['Hospitaladdress']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Hospitaladdress']['addresstypeid'],'emptyaddresstypename','emptystring'),
                array($_POST['Hospitaladdress']['addressname'],'emptyaddressname','emptystring'),
                array($_POST['Hospitaladdress']['cityid'],'emptycityname','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Hospitaladdress']['addressid'] > 0)
		{
		  $model=Hospitaladdress::model()->findbyPK($_POST['Hospitaladdress']['addressid']);
		  $model->addressbookid = $_POST['Hospitaladdress']['addressbookid'];
		  $model->addresstypeid = $_POST['Hospitaladdress']['addresstypeid'];
		  $model->addressname = $_POST['Hospitaladdress']['addressname'];
		  $model->rt = $_POST['Hospitaladdress']['rt'];
		  $model->rw = $_POST['Hospitaladdress']['rw'];
		  $model->cityid = $_POST['Hospitaladdress']['cityid'];
		  $model->kelurahanid = $_POST['Hospitaladdress']['kelurahanid'];
		  $model->subdistrictid = $_POST['Hospitaladdress']['subdistrictid'];
		  $model->phoneno = $_POST['Hospitaladdress']['phoneno'];
		}
		else
		{
		  $model = new Hospitaladdress();
		  $model->attributes=$_POST['Hospitaladdress'];
		}
		try
          {
            if($model->save())
            {
              $this->GetSMessage('mmprinsertsuccess');
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

	public function actionWritecontact()
	{
		parent::actionWrite();
	  if(isset($_POST['Hospitalcontact']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Hospitalcontact']['contacttypeid'],'emptycontacttypename','emptystring'),
                array($_POST['Hospitalcontact']['addresscontactname'],'emptyaddresscontactname','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Hospitalcontact']['addresscontactid'] > 0)
		{
		  $model=Hospitalcontact::model()->findbyPK($_POST['Hospitalcontact']['addresscontactid']);
		  $model->addressbookid = $_POST['Hospitalcontact']['addressbookid'];
		  $model->contacttypeid = $_POST['Hospitalcontact']['contacttypeid'];
		  $model->addresscontactname = $_POST['Hospitalcontact']['addresscontactname'];
		  $model->phoneno = $_POST['Hospitalcontact']['phoneno'];
		  $model->mobilephone = $_POST['Hospitalcontact']['mobilephone'];
		  $model->emailaddress = $_POST['Hospitalcontact']['emailaddress'];
		}
		else
		{
		  $model = new Hospitalcontact();
		  $model->attributes=$_POST['Hospitalcontact'];
		}
		try
          {
            if($model->save())
            {
              $this->GetSMessage('mmprinsertsuccess');
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

	public function actionDeleteaddress()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Hospitaladdress::model()->findbyPK($ids);
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}

	public function actionDeletecontact()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Hospitalcontact::model()->findbyPK($ids);
		  $model->delete();
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
	  $model=new Hospital('searchwstatus');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Hospital']))
		  $model->attributes=$_GET['Hospital'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		  'model'=>$model,
		  'hospitaladdress'=>$this->hospitaladdress,
		  'hospitalcontact'=>$this->hospitalcontact,
                    'accpiutang'=>$this->accpiutang
	  ));
	}

	public function actionIndexaddress()
	{
		$this->lookupdata();
	  $this->renderPartial('indexaddress',
		array('hospitaladdress'=>$this->hospitaladdress));
	  Yii::app()->end();
	}

	public function actionIndexcontact()
	{
		$this->lookupdata();
	  $this->renderPartial('indexcontact',
		array('hospitalcontact'=>$this->hospitalcontact));
	  Yii::app()->end();
	}

	public function actionUpload()
	{
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
			  $model=Hospital::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Hospital();
			  }
			  $model->addressbookid = (int)$data[0];
			  $model->fullname = $data[1];
			  $model->ishospital = 1;
			  $model->recordstatus = (int)$data[2];
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
		$sql = "select a.addressbookid,a.fullname,a.taxno,a.abno,c.accountcode
				from addressbook a 
				left join account c on c.accountid = a.acchutangid
				where ishospital=1 ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "and a.addressbookid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		$this->pdf->title='Bank List';
		$this->pdf->AddPage('L');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		foreach($dataReader as $row)
		{
			$this->pdf->setaligns(array('C','C','C'));
			$this->pdf->setwidths(array(90,40,30));
			$this->pdf->Row(array('Name','NPWP','Account Hutang'));
			$this->pdf->setaligns(array('L','L','L'));
			$this->pdf->row(array($row['fullname'],$row['taxno'],$row['accountcode']));
		  
			$sql1 = "select a.addressname,a.rt,a.rw,b.cityname,c.addresstypename,d.kelurahanname,e.subdistrictname,a.phoneno
				from address a 
				left join city b on b.cityid = a.cityid
				left join addresstype c on c.addresstypeid = a.addresstypeid
				left join kelurahan d on d.kelurahanid = a.kelurahanid
				left join subdistrict e on e.subdistrictid = a.subdistrictid
				where addressbookid= ".$row['addressbookid'];
			$command1=$this->connection->createCommand($sql1);
			$dataReader1=$command1->queryAll();			
			
			$this->pdf->SetY($this->pdf->GetY()+10);
			$this->pdf->setaligns(array('C','C','C','C','C','C','C','C'));
			$this->pdf->setwidths(array(30,30,30,30,30,30,30,30));
			$this->pdf->Row(array('Address Type','Address','RT','RW','Sub Subdistrict','Subdistrict','City','Phone No'));
			$this->pdf->setaligns(array('L','L','L','L','L','L','L','L'));
			
			foreach($dataReader1 as $row1)
			{
				$this->pdf->row(array($row1['addresstypename'],$row1['addressname'],$row1['rt'],$row1['rw'],
					$row1['kelurahanname'],$row1['subdistrictname'],$row1['cityname'],$row1['phoneno']));
			}
			$this->pdf->AddPage('L');
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
		$model=Hospital::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeladdress($id)
	{
		$model=Hospitaladdress::model()->findByPk((int)$id);
		//if($model===null)
		//	throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelcontact($id)
	{
		$model=Hospitalcontact::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Hospital-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
