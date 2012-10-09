<?php

class AccounttypeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname = 'accounttype';

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

    public $parentaccounttype;

    public function lookupdata()
	{
	  $this->parentaccounttype=new Accounttype('searchwstatus');
	  $this->parentaccounttype->unsetAttributes();  // clear any default values
	  if(isset($_GET['Accounttype']))
		$this->parentaccounttype->attributes=$_GET['Accounttype'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		parent::actionCreate();
        $this->lookupdata();
		$model=new Accounttype;
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
                    'parentaccounttype'=>$this->parentaccounttype), true)
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
			  'accounttypeid'=>$model->accounttypeid,
			  'accounttypename'=>$model->accounttypename,
              'parentaccounttypeid'=>$model->parentaccounttypeid,
              'parentaccounttypename'=>($model->parentaccounttype!==null)?$model->parentaccounttype->accounttypename:"",
			  'recordstatus'=>$model->recordstatus,
			  'div'=>$this->renderPartial('_form', array('model'=>$model,
                    'parentaccounttype'=>$this->parentaccounttype), true)
			  ));
		  Yii::app()->end();
        }
	  }
	}

        public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Accounttype'], $_POST['Accounttype']['accounttypeid']);
    }

	public function actionWrite()
	{
		parent::actionWrite();
	  if(isset($_POST['Accounttype']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Accounttype']['accounttypename'],'emptyaccounttypename','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Accounttype'];
		if ((int)$_POST['Accounttype']['accounttypeid'] > 0)
		{
		  $model=$this->loadModel($_POST['Accounttype']['accounttypeid']);
		  $model->accounttypename = $_POST['Accounttype']['accounttypename'];
		  $model->parentaccounttypeid = $_POST['Accounttype']['parentaccounttypeid'];
		  $model->recordstatus = $_POST['Accounttype']['recordstatus'];
		}
		else
		{
		  $model = new Accounttype();
		  $model->attributes=$_POST['Accounttype'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Accounttype']['accounttypeid']);
              $this->GetSMessage('hrmbtinsertsuccess');
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
	  $model=new Accounttype('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Accounttype']))
		  $model->attributes=$_GET['Accounttype'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		  'model'=>$model,
                    'parentaccounttype'=>$this->parentaccounttype
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
			  $model=Accounttype::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Accounttype();
			  }
			  $model->accounttypeid = (int)$data[0];
			  $model->accounttypename = $data[1];
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
	  $sql = "select SELECT a.accounttypeid,a.accounttypename,b.accounttypename as parentaccounttypename,a.recordstatus
FROM accounttype a
left join accounttype b on b.accounttypeid = a.parentaccounttypeid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.accounttypeid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Account Type List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C'));
		$this->pdf->setwidths(array(60,60,40,40));
		$this->pdf->Row(array('Account Type','Parent Account Name'));
		$this->pdf->setaligns(array('L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['accounttypename'],$row1['parentaccounttypename']));
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
		$model=Accounttype::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Accounttype-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
