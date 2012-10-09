<?php

class CustomerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'customer';

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

	public $customeraddress,$customercontact,$acchutang;

		public function lookupdata()
	{
		$this->customeraddress=new Customeraddress('search');
	  $this->customeraddress->unsetAttributes();  // clear any default values
	  if(isset($_GET['Customeraddress']))
		$this->customeraddress->attributes=$_GET['Customeraddress'];

		$this->customercontact=new Customercontact('search');
	  $this->customercontact->unsetAttributes();  // clear any default values
	  if(isset($_GET['Customercontact']))
		$this->customercontact->attributes=$_GET['Customercontact'];

      		$this->acchutang=new Account('search');
	  $this->acchutang->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$this->acchutang->attributes=$_GET['Account'];

      }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
    $this->lookupdata();
		$model=new Customer;
$model->fullname='customer';
		$model->iscustomer=1;
		$model->recordstatus=1;
		if (Yii::app()->request->isAjaxRequest)
        {
		  if ($model->save()) {
            echo CJSON::encode(array(
                'status'=>'success',
                'addressbookid'=>$model->addressbookid,
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
                'customeraddress'=>$this->customeraddress,
                'customercontact'=>$this->customercontact,
                    'acchutang'=>$this->acchutang), true)
				));
            Yii::app()->end();
		  }
        }
	}

	public function actionCreateaddress()
	{
		parent::actionCreate();
		$this->lookupdata();

		$customeraddress=new Customeraddress;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formaddress',
				  array('model'=>$customeraddress), true)
				));
            Yii::app()->end();
        }
	}

	public function actionCreatecontact()
	{
		parent::actionCreate();
		$this->lookupdata();

		$customercontact=new Customercontact;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formcontact',
				  array('model'=>$customercontact), true)
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
                'acchutangid'=>$model->acchutangid,
                'acchutangname'=>($model->acchutang!==null)?$model->acchutang->accountname:"",
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
                'customeraddress'=>$this->customeraddress,
                'customercontact'=>$this->customercontact,
                    'acchutang'=>$this->acchutang), true)
				));
            Yii::app()->end();
        }
        }
	}

	public function actionUpdateaddress()
	{
	  $id=$_POST['id'];
	  $customeraddress=$this->loadModeladdress($id[0]);

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addressid'=>$customeraddress->addressid,
			'addressbookid'=>$customeraddress->addressbookid,
			'fullname'=>($customeraddress->addressbook!==null)?$customeraddress->addressbook->fullname:"",
			'addresstypeid'=>$customeraddress->addresstypeid,
			'addresstypename'=>($customeraddress->addresstype!==null)?$customeraddress->addresstype->addresstypename:"",
			'addressname'=>$customeraddress->addressname,
			'rt'=>$customeraddress->rt,
			'rw'=>$customeraddress->rw,
			'cityid'=>$customeraddress->cityid,
			'cityname'=>($customeraddress->city!==null)?$customeraddress->city->cityname:"",
			'kelurahanid'=>$customeraddress->kelurahanid,
			'kelurahanname'=>($customeraddress->kelurahan!==null)?$customeraddress->kelurahan->kelurahanname:"",
			'subdistrictid'=>$customeraddress->subdistrictid,
			'subdistrictname'=>($customeraddress->subdistrict!==null)?$customeraddress->subdistrict->subdistrictname:"",
			'phoneno'=>$customeraddress->phoneno,
			  'div'=>$this->renderPartial('_formaddress', array('model'=>$customeraddress), true)
			  ));
		  Yii::app()->end();
	  }
	}

	public function actionUpdatecontact()
	{
	  $id=$_POST['id'];
	  $customercontact=$this->loadModelcontact($id[0]);

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addresscontactid'=>$customercontact->addresscontactid,
			'addressbookid'=>$customercontact->addressbookid,
			'fullname'=>$customercontact->addressbook->fullname,
			'contacttypeid'=>$customercontact->contacttypeid,
			'contacttypename'=>($customercontact->contacttype!==null)?$customercontact->contacttype->contacttypename:"",
			'addresscontactname'=>$customercontact->addresscontactname,
			'phoneno'=>$customercontact->phoneno,
			'mobilephone'=>$customercontact->mobilephone,
			'emailaddress'=>$customercontact->emailaddres,
			  'div'=>$this->renderPartial('_formcontact', array('model'=>$customercontact), true)
			  ));
		  Yii::app()->end();
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Customer'], $_POST['Customer']['addressbookid']);
    }

	public function actionWrite()
	{
		parent::actionWrite();
	  if(isset($_POST['Customer']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Customer']['fullname'],'emptyfullname','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Customer'];
		if ((int)$_POST['Customer']['addressbookid'] > 0)
		{
		  $model=$this->loadModel($_POST['Customer']['addressbookid']);
		  $model->fullname = $_POST['Customer']['fullname'];
		  $model->taxno = $_POST['Customer']['taxno'];
		  $model->acchutangid = $_POST['Customer']['acchutangid'];
		  $model->recordstatus = $_POST['Customer']['recordstatus'];
		}
		else
		{
		  $model = new Customer();
		  $model->iscustomer = 1;
		  $model->attributes=$_POST['Customer'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Customer']['addressbookid']);
              $this->GetSMessage('scuinsertsuccess');
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
	  if(isset($_POST['Customeraddress']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Customeraddress']['addresstypeid'],'emptyaddresstypeid','emptystring'),
                array($_POST['Customeraddress']['addressname'],'emptyaddressname','emptystring'),
                array($_POST['Customeraddress']['cityid'],'emptycityid','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Customeraddress']['addressid'] > 0)
		{
		  $model=Customeraddress::model()->findbyPK($_POST['Customeraddress']['addressid']);
		  $model->addressbookid = $_POST['Customeraddress']['addressbookid'];
		  $model->addresstypeid = $_POST['Customeraddress']['addresstypeid'];
		  $model->addressname = $_POST['Customeraddress']['addressname'];
		  $model->rt = $_POST['Customeraddress']['rt'];
		  $model->rw = $_POST['Customeraddress']['rw'];
		  $model->cityid = $_POST['Customeraddress']['cityid'];
		  $model->kelurahanid = $_POST['Customeraddress']['kelurahanid'];
		  $model->subdistrictid = $_POST['Customeraddress']['subdistrictid'];
		  $model->phoneno = $_POST['Supplieraddress']['phoneno'];
		}
		else
		{
		  $model = new Customeraddress();
		  $model->attributes=$_POST['Customeraddress'];
		}
		try
          {
            if($model->save())
            {
              $this->GetSMessage('scuinsertsuccess');
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
	  if(isset($_POST['Customercontact']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Customercontact']['contacttypeid'],'emptycontacttypeid','emptystring'),
                array($_POST['Customercontact']['addresscontactname'],'emptyaddresscontactname','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Customercontact']['addresscontactid'] > 0)
		{
		  $model=Customercontact::model()->findbyPK($_POST['Customercontact']['addresscontactid']);
		  $model->addressbookid = $_POST['Customercontact']['addressbookid'];
		  $model->contacttypeid = $_POST['Customercontact']['contacttypeid'];
		  $model->addresscontactname = $_POST['Customercontact']['addresscontactname'];
		  $model->phoneno = $_POST['Suppliercontact']['phoneno'];
		  $model->mobilephone = $_POST['Suppliercontact']['mobilephone'];
		  $model->emailaddress = $_POST['Suppliercontact']['emailaddress'];
		}
		else
		{
		  $model = new Customercontact();
		  $model->attributes=$_POST['Customercontact'];
		}
		try
          {
            if($model->save())
            {
              $this->GetSMessage('scuinsertsuccess');
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

	public function actionDeleteaddress()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Customeraddress::model()->findbyPK($ids);
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
		  $model=Customercontact::model()->findbyPK($ids);
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
    $model=new Customer('searchwstatus');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];
			if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
		  'customeraddress'=>$this->customeraddress,
		  'customercontact'=>$this->customercontact,
                    'acchutang'=>$this->acchutang
		));
	}

	public function actionIndexaddress()
	{
		$this->lookupdata();
	  $this->renderPartial('indexaddress',
		array('customeraddress'=>$this->customeraddress));
	  Yii::app()->end();
	}

	public function actionIndexcontact()
	{
		$this->lookupdata();
	  $this->renderPartial('indexcontact',
		array('customercontact'=>$this->customercontact));
	  Yii::app()->end();
	}

public function actionUpload()
	{
      parent::actionUpload();
	  $folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';// folder for uploaded files
	  $allowedExtensions = array("csv");
	  $sizeLimit = (int)Yii::app()->params['sizeLimit'];// maximum file size in bytes
	  $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
	  $result = $uploader->handleUpload($folder,true);
	  $row = 0;
	  if (($handle = fopen($folder.$uploader->file->getName(), "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if ($row>0) {
			  $model=Customer::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Customer();
			  }
			  $model->addressbookid = (int)$data[0];
			  $model->fullname = $data[1];
			  $model->recordstatus = (int)$data[2];
			  try
			  {
				if(!$model->save())
				{
				  $errormessage=$model->getErrors();
				  if (Yii::app()->request->isAjaxRequest)
				  {
					echo CJSON::encode(array(
					  'status'=>'failure',
					  'div'=>$errormessage
					));
				  }
				}
			  }
			  catch (Exception $e)
			  {
				$errormessage=$e->getMessage();
				if (Yii::app()->request->isAjaxRequest)
				  {
					echo CJSON::encode(array(
					  'status'=>'failure',
					  'div'=>$errormessage
					));
				  }
			  }
			}
			$row++;
		  }
		  fclose($handle);
	  }
	  $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	  echo $result;
  }
	public function actionDownload()
	{
		parent::actionDownload();
		$sql = "select a.addressbookid,a.fullname,a.taxno,a.abno,c.accountcode
				from addressbook a 
				left join account c on c.accountid = a.acchutangid
				where iscustomer=1 ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "and a.addressbookid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		$this->pdf->title='Customer List';
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
			
			$sql1 = "select a.addresscontactname,b.contacttypename,a.phoneno,a.mobilephone,a.emailaddress
				from addresscontact a 
				left join contacttype b on b.contacttypeid = a.contacttypeid
				where a.addressbookid= ".$row['addressbookid'];
			$command1=$this->connection->createCommand($sql1);
			$dataReader1=$command1->queryAll();			
			
			$this->pdf->SetY($this->pdf->GetY()+10);
			$this->pdf->setaligns(array('C','C','C','C','C','C','C','C'));
			$this->pdf->setwidths(array(60,50,50,50,50,50,30,30));
			$this->pdf->Row(array('PIC','Contact Type','Phone No','Mobile Phone','Email Address'));
			$this->pdf->setaligns(array('L','L','L','L','L','L','L','L'));
			
			foreach($dataReader1 as $row1)
			{
				$this->pdf->row(array($row1['addresscontactname'],$row1['contacttypename'],$row1['phoneno'],$row1['mobilephone'],
					$row1['emailaddress']));
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
		$model=Customer::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeladdress($id)
	{
		$model=Customeraddress::model()->findByPk((int)$id);
		//if($model===null)
		//	throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelcontact($id)
	{
		$model=Customercontact::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
