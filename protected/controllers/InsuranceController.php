<?php

class InsuranceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
protected $menuname = 'insurance';

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

	public $insuranceaddress,$insurancecontact,$accpiutang;

		public function lookupdata()
	{
		$this->insuranceaddress=new Insuranceaddress('search');
	  $this->insuranceaddress->unsetAttributes();  // clear any default values
	  if(isset($_GET['Insuranceaddress']))
		$this->insuranceaddress->attributes=$_GET['Insuranceaddress'];

		$this->insurancecontact=new Insurancecontact('search');
	  $this->insurancecontact->unsetAttributes();  // clear any default values
	  if(isset($_GET['Insurancecontact']))
		$this->insurancecontact->attributes=$_GET['Insurancecontact'];

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
		$model=new Insurance;
		$model->fullname='insurancename';
		$model->isinsurance=1;
		$model->recordstatus=0;
		if (Yii::app()->request->isAjaxRequest)
        {
        if ($model->save()) {
            echo CJSON::encode(array(
                'status'=>'success',
                'addressbookid'=>$model->addressbookid,
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
                'insuranceaddress'=>$this->insuranceaddress,
                'insurancecontact'=>$this->insurancecontact,
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

		$insuranceaddress=new Insuranceaddress;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formaddress',
				  array('model'=>$insuranceaddress), true)
				));
            Yii::app()->end();
        }
	}

	public function actionCreatecontact()
	{
		parent::actionCreate();
		$this->lookupdata();

		$insurancecontact=new Insurancecontact;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_formcontact',
				  array('model'=>$insurancecontact), true)
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
			  'recordstatus'=>$model->recordstatus,
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
			  'insuranceaddress'=>$this->insuranceaddress,
			  'insurancecontact'=>$this->insurancecontact,
                    'accpiutang'=>$this->accpiutang), true)
			  ));
		  Yii::app()->end();
        }
	  }
	}

	public function actionUpdateaddress()
	{
	  $id=$_POST['id'];
	  $insuranceaddress=$this->loadModeladdress($id[0]);

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addressid'=>$insuranceaddress->addressid,
			'addressbookid'=>$insuranceaddress->addressbookid,
			'fullname'=>($insuranceaddress->addressbook!==null)?$insuranceaddress->addressbook->fullname:"",
			'addresstypeid'=>$insuranceaddress->addresstypeid,
			'addresstypename'=>($insuranceaddress->addresstype!==null)?$insuranceaddress->addresstype->addresstypename:"",
			'addressname'=>$insuranceaddress->addressname,
			'rt'=>$insuranceaddress->rt,
			'rw'=>$insuranceaddress->rw,
			'cityid'=>$insuranceaddress->cityid,
			'cityname'=>$insuranceaddress->city->cityname,
			'kelurahanid'=>$insuranceaddress->kelurahanid,
			'kelurahanname'=>($insuranceaddress->kelurahan!==null)?$insuranceaddress->kelurahan->kelurahanname:"",
			'subdistrictid'=>$insuranceaddress->subdistrictid,
			'subdistrictname'=>($insuranceaddress->subdistrict!==null)?$insuranceaddress->subdistrict->subdistrictname:"",
              'phoneno'=>$insuranceaddress->phoneno,
			  'div'=>$this->renderPartial('_formaddress', array('model'=>$insuranceaddress), true)
			  ));
		  Yii::app()->end();
	  }
	}

	public function actionUpdatecontact()
	{
	  $id=$_POST['id'];
	  $insurancecontact=$this->loadModelcontact($id[0]);

	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'addresscontactid'=>$insurancecontact->addresscontactid,
			'addressbookid'=>$insurancecontact->addressbookid,
			'fullname'=>$insurancecontact->addressbook->fullname,
			'contacttypeid'=>$insurancecontact->contacttypeid,
			'contacttypename'=>$insurancecontact->contacttype->contacttypename,
			'addresscontactname'=>$insurancecontact->addresscontactname,
              'phoneno'=>$insurancecontact->phoneno,
              'mobilephone'=>$insurancecontact->mobilephone,
              'emailaddress'=>$insurancecontact->emailaddress,
			  'div'=>$this->renderPartial('_formcontact', array('model'=>$insurancecontact), true)
			  ));
		  Yii::app()->end();
	  }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Insurance'], $_POST['Insurance']['addressbookid']);
    }

	public function actionWrite()
	{
		parent::actionWrite();
	  if(isset($_POST['Insurance']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Insurance']['fullname'],'mmsemptyfullname','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Insurance']['addressbookid'] > 0)
		{
		  $model=$this->loadModel($_POST['Insurance']['addressbookid']);
		  $model->fullname = $_POST['Insurance']['fullname'];
		  $model->taxno = $_POST['Insurance']['taxno'];
		  $model->accpiutangid = $_POST['Insurance']['accpiutangid'];
		  $model->fullname = $_POST['Insurance']['fullname'];
		  $model->recordstatus = $_POST['Insurance']['recordstatus'];
		}
		else
		{
		  $model = new Insurance();
		  $model->isinsurance = 1;
		  $model->attributes=$_POST['Insurance'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Insurance']['addressbookid']);
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
	  if(isset($_POST['Insuranceaddress']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Insuranceaddress']['addresstypeid'],'mmpremptyaddresstypeid','emptystring'),
                array($_POST['Insuranceaddress']['addressname'],'mmpremptyaddressname','emptystring'),
                array($_POST['Insuranceaddress']['cityid'],'mmpremptycityid','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Insuranceaddress']['addressid'] > 0)
		{
		  $model=Insuranceaddress::model()->findbyPK($_POST['Insuranceaddress']['addressid']);
		  $model->addressbookid = $_POST['Insuranceaddress']['addressbookid'];
		  $model->addresstypeid = $_POST['Insuranceaddress']['addresstypeid'];
		  $model->addressname = $_POST['Insuranceaddress']['addressname'];
		  $model->rt = $_POST['Insuranceaddress']['rt'];
		  $model->rw = $_POST['Insuranceaddress']['rw'];
		  $model->cityid = $_POST['Insuranceaddress']['cityid'];
		  $model->kelurahanid = $_POST['Insuranceaddress']['kelurahanid'];
		  $model->subdistrictid = $_POST['Insuranceaddress']['subdistrictid'];
		  $model->phoneno = $_POST['Insuranceaddress']['phoneno'];
		}
		else
		{
		  $model = new Insuranceaddress();
		  $model->attributes=$_POST['Insuranceaddress'];
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
	  if(isset($_POST['Insurancecontact']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Insurancecontact']['contacttypeid'],'mmpremptycontacttypeid','emptystring'),
                array($_POST['Insurancecontact']['addresscontactname'],'mmpremptyaddresscontactname','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Insurancecontact']['addresscontactid'] > 0)
		{
		  $model=Insurancecontact::model()->findbyPK($_POST['Insurancecontact']['addresscontactid']);
		  $model->addressbookid = $_POST['Insurancecontact']['addressbookid'];
		  $model->contacttypeid = $_POST['Insurancecontact']['contacttypeid'];
		  $model->addresscontactname = $_POST['Insurancecontact']['addresscontactname'];
		  $model->phoneno = $_POST['Insurancecontact']['phoneno'];
		  $model->mobilephone = $_POST['Insurancecontact']['mobilephone'];
		  $model->emailaddress = $_POST['Insurancecontact']['emailaddress'];
		}
		else
		{
		  $model = new Insurancecontact();
		  $model->attributes=$_POST['Insurancecontact'];
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
		  $model=Insuranceaddress::model()->findbyPK($ids);
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
		  $model=Insurancecontact::model()->findbyPK($ids);
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
	  $model=new Insurance('searchwstatus');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Insurance']))
		  $model->attributes=$_GET['Insurance'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		  'model'=>$model,
		  'insuranceaddress'=>$this->insuranceaddress,
		  'insurancecontact'=>$this->insurancecontact,
                    'accpiutang'=>$this->accpiutang
	  ));
	}

	public function actionIndexaddress()
	{
		$this->lookupdata();
	  $this->renderPartial('indexaddress',
		array('insuranceaddress'=>$this->insuranceaddress));
	  Yii::app()->end();
	}

	public function actionIndexcontact()
	{
		$this->lookupdata();
	  $this->renderPartial('indexcontact',
		array('insurancecontact'=>$this->insurancecontact));
	  Yii::app()->end();
	}

	public function actionUpload()
	{
      parent::actionUpload();
	  Yii::import("ext.EAjaxUpload.qqFileUploader");
	  $folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';// folder for uploaded files
	  $allowedExtensions = array("csv");
	  $sizeLimit = (int)Yii::app()->params['sizeLimit'];// maximum file size in bytes
	  $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
	  $result = $uploader->handleUpload($folder,true);
	  $row = 0;
	  if (($handle = fopen($folder.$uploader->file->getName(), "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if ($row>0) {
			  $model=Insurance::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Insurance();
			  }
			  $model->addressbookid = (int)$data[0];
			  $model->fullname = $data[1];
			  $model->isinsurance = 1;
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
	  Yii::import('application.extensions.fpdf.*');
	  require_once("pdf.php");
	  $pdf = new PDF();
	  $pdf->title='Insurance List';
	  $pdf->AddPage('P');
	  $pdf->setFont('Arial','B',12);

	  // definisi font
	  $pdf->setFont('Arial','B',8);

	  // menuliskan tabel
	  $header = array('No','ID','Insurance Name');
	  $dataprovider=Insurance::model()->searchwstatus();
	  $dataprovider->pagination=false;
	  $data = $dataprovider->getData();
	  //var_dump(count($data));
	  $w= array(10,25,70);

	  $pdf->SetTableHeader();
	  //Header
	  for($i=0;$i<count($header);$i++)
		  $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
	  $pdf->Ln();
	  $pdf->SetTableData();
	  //Data
	  $fill=false;
	  $i=0;
	  foreach($data as $datas)
	  {
		  $i=$i+1;
		  $pdf->Cell($w[0],6,$i,'LR',0,'L',$fill);
		  $pdf->Cell($w[1],6,$datas['addressbookid'],'LR',0,'L',$fill);
		  $pdf->Cell($w[2],6,$datas['fullname'],'LR',0,'L',$fill);
		  $pdf->Ln();
		  $fill=!$fill;
	  }
	  $pdf->Cell(array_sum($w),0,'','T');


	  // me-render ke browser
	  $pdf->Output('insurance.pdf','D');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Insurance::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeladdress($id)
	{
		$model=Insuranceaddress::model()->findByPk((int)$id);
		//if($model===null)
		//	throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelcontact($id)
	{
		$model=Insurancecontact::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Insurance-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
