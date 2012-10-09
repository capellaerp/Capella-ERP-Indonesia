<?php

class CashbankinController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'cashbankin';

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

	public $cashbankacc;

	public function lookupdata()
	{
		$this->cashbankacc=new Cashbankacc('search');
		$this->cashbankacc->unsetAttributes();  
		if(isset($_GET['Cashbankacc']))
		$this->cashbankacc->attributes=$_GET['Cashbankacc'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
	  $this->lookupdata();
		$model=new Cashbank;
		$model->cashbanktypeid = 1;
		$model->recordstatus=Wfgroup::model()->findstatusbyuser('inscashbankin');
		if (Yii::app()->request->isAjaxRequest)
        {
			if ($model->save()) {
			  echo CJSON::encode(array(
				  'status'=>'success',
				  'cashbankid'=>$model->cashbankid,
				  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'cashbankacc'=>$this->cashbankacc), true)
				  ));
			  Yii::app()->end();
			}
        }
	}
	
	public function actionCreatecashbankacc()
	{
		parent::actionCreate();
		$cashbankacc=new Cashbankacc;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formcashbankacc',
				  array('model'=>$cashbankacc), true)
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
				'cashbankid'=>$model->cashbankid,
				  'invoiceid'=>$model->invoiceid,
					'transdate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->transdate)),
				  'invoiceno'=>($model->invoice!==null)?$model->invoice->invoiceno:"",
				  'amount'=>$model->amount,
				  'description'=>$model->description,
				  'currencyid'=>$model->currencyid,
				  'currencyname'=>($model->currency!==null)?$model->currency->currencyname:"",
				  'currencyrate'=>$model->currencyrate,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
				  'cashbankacc'=>$this->cashbankacc), true)
				));
            Yii::app()->end();
        }
	}

	public function actionUpdatecashbankacc()
	{
		$id=$_POST['id'];
	  $cashbankacc=$this->loadModeldetailcashbankacc($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'cashbankaccid'=>$cashbankacc->cashbankaccid,
				'accountid'=>$cashbankacc->accountid,
                'accountname'=>($cashbankacc->account!==null)?$cashbankacc->account->accountname:"",
                'currencyid'=>$cashbankacc->currencyid,
                'currencyname'=>($cashbankacc->currency!==null)?$cashbankacc->currency->currencyname:"",
                'debit'=>$cashbankacc->debit,
                'credit'=>$cashbankacc->credit,
                'currencyrate'=>$cashbankacc->currencyrate,
                'description'=>$cashbankacc->description,
                'div'=>$this->renderPartial('_formcashbankacc',array('model'=>$cashbankacc), true)
				));
            Yii::app()->end();
        }
	}
		
    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Cashbank'], $_POST['Cashbank']['cashbankid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Cashbank']))
	  {
         $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Cashbank']['cashbankid'] > 0)
		{
		  $model=$this->loadModel($_POST['Cashbank']['cashbankid']);
		  $model->invoiceid = $_POST['Cashbank']['invoiceid'];
		  $model->accountid = $_POST['Cashbank']['accountid'];
		  $model->amount = $_POST['Cashbank']['amount'];
		  $model->currencyid = $_POST['Cashbank']['currencyid'];
		  $model->currencyrate = $_POST['Cashbank']['currencyrate'];
		  $model->transdate = $_POST['Cashbank']['transdate'];
		  $model->description = $_POST['Cashbank']['description'];
		}
		else
		{
		  $model = new Cashbank();
		  $model->attributes=$_POST['Cashbank'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Cashbank']['cashbankid']);
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
	
	public function actionCancelWritecashbankacc()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Cashbankacc'], $_POST['Cashbankacc']['cashbankaccid']);
    }
	
	public function actionWritecashbankacc()
	{
	  if(isset($_POST['Cashbankacc']))
	  {
	  $messages = $this->ValidateData(
                array(
            )
        );
         if ($messages == '') {
		if ((int)$_POST['Cashbankacc']['cashbankaccid'] > 0)
		{
		  $model=Cashbankacc::model()->findbyPK($_POST['Cashbankacc']['cashbankaccid']);
		  $model->cashbankid = $_POST['Cashbankacc']['cashbankid'];
		  $model->accountid = $_POST['Cashbankacc']['accountid'];
		  $model->debit = $_POST['Cashbankacc']['debit'];
		  $model->credit = $_POST['Cashbankacc']['credit'];
		  $model->currencyid = $_POST['Cashbankacc']['currencyid'];
		  $model->currencyrate = $_POST['Cashbankacc']['currencyrate'];
		  $model->description = $_POST['Cashbankacc']['description'];
		}
		else
		{
		  $model = new Cashbankacc();
		  $model->attributes=$_POST['Cashbankacc'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Cashbankacc']['cashbankaccid']);
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
				$sql = 'call ApproveCashbankIn(:vid, :vlastupdateby)';
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
	
	public function actionDeletecashbankacc()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Cashbankacc::model()->findbyPK($ids);
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
		$model=new Cashbank('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cashbank']))
			$model->attributes=$_GET['Cashbank'];
		if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}

		$this->render('index',array(
			'model'=>$model,
				  'cashbankacc'=>$this->cashbankacc
		));
	}
	
	public function actionIndexcashbankacc()
	{
		$this->lookupdata();
	  $this->renderPartial('indexcashbankacc',
		array('cashbankacc'=>$this->cashbankacc));
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
	   $sql = "select a.cashbankapid,a.fullname, a.oldnik, b.levelorgname, c.structurename,d.positionname,e.cashbankaptypename,
        f.sexname,joindate,email,phoneno,alternateemail,hpno,a.addressbookid,a.accountno,a.taxno,g.maritalstatusname,
        h.religionname,a.birthdate,i.cityname
      from cashbankap a
      left join levelorg b on b.levelorgid = a.levelorgid
      left join orgstructure c on c.orgstructureid = a.orgstructureid
      left join position d on d.positionid = a.positionid
      left join cashbankaptype e on e.cashbankaptypeid = a.cashbankaptypeid
      left join sex f on f.sexid = a.sexid
      left join maritalstatus g on g.maritalstatusid = a.maritalstatusid
      left join religion h on h.religionid = a.religionid
      left join city i on i.cityid = a.birthcityid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.cashbankapid = ".$_GET['id'];
		}
		$sql = $sql . " order by cashbankapid";
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Cashbankar List';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    foreach($dataReader as $row)
    {
      if (file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/cashbankap/photo-'.$row['oldnik'].'.jpg'))
      {
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/cashbankap/photo-'. $row['oldnik'] .'.jpg',10,30,30);
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
        from cashbankapeducation a
        left join education b on b.educationid = a.educationid
        left join city c on c.cityid = a.cityid
        where cashbankapid = ".$row['cashbankapid'];
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
        from cashbankapinformal a
        where cashbankapid = ".$row['cashbankapid']." and iswo=0";
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
        from cashbankapinformal a
        where cashbankapid = ".$row['cashbankapid']." and iswo=1";
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
        from cashbankapfamily a
        left join familyrelation b on b.familyrelationid = a.familyrelationid
        left join city c on c.cityid = a.cityid
        left join sex d on d.sexid = a.sexid
        left join education e on e.educationid = a.educationid
        left join occupation f on f.occupationid = a.occupationid
        where cashbankapid = ".$row['cashbankapid'];
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
        from cashbankapidentity a
        left join identitytype b on b.identitytypeid = a.identitytypeid
        where a.cashbankapid = ".$row['cashbankapid'];
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
        from cashbankapforeignlanguage a
        left join language b on b.languageid = a.languageid
        left join languagevalue c on c.languagevalueid = a.languagevalueid
        where a.cashbankapid = ".$row['cashbankapid'];
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
		$model=Cashbank::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeldetailcashbankacc($id)
	{
		$model=Cashbankacc::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cashbankap-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='cashbankapservice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
