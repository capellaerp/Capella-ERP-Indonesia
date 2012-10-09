<?php

class InvoiceapController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'invoiceap';

	public function actionHelp()
	{
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $this->txt = '_help'; break;
				case 2 : $this->txt = '_helpmodif'; break;
				case 3 : $this->txt = '_helpservice'; break;
				case 4 : $this->txt = '_helpservicemodif'; break;
				case 5 : $this->txt = '_helppic'; break;
				case 6 : $this->txt = '_helppicmodif'; break;
				case 7 : $this->txt = '_helplocation'; break;
				case 8 : $this->txt = '_helplocationmodif'; break;
				case 9 : $this->txt = '_helpdocument'; break;
				case 10 : $this->txt = '_helpdocumentmodif'; break;
				case 11 : $this->txt = '_helpnetwork'; break;
				case 12 : $this->txt = '_helpnetworkmodif'; break;
			}
		}
		parent::actionHelp();
	}

	public $invoicedet,$invoiceacc;

	public function lookupdata()
	{
		$this->invoicedet=new Invoicedet('search');
		$this->invoicedet->unsetAttributes();  
		if(isset($_GET['Invoicedet']))
		$this->invoicedet->attributes=$_GET['Invoicedet'];
		
		$this->invoiceacc=new Invoiceacc('search');
		$this->invoiceacc->unsetAttributes();  
		if(isset($_GET['Invoiceacc']))
		$this->invoiceacc->attributes=$_GET['Invoiceacc'];

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
	  $this->lookupdata();
		$model=new Invoice;
		$model->invoicetypeid = 1;
		$model->recordstatus=Wfgroup::model()->findstatusbyuser('insinvap');
		if (Yii::app()->request->isAjaxRequest)
        {
			if ($model->save()) {
			  echo CJSON::encode(array(
				  'status'=>'success',
				  'invoiceid'=>$model->invoiceid,
				  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'invoicedet'=>$this->invoicedet,
				  'invoiceacc'=>$this->invoiceacc), true)
				  ));
			  Yii::app()->end();
			}
        }
	}

	public function actionCreateinvoicedet()
	{
		parent::actionCreate();
		$invoicedet=new Invoicedet;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_forminvoicedet',
				  array('model'=>$invoicedet), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionCreateinvoiceacc()
	{
		parent::actionCreate();
		$invoiceacc=new Invoiceacc;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_forminvoiceacc',
				  array('model'=>$invoiceacc), true)
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
		parent::actionCreate();
		$id=$_POST['id'];
	  $model=$this->loadModel($id[0]);

	  $this->lookupdata();

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'invoiceid'=>$model->invoiceid,
				  'addressbookid'=>$model->addressbookid,
					'invoicedate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->invoicedate)),
				  'fullname'=>($model->customer!==null)?$model->customer->fullname:"",
				  'amount'=>$model->amount,
				  'invoiceno'=>$model->invoiceno,
				  'pono'=>$model->pono,
				  'headernote'=>$model->headernote,
				  'currencyid'=>$model->currencyid,
				  'currencyname'=>($model->currency!==null)?$model->currency->currencyname:"",
				  'taxid'=>$model->taxid,
				  'taxcode'=>($model->tax!==null)?$model->tax->taxcode:"",
				  'paymentmethodid'=>$model->paymentmethodid,
				  'paycode'=>($model->paymentmethod!==null)?$model->paymentmethod->paycode:"",
				  'rate'=>$model->rate,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
				  'invoicedet'=>$this->invoicedet,
				  'invoiceacc'=>$this->invoiceacc), true)
				));
            Yii::app()->end();
        }
	}

	public function actionUpdateinvoiceacc()
	{
		$id=$_POST['id'];
	  $invoiceacc=$this->loadModeldetailinvoiceacc($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'invoiceaccid'=>$invoiceacc->invoiceaccid,
				'accountid'=>$invoiceacc->accountid,
                'accountname'=>($invoiceacc->account!==null)?$invoiceacc->account->accountname:"",
                'currencyid'=>$invoiceacc->currencyid,
                'currencyname'=>($invoiceacc->currency!==null)?$invoiceacc->currency->currencyname:"",
                'debit'=>$invoiceacc->debit,
                'credit'=>$invoiceacc->credit,
                'currencyrate'=>$invoiceacc->currencyrate,
                'description'=>$invoiceacc->description,
                'div'=>$this->renderPartial('_forminvoiceacc',array('model'=>$invoiceacc), true)
				));
            Yii::app()->end();
        }
	}
	
	public function actionUpdateinvoicedet()
	{
		$id=$_POST['id'];
	  $invoicedet=$this->loadModelinvoicedet($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'invoicedetid'=>$invoicedet->invoicedetid,
				'itemname'=>$invoicedet->itemname,
                'currencyid'=>$invoicedet->currencyid,
                'currencyname'=>($invoicedet->currency!==null)?$invoicedet->currency->currencyname:"",
                'unitofmeasureid'=>$invoicedet->unitofmeasureid,
                'uomcode'=>($invoicedet->unitofmeasure!==null)?$invoicedet->unitofmeasure->uomcode:"",
                'price'=>$invoicedet->price,
                'qty'=>$invoicedet->qty,
                'rate'=>$invoicedet->rate,
                'description'=>$invoicedet->description,
                'div'=>$this->renderPartial('_forminvoicedet',array('model'=>$invoicedet), true)
				));
            Yii::app()->end();
        }
	}
		
    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Invoice'], $_POST['Invoice']['invoiceid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Invoice']))
	  {
         $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Invoice']['invoiceid'] > 0)
		{
		  $model=$this->loadModel($_POST['Invoice']['invoiceid']);
		  $model->addressbookid = $_POST['Invoice']['addressbookid'];
		  $model->invoiceno = $_POST['Invoice']['invoiceno'];
		  $model->pono = $_POST['Invoice']['pono'];
		  $model->amount = $_POST['Invoice']['amount'];
		  $model->currencyid = $_POST['Invoice']['currencyid'];
		  $model->taxid = $_POST['Invoice']['taxid'];
		  $model->rate = $_POST['Invoice']['rate'];
		  $model->invoicedate = $_POST['Invoice']['invoicedate'];
		  $model->paymentmethodid = $_POST['Invoice']['paymentmethodid'];
		  $model->headernote = $_POST['Invoice']['headernote'];
		}
		else
		{
		  $model = new Invoice();
		  $model->attributes=$_POST['Invoice'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Invoice']['invoiceid']);
              $this->GetSMessage('insertsuccess');
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
	
	public function actionCancelWriteinvoiceacc()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Invoiceacc'], $_POST['Invoiceacc']['invoiceaccid']);
    }
	
	public function actionWriteinvoiceacc()
	{
	  if(isset($_POST['Invoiceacc']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Invoiceacc']['invoiceaccid'] > 0)
		{
		  $model=Invoiceacc::model()->findbyPK($_POST['Invoiceacc']['invoiceaccid']);
		  $model->invoiceid = $_POST['Invoiceacc']['invoiceid'];
		  $model->accountid = $_POST['Invoiceacc']['accountid'];
		  $model->debit = $_POST['Invoiceacc']['debit'];
		  $model->credit = $_POST['Invoiceacc']['credit'];
		  $model->currencyid = $_POST['Invoiceacc']['currencyid'];
		  $model->currencyrate = $_POST['Invoiceacc']['currencyrate'];
		  $model->description = $_POST['Invoiceacc']['description'];
		}
		else
		{
		  $model = new Invoiceacc();
		  $model->attributes=$_POST['Invoiceacc'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Invoiceacc']['invoiceaccid']);
              $this->GetSMessage('ppinsertsuccess');
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
	
	public function actionCancelWriteinvoicedet()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Invoicedet'], $_POST['Invoicedet']['invoicedetid']);
    }
	
	public function actionWriteinvoicedet()
	{
	  if(isset($_POST['Invoicedet']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Invoicedet']['invoicedetid'] > 0)
		{
		  $model=Invoicedet::model()->findbyPK($_POST['Invoicedet']['invoicedetid']);
		  $model->invoicedetid = $_POST['Invoicedet']['invoicedetid'];
		  $model->itemname = $_POST['Invoicedet']['itemname'];
		  $model->price = $_POST['Invoicedet']['price'];
		  $model->currencyid = $_POST['Invoicedet']['currencyid'];
		  $model->qty = $_POST['Invoicedet']['qty'];
		  $model->unitofmeasureid = $_POST['Invoicedet']['unitofmeasureid'];
		  $model->currencyid = $_POST['Invoicedet']['currencyid'];
		  $model->rate = $_POST['Invoicedet']['rate'];
		  $model->description = $_POST['Invoicedet']['description'];
		}
		else
		{
		  $model = new Invoicedet();
		  $model->attributes=$_POST['Invoicedet'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Invoicedet']['invoicedetid']);
              $this->GetSMessage('ppinsertsuccess');
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
	
	public function actionApprove()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
			//$model=$this->loadModel($ids);
                    $a = Yii::app()->user->name;
			$connection=Yii::app()->db;
			  $transaction=$connection->beginTransaction();
			  try
			  {
				$sql = 'call ApproveInvoiceAP(:vid, :vlastupdateby)';
				$command=$connection->createCommand($sql);
				$command->bindvalue(':vid',$ids,PDO::PARAM_INT);
				$command->bindvalue(':vlastupdateby', $a,PDO::PARAM_STR);
				$command->execute();
				$transaction->commit();
				$this->GetSMessage('pprinsertsuccess');
			  }
			  catch(CDbexception $e) // an exception is raised if a query fails
			  {
				  $transaction->rollBack();
				  $this->GetMessage($e->getMessage());
			  }
		}
        Yii::app()->end();
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteinvoicedet()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Invoicedet::model()->findbyPK($ids);
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}
	
	public function actionDeleteinvoiceacc()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Invoiceacc::model()->findbyPK($ids);
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
		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];
		if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}

		$this->render('index',array(
			'model'=>$model,
				  'invoicedet'=>$this->invoicedet,
				  'invoiceacc'=>$this->invoiceacc
		));
	}

	public function actionIndexinvoicedet()
	{
		$this->lookupdata();
	  $this->renderPartial('indexinvoicedet',
		array('invoicedet'=>$this->invoicedet));
	  Yii::app()->end();
	}
	
	public function actionIndexinvoiceacc()
	{
		$this->lookupdata();
	  $this->renderPartial('indexinvoiceacc',
		array('invoiceacc'=>$this->invoiceacc));
	  Yii::app()->end();
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
						$model=Company::model()->findByPk((int)$data[0]);
						if ($model=== null) {
							$model = new Company();
						}
						$model->companyid = (int)$data[0];
						$model->companyname = $data[1];
						$model->address = $data[2];
						$city = City::model()->findbyattributes(array('cityname'=>$data[3]));
						if ($city !== null)
						{
							$model->cityid = $city->cityid;
						}
						$model->zipcode = $data[4];
						$model->taxno = $data[5];
						$currency = Currency::model()->findbyattributes(array('currencyname'=>$data[6]));
						if ($currency !== null)
						{
							$model->currencyid = $currency->currencyid;
						}
						$model->recordstatus = (int)$data[7];
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
	   $sql = "select a.invoiceapid,a.fullname, a.oldnik, b.levelorgname, c.structurename,d.positionname,e.invoiceaptypename,
        f.sexname,joindate,email,phoneno,alternateemail,hpno,a.addressbookid,a.accountno,a.taxno,g.maritalstatusname,
        h.religionname,a.birthdate,i.cityname
      from invoiceap a
      left join levelorg b on b.levelorgid = a.levelorgid
      left join orgstructure c on c.orgstructureid = a.orgstructureid
      left join position d on d.positionid = a.positionid
      left join invoiceaptype e on e.invoiceaptypeid = a.invoiceaptypeid
      left join sex f on f.sexid = a.sexid
      left join maritalstatus g on g.maritalstatusid = a.maritalstatusid
      left join religion h on h.religionid = a.religionid
      left join city i on i.cityid = a.birthcityid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.invoiceapid = ".$_GET['id'];
		}
		$sql = $sql . " order by invoiceapid";
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Invoiceap List';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    foreach($dataReader as $row)
    {
      if (file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/invoiceap/photo-'.$row['oldnik'].'.jpg'))
      {
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/invoiceap/photo-'. $row['oldnik'] .'.jpg',10,30,30);
      }
      $this->pdf->setFont('Arial','B',10);
      $this->pdf->text(50,30,'Nama: '.$row['fullname']);
      $this->pdf->setFont('Arial','',8);
      $this->pdf->text(50,35,'Posisi: '.$row['positionname']);
      $this->pdf->text(50,40,'Struktur: '.$row['structurename']);
      $this->pdf->text(50,45,'Golongan: '.$row['levelorgname']);
      $this->pdf->text(50,50,'Tempat Tanggal Lahir: '.$row['cityname'].', '.date(Yii::app()->params['dateviewfromdb'], strtotime($row['birthdate'])));
      $this->pdf->text(50,55,'Jenis Kelamin: '.$row['sexname']);
      $this->pdf->text(50,60,'Marital Status: '.$row['maritalstatusname']);
      $this->pdf->text(50,65,'Agama: '.$row['religionname']);
      $this->pdf->text(50,70,'Telp: '.$row['phoneno']);
      $this->pdf->text(50,75,'No HP: '.$row['hpno']);
      $this->pdf->text(50,80,'Email Utama: '.$row['email']);
      $this->pdf->text(50,85,'Email ke-2: '.$row['alternateemail']);
      $this->pdf->text(50,90,'No Rekening: '.$row['accountno']);
      $this->pdf->text(50,95,'NPWP: '.$row['taxno']);

      $sql1 = "select b.addresstypename, a.addressname, c.cityname, a.phoneno
        from address a
        left join addresstype b on b.addresstypeid = a.addresstypeid
        left join city c on c.cityid = a.cityid
        where addressbookid = ".$row['addressbookid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,100,'Address List');
      $this->pdf->SetY(105);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(50,50,50,30));
      $this->pdf->Row(array('Address Type','Address','City','Phone No'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['addresstypename'],$row1['addressname'],$row1['cityname'],$row1['phoneno']));
      }

      $sql1 = "select b.educationname, a.schoolname, a.schooldegree, c.cityname, a.yeargraduate
        from invoiceapeducation a
        left join education b on b.educationid = a.educationid
        left join city c on c.cityid = a.cityid
        where invoiceapid = ".$row['invoiceapid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Education List');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C','C'));
      $this->pdf->setwidths(array(50,50,30,30,30));
      $this->pdf->Row(array('Degree','School/Institut','Education Major','City','Year Graduate'));
      $this->pdf->setaligns(array('L','L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['educationname'],$row1['schoolname'],$row1['schooldegree'],$row1['cityname'],$row1['yeargraduate']));
      }
      
      $sql1 = "select a.informalname,a.organizer,a.period
        from invoiceapinformal a
        where invoiceapid = ".$row['invoiceapid']." and iswo=0";
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Informal List');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(60,40,50));
      $this->pdf->Row(array('Course / Training / Skill', 'Organizer', 'Period'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['informalname'],$row1['organizer'],$row1['period']));
      }
      
      $sql1 = "select a.informalname,a.organizer,a.period,a.sponsoredby
        from invoiceapinformal a
        where invoiceapid = ".$row['invoiceapid']." and iswo=1";
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Working Experience List');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(80,30,30,50));
      $this->pdf->Row(array('Company', 'Golongan','Position', 'Period'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['informalname'],$row1['sponsoredby'],$row1['organizer'],$row1['period']));
      }
      
      $sql1 = "select b.familyrelationname, a.familyname, c.cityname,
        d.sexname, a.birthdate, e.educationname, f.occupationname
        from invoiceapfamily a
        left join familyrelation b on b.familyrelationid = a.familyrelationid
        left join city c on c.cityid = a.cityid
        left join sex d on d.sexid = a.sexid
        left join education e on e.educationid = a.educationid
        left join occupation f on f.occupationid = a.occupationid
        where invoiceapid = ".$row['invoiceapid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Family Member');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(50,40,30,40,30,30,30));
      $this->pdf->Row(array('Family Relation', 'Family Name', 'Sex', 'Occupation'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['familyrelationname'],$row1['familyname'],$row1['sexname'],$row1['occupationname']));
      }
      
      $sql1 = "select b.identitytypename, a.identityname
        from invoiceapidentity a
        left join identitytype b on b.identitytypeid = a.identitytypeid
        where a.invoiceapid = ".$row['invoiceapid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Identity List');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(60,50));
      $this->pdf->Row(array('Identity Type', 'Identity Name'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['identitytypename'],$row1['identityname']));
      }
      
      $sql1 = "select b.languagename,c.languagevaluename
        from invoiceapforeignlanguage a
        left join language b on b.languageid = a.languageid
        left join languagevalue c on c.languagevalueid = a.languagevalueid
        where a.invoiceapid = ".$row['invoiceapid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,$this->pdf->gety()+10,'Language Skill');
      $this->pdf->sety($this->pdf->gety()+15);
      $this->pdf->setaligns(array('C','C','C','C'));
      $this->pdf->setwidths(array(60,50));
      $this->pdf->Row(array('Language', 'Language Value'));
      $this->pdf->setaligns(array('L','L','L','L'));
      foreach($dataReader1 as $row1)
      {
        $this->pdf->row(array($row1['languagename'],$row1['languagevaluename']));
      }
      $this->pdf->AddPage('P');
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
		$model=Invoice::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelinvoicedet($id)
	{
		$model=Invoicedet::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModeldetailinvoiceacc($id)
	{
		$model=Invoiceacc::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoiceap-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoiceapservice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
