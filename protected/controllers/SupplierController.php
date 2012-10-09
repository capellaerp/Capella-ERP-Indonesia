<?php

class SupplierController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'supplier';

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

	public $supplieraddress,$suppliercontact,$acchutang;

		public function lookupdata()
	{
		$this->supplieraddress=new Supplieraddress('search');
	  $this->supplieraddress->unsetAttributes();  // clear any default values
	  if(isset($_GET['Supplieraddress']))
		$this->supplieraddress->attributes=$_GET['Supplieraddress'];

		$this->suppliercontact=new Suppliercontact('search');
	  $this->suppliercontact->unsetAttributes();  // clear any default values
	  if(isset($_GET['Suppliercontact']))
		$this->suppliercontact->attributes=$_GET['Suppliercontact'];

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
		$model=new Supplier;
$model->fullname='supplier';
		$model->isvendor=1;
		$model->recordstatus=1;
		if (Yii::app()->request->isAjaxRequest)
        {
		  if ($model->save()) {
            echo CJSON::encode(array(
                'status'=>'success',
                'addressbookid'=>$model->addressbookid,
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
                'supplieraddress'=>$this->supplieraddress,
                'suppliercontact'=>$this->suppliercontact,
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

		$supplieraddress=new Supplieraddress;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formaddress',
				  array('model'=>$supplieraddress), true)
				));
            Yii::app()->end();
        }
	}

	public function actionCreatecontact()
	{
		parent::actionCreate();
		$this->lookupdata();

		$suppliercontact=new Suppliercontact;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formcontact',
				  array('model'=>$suppliercontact), true)
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
                'supplieraddress'=>$this->supplieraddress,
                'suppliercontact'=>$this->suppliercontact,
                    'acchutang'=>$this->acchutang), true)
				));
            Yii::app()->end();
        }
        }
	}

	public function actionUpdateaddress()
	{
	  $id=$_POST['id'];
	  $supplieraddress=$this->loadModeladdress($id[0]);

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addressid'=>$supplieraddress->addressid,
			'addressbookid'=>$supplieraddress->addressbookid,
			'fullname'=>($supplieraddress->addressbook!==null)?$supplieraddress->addressbook->fullname:"",
			'addresstypeid'=>$supplieraddress->addresstypeid,
			'addresstypename'=>($supplieraddress->addresstype!==null)?$supplieraddress->addresstype->addresstypename:"",
			'addressname'=>$supplieraddress->addressname,
			'rt'=>$supplieraddress->rt,
			'rw'=>$supplieraddress->rw,
			'cityid'=>$supplieraddress->cityid,
			'cityname'=>($supplieraddress->city!==null)?$supplieraddress->city->cityname:"",
			'kelurahanid'=>$supplieraddress->kelurahanid,
			'kelurahanname'=>($supplieraddress->kelurahan!==null)?$supplieraddress->kelurahan->kelurahanname:"",
			'subdistrictid'=>$supplieraddress->subdistrictid,
			'subdistrictname'=>($supplieraddress->subdistrict!==null)?$supplieraddress->subdistrict->subdistrictname:"",
			  'div'=>$this->renderPartial('_formaddress', array('model'=>$supplieraddress), true)
			  ));
		  Yii::app()->end();
	  }
	}

	public function actionUpdatecontact()
	{
	  $id=$_POST['id'];
	  $suppliercontact=$this->loadModelcontact($id[0]);

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addresscontactid'=>$suppliercontact->addresscontactid,
			'addressbookid'=>$suppliercontact->addressbookid,
			'fullname'=>$suppliercontact->addressbook->fullname,
			'contacttypeid'=>$suppliercontact->contacttypeid,
			'contacttypename'=>($suppliercontact->contacttype!==null)?$suppliercontact->contacttype->contacttypename:"",
			'addresscontactname'=>$suppliercontact->addresscontactname,
			  'div'=>$this->renderPartial('_formcontact', array('model'=>$suppliercontact), true)
			  ));
		  Yii::app()->end();
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Supplier'], $_POST['Supplier']['addressbookid']);
    }

	public function actionWrite()
	{
		parent::actionWrite();
	  if(isset($_POST['Supplier']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Supplier']['fullname'],'scuemptyfullname','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Supplier'];
		if ((int)$_POST['Supplier']['addressbookid'] > 0)
		{
		  $model=$this->loadModel($_POST['Supplier']['addressbookid']);
		  $model->fullname = $_POST['Supplier']['fullname'];
		  $model->taxno = $_POST['Supplier']['taxno'];
		  $model->acchutangid = $_POST['Supplier']['acchutangid'];
		  $model->recordstatus = $_POST['Supplier']['recordstatus'];
		}
		else
		{
		  $model = new Supplier();		  
		  $model->attributes=$_POST['Supplier'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Supplier']['addressbookid']);
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
	  if(isset($_POST['Supplieraddress']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Supplieraddress']['addresstypeid'],'scuemptyaddresstypeid','emptystring'),
                array($_POST['Supplieraddress']['addressname'],'scuemptyaddressname','emptystring'),
                array($_POST['Supplieraddress']['cityid'],'scuemptycityid','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Supplieraddress']['addressid'] > 0)
		{
		  $model=Supplieraddress::model()->findbyPK($_POST['Supplieraddress']['addressid']);
		  $model->addressbookid = $_POST['Supplieraddress']['addressbookid'];
		  $model->addresstypeid = $_POST['Supplieraddress']['addresstypeid'];
		  $model->addressname = $_POST['Supplieraddress']['addressname'];
		  $model->rt = $_POST['Supplieraddress']['rt'];
		  $model->rw = $_POST['Supplieraddress']['rw'];
		  $model->cityid = $_POST['Supplieraddress']['cityid'];
		  $model->kelurahanid = $_POST['Supplieraddress']['kelurahanid'];
		  $model->subdistrictid = $_POST['Supplieraddress']['subdistrictid'];
		  $model->phoneno = $_POST['Supplieraddress']['phoneno'];
		}
		else
		{
		  $model = new Supplieraddress();
		  $model->attributes=$_POST['Supplieraddress'];
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
	  if(isset($_POST['Suppliercontact']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Suppliercontact']['contacttypeid'],'scuemptycontacttypeid','emptystring'),
                array($_POST['Suppliercontact']['addresscontactname'],'scuemptyaddresscontactname','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Suppliercontact']['addresscontactid'] > 0)
		{
		  $model=Suppliercontact::model()->findbyPK($_POST['Suppliercontact']['addresscontactid']);
		  $model->addressbookid = $_POST['Suppliercontact']['addressbookid'];
		  $model->contacttypeid = $_POST['Suppliercontact']['contacttypeid'];
		  $model->addresscontactname = $_POST['Suppliercontact']['addresscontactname'];
		  $model->phoneno = $_POST['Suppliercontact']['phoneno'];
		  $model->mobilephone = $_POST['Suppliercontact']['mobilephone'];
		  $model->emailaddress = $_POST['Suppliercontact']['emailaddress'];
		}
		else
		{
		  $model = new Suppliercontact();
		  $model->attributes=$_POST['Suppliercontact'];
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
		  $model=Supplieraddress::model()->findbyPK($ids);
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
		  $model=Suppliercontact::model()->findbyPK($ids);
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
    $model=new Supplier('searchwstatus');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Supplier']))
			$model->attributes=$_GET['Supplier'];
			if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
		  'supplieraddress'=>$this->supplieraddress,
		  'suppliercontact'=>$this->suppliercontact,
                    'acchutang'=>$this->acchutang
		));
	}

	public function actionIndexaddress()
	{
		$this->lookupdata();
	  $this->renderPartial('indexaddress',
		array('supplieraddress'=>$this->supplieraddress));
	  Yii::app()->end();
	}

	public function actionIndexcontact()
	{
		$this->lookupdata();
	  $this->renderPartial('indexcontact',
		array('suppliercontact'=>$this->suppliercontact));
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
			  $model=Supplier::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Supplier();
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
				where issupplier=1 ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "and a.addressbookid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		$this->pdf->title='Supplier List';
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
		$model=Supplier::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeladdress($id)
	{
		$model=Supplieraddress::model()->findByPk((int)$id);
		//if($model===null)
		//	throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelcontact($id)
	{
		$model=Suppliercontact::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Supplier-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
