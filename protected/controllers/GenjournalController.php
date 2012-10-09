<?php

class GenjournalController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'genjournal';

	public function actionHelp()
	{
		$txt = '';
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $txt = '_help'; break;
				case 2 : $txt = '_helpmodif'; break;
				case 3 : $txt = '_helpdetail'; break;
				case 4 : $txt = '_helpdetailmodif'; break;
			}
		}
		parent::actionHelp($txt);
	}
	
	public $journaldetail;
	

	public function lookupdata()
	{
	  $this->journaldetail=new Journaldetail('search');
	  $this->journaldetail->unsetAttributes();  // clear any default values
	  if(isset($_GET['Journaldetail']))
		$this->journaldetail->attributes=$_GET['Journaldetail'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
	  $this->lookupdata();
	  $model=new Genjournal;
	  $model->journaldate=new CDbExpression('NOW()');
	  $model->postdate=new CDbExpression('NOW()');
	  $model->recordstatus=Wfgroup::model()->findstatusbyuser('insjournal');
	  if (Yii::app()->request->isAjaxRequest)
	  {
		  if ($model->save()) {
			echo CJSON::encode(array(
				'status'=>'success',
				'genjournalid'=>$model->genjournalid,
				'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'journaldetail'=>$this->journaldetail), true)
				));
			Yii::app()->end();
		  }
	  }
	}

	public function actionCreatedetail()
	{
	  $journaldetail=new Journaldetail;
	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'divcreate'=>$this->renderPartial('_formdetail',
				array('model'=>$journaldetail), true)
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
				'genjournalid'=>$model->genjournalid,
				'referenceno'=>$model->referenceno,
				'journaldate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->journaldate)),
				'journalnote'=>$model->journalnote,
				'postdate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->postdate)),
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
				  'journaldetail'=>$this->journaldetail), true)
				));
            Yii::app()->end();
        }
        }
	}

	public function actionUpdatedetail()
	{
		$id=$_POST['id'];
	  $journaldetail=$this->loadModeldetail($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'journaldetailid'=>$journaldetail->journaldetailid,
				'accountid'=>$journaldetail->accountid,
				'accountcode'=>($journaldetail->account!==null)?$journaldetail->account->accountcode:"",
				'accountname'=>($journaldetail->account!==null)?$journaldetail->account->accountname:"",
				'debit'=>$journaldetail->debit,
				'credit'=>$journaldetail->credit,
				'ratevalue'=>$journaldetail->ratevalue,
				'currencyid'=>$journaldetail->currencyid,
				'currencyname'=>($journaldetail->currency!==null)?$journaldetail->currency->currencyname:"",
				'detailnote'=>$journaldetail->detailnote,
                'div'=>$this->renderPartial('_formdetail',
				  array('model'=>$journaldetail), true)
				));
            Yii::app()->end();
        }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Genjournal'], $_POST['Genjournal']['genjournalid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Genjournal']))
	  {
        $messages = $this->ValidateData(
                array(
                array($_POST['Genjournal']['journaldate'],'agjemptyjournaldate','emptystring'),
                array($_POST['Genjournal']['postdate'],'agjemptypostdate','emptystring'),
                array($_POST['Genjournal']['journalnote'],'agjemptyjournalnote','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Genjournal'];
		if ((int)$_POST['Genjournal']['genjournalid'] > 0)
		{
		  $model=$this->loadModel($_POST['Genjournal']['genjournalid']);
		  $model->journaldate = $_POST['Genjournal']['journaldate'];
		  $model->journalnote = $_POST['Genjournal']['journalnote'];
		  $model->postdate = $_POST['Genjournal']['postdate'];
		  $model->referenceno = $_POST['Genjournal']['referenceno'];
		}
		else
		{
		  $model = new Genjournal();
		  $model->attributes=$_POST['Genjournal'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Genjournal']['genjournalid']);
              $this->GetSMessage('agjinsertsuccess');
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

	public function actionWritedetail()
	{
	  if(isset($_POST['Journaldetail']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Journaldetail']['accountid'],'agjemptyaccount','emptystring'),
                array($_POST['Journaldetail']['debit'],'agjemptydebit','emptystring'),
                array($_POST['Journaldetail']['credit'],'agjemptycredit','emptystring'),
                array($_POST['Journaldetail']['currencyid'],'agjemptycurrency','emptystring'),
            )
        );
        if ($messages == '') {
          //$dataku->attributes=$_POST['Journaldetail'];
          if ((int)$_POST['Journaldetail']['journaldetailid'] > 0)
          {
            $model=Journaldetail::model()->findbyPK($_POST['Journaldetail']['journaldetailid']);
            $model->genjournalid = $_POST['Journaldetail']['genjournalid'];
            $model->accountid = $_POST['Journaldetail']['accountid'];
            $model->debit = $_POST['Journaldetail']['debit'];
            $model->credit = $_POST['Journaldetail']['credit'];
            $model->currencyid = $_POST['Journaldetail']['currencyid'];
            $model->ratevalue = $_POST['Journaldetail']['ratevalue'];
            $model->detailnote = $_POST['Journaldetail']['detailnote'];
          }
          else
          {
            $model = new Journaldetail();
            $model->attributes=$_POST['Journaldetail'];
          }
          try
          {
            if($model->save())
            {
              $this->GetSMessage('agjinsertsuccess');
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
	public function actionDeletedetail()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Journaldetail::model()->findbyPK($ids);
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}

	public function actionApprove()
	{
	  parent::actionApprove();
      $id=$_POST['id'];
      foreach($id as $ids)
      {
        //$model=$this->loadModel($ids);
        $a = Yii::app()->user->name;
        $connection=Yii::app()->db;
        $transaction=$connection->beginTransaction();
        try
        {
          $sql = 'call ApproveJournal(:vid, :vlastupdateby)';
          $command=$connection->createCommand($sql);
          $command->bindValue(':vid',$ids,PDO::PARAM_INT);
          $command->bindValue(':vlastupdateby', $a,PDO::PARAM_STR);
          $command->execute();
          $transaction->commit();
          $this->GetSMessage('agjinsertsuccess');
        }
        catch(Exception $e) // an exception is raised if a query fails
        {
            $transaction->rollBack();
            $this->GetMessage($e->getMessage());
        }
      }
      Yii::app()->end();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	  parent::actionIndex();
	  $this->lookupdata();
		$model=new Genjournal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Genjournal']))
			$model->attributes=$_GET['Genjournal'];
		if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}

		$this->render('index',array(
			'model'=>$model,
			'journaldetail'=>$this->journaldetail
		));
	}

	public function actionIndexdetail()
	{
	  $this->lookupdata();
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->renderPartial('indexdetail',
		array('journaldetail'=>$this->journaldetail));
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
        if ($data[0] != '')
        {
          $model = new Genjournal();
          $model->journaldate = $data[0];
          $model->postdate = $data[0];
          $model->referenceno = $data[1];
          $model->recordstatus = Wfgroup::model()->findstatusbyuser('insgenjournal');
          $model->save();
          $oldid = $model->genjournalid;
        }
        if ($oldid != 0)
        {
        $detail = new Journaldetail();
        $detail->genjournalid = $oldid;
        $account = Account::model()->findbysql("select accountid from account where upper(accountcode) = '".$data[2]."'");
        if ($account != null)
        {
          $detail->accountid = $account->accountid;
        }
        if ($data[3] != '') 
        {
          $detail->debit = $data[3];
          $detail->credit = 0;
        }
        if ($data[4] != '')
        {
          $detail->debit = 0;
          $detail->credit = $data[4];
        }
        $currency = Currency::model()->findbysql("select currencyid from currency where upper(currencyname) = '".$data[5]."'");
        if ($currency != null)
        {
          $detail->currencyid = $currency->currencyid;
        }
        $detail->detailnote = $data[1];
        if(!$detail->save())
        {
          $this->messages = $this->messages . Catalogsys::model()->getcatalog(' upload error at '.$data[0]);
        }
      }
      }
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
    $pdf = new PDF();
    $pdf->title='Absence Schedule List';
    $pdf->AddPage('L');
    $pdf->setFont('Arial','B',12);

    // definisi font
    $pdf->setFont('Arial','B',8);

    // menuliskan tabel
    $header = array('No','ID','Schedule Name','Absence In','Absence Out', 'Status', 'Wage Name', 'Currency', 'Insentif');
    $model=new Absschedule('searchwstatus');
    $dataprovider=$model->searchwstatus();
    $dataprovider->pagination=false;
    $data = $dataprovider->getData();
    $cols = $dataprovider->getKeys();
    $dataku=array(count($data));
    //var_dump($dataku);
    $w= array(20,25,30,30,30,30,30,30,30);
    $pdf->SetTableHeader();
    //Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    $pdf->SetTableData();
    //Data
    $fill=false;
    foreach($data as $n=>$datas)
    {
        $pdf->Cell($w[0],6,$n,'LR',0,'C',$fill);
        $pdf->Cell($w[1],6,$datas['absscheduleid'],'LR',0,'C',$fill);
        $pdf->Cell($w[2],6,$datas['absschedulename'],'LR',0,'C',$fill);
        $pdf->Cell($w[3],6,$datas['absin'],'LR',0,'C',$fill);
        $pdf->Cell($w[4],6,$datas['absout'],'LR',0,'C',$fill);
        $pdf->Cell($w[5],6,Absstatus::model()->findByPk($datas['absstatusid'])->shortstat,'LR',0,'C',$fill);
        $pdf->Cell($w[6],6,Wagetype::model()->findByPk($datas['wagetypeid'])->wagename,'LR',0,'C',$fill);
        $pdf->Cell($w[7],6,Currency::model()->findByPk($datas['currencyid'])->currencyname,'LR',0,'C',$fill);
        $pdf->Cell($w[8],6,number_format($datas['insentif']),'LR',0,'C',$fill);
        $pdf->Ln();
        $fill=!$fill;
    }
    $pdf->Cell(array_sum($w),0,'','T');


    // me-render ke browser
    $pdf->Output();
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Genjournal::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeldetail($id)
	{
		$model=Journaldetail::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='genjournal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='journaldetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
