<?php

class AccountController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
 protected $menuname = 'account';
	public $parentaccount,$currency,$accounttype;
	
	public function lookupdata()
	{
	  $this->parentaccount=new Account('searchwstatus');
	  $this->parentaccount->unsetAttributes();  // clear any default values
	  if(isset($_GET['Parentaccount']))
		$this->parentaccount->attributes=$_GET['Parentaccount'];

	  $this->currency=new Currency('searchwstatus');
	  $this->currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$this->currency->attributes=$_GET['Currency'];

      $this->accounttype=new Accounttype('searchwstatus');
	  $this->accounttype->unsetAttributes();  // clear any default values
	  if(isset($_GET['Accounttype']))
		$this->accounttype->attributes=$_GET['Accounttype'];
	}

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
	  $this->lookupdata();
	  $model=new Account;
	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				'parentaccount'=>$this->parentaccount,
				'currency'=>$this->currency,
                  'accounttype'=>$this->accounttype), true)
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
			  'accountid'=>$model->accountid,
			  'accountname'=>$model->accountname,
			  'accountcode'=>$model->accountcode,
			  'parentaccountid'=>$model->parentaccountid,
			  'parentaccountname'=>($model->parentaccount!==null)?$model->parentaccount->accountcode:"",
			  'accounttypeid'=>$model->accounttypeid,
			  'accounttypename'=>($model->accounttype!==null)?$model->accounttype->accounttypename:"",
			  'currencyid'=>$model->currencyid,
			  'currencyname'=>$model->currency->currencyname,
			  'recordstatus'=>$model->recordstatus,
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
				'parentaccount'=>$this->parentaccount,
				'currency'=>$this->currency,
                  'accounttype'=>$this->accounttype), true)
			  ));
		  Yii::app()->end();
        }
	  }
	}

    public function actionCancelWrite()
    {
	  if(isset($_POST['Account']))
	  {
        if ((int)$_POST['Account']['accountid'] > 0)
        {
          $this->Deletelock($this->menuname,$_POST['Account']['accountid']);
          echo CJSON::encode(array(
                'status'=>'success',
				));
            Yii::app()->end();
        }
      }
    }

	public function actionWrite()
	{
	  if(isset($_POST['Account']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Account']['accountname'],'emptyaccountname','emptystring'),
                array($_POST['Account']['accountcode'],'emptyaccountcode','emptystring'),
                array($_POST['Account']['currencyid'],'emptycurrency','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Account'];
		if ((int)$_POST['Account']['accountid'] > 0)
		{
		  $model=$this->loadModel($_POST['Account']['accountid']);
		  $model->accountname = $_POST['Account']['accountname'];
		  $model->accountcode = $_POST['Account']['accountcode'];
		  $model->parentaccountid = $_POST['Account']['parentaccountid'];
		  $model->currencyid = $_POST['Account']['currencyid'];
		  $model->accounttypeid = $_POST['Account']['accounttypeid'];
		  $model->recordstatus = $_POST['Account']['recordstatus'];
		}
		else
		{
		  $model = new Account();
		  $model->attributes=$_POST['Account'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname,$_POST['Account']['accountid']);
              $this->GetSMessage('aaccinsertsuccess');
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
      parent::actionIndex();
	  $this->lookupdata();
	  $model=new Account('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		'model'=>$model,
				  'parentaccount'=>$this->parentaccount,
				  'currency'=>$this->currency,
                  'accounttype'=>$this->accounttype
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
			  $model=Account::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Account();
			  }
			  $model->accountid = (int)$data[0];
			  $model->accountcode = $data[1];
			  $model->accountname = $data[2];
			  if ($data[3] != '') {
				$model->parentaccountid = (int)$data[3];
			  } else {
				$model->parentaccountid = null;
			  }
			  if ($data[4] != '') {
                $accounttype = Accounttype::model()->findbysql("select * from accounttype where upper(accounttypename) = upper('".$data[4]."')");
                if ($accounttype != null) {
                  $model->accounttypeid = $accounttype->accounttypeid;
                } else {
                  $model->accounttypeid = null;
                }
			  } else {
				$model->accounttypeid = null;
			  }
			  if ($data[5] != '') {
                $currency = Currency::model()->findbysql("select * from currency where upper(currencyname) = upper('".$data[5]."')");
                if ($currency != null) {
                  $model->currencyid = $currency->currencyid;
                } else {
                  $model->currencyid = null;
                }
			  } else {
				$model->currencyid = null;
			  }
			  $model->recordstatus = $data[6];
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
     $sql = "select a.accountcode,a.accountname,b.accountcode as parentaccountcode,c.currencyname,
		d.accounttypename
				from account a
left join account b on b.accountid = a.parentaccountid
left join currency c on c.currencyid = a.currencyid
left join accounttype d on d.accounttypeid = a.accounttypeid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.accountid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Account List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C','C'));
		$this->pdf->setwidths(array(40,40,40,40,40));
		$this->pdf->Row(array('Account Code','Account Name','Parent Account Code','Currency','Account Type'));
		$this->pdf->setaligns(array('L','L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['accountcode'],$row1['accountname'],$row1['parentaccountcode']
		  ,$row1['currencyname'],$row1['accounttypename']));
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
		$model=Account::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
