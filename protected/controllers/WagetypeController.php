<?php

class WagetypeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	protected $menuname = 'wagetype';

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
		$model=new Wagetype;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model), true)
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
		$id=$_POST['id'];
	  $model=$this->loadModel($id[0]);

	  //$this->performAjaxValidation($model);

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'wagetypeid'=>$model->wagetypeid,
				'wagename'=>$model->wagename,
                'ispph'=>$model->ispph,
                'ispayroll'=>$model->ispayroll,
                'isprint'=>$model->isprint,
                'percentage'=>$model->percentage,
                'maxvalue'=>$model->maxvalue,
                'currencyid'=>$model->currencyid,
                'currencyname'=>$model->currency->currencyname,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)
				));
            Yii::app()->end();
        }
        else
		{
		$this->render('update',array(
			'model'=>$model,
		));
		}
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Wagetype'], $_POST['Wagetype']['wagetypeid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Wagetype']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Wagetype']['wagename'],'emptywagetypename','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Wagetype']['wagetypeid'] > 0)
		{
		  $model=$this->loadModel($_POST['Wagetype']['wagetypeid']);
		  $model->wagename = $_POST['Wagetype']['wagename'];
		  $model->ispph = $_POST['Wagetype']['ispph'];
		  $model->ispayroll = $_POST['Wagetype']['ispayroll'];
		  $model->isprint = $_POST['Wagetype']['isprint'];
		  $model->percentage = $_POST['Wagetype']['percentage'];
		  $model->maxvalue = $_POST['Wagetype']['maxvalue'];
		  $model->currencyid = $_POST['Wagetype']['currencyid'];
		  $model->recordstatus = $_POST['Wagetype']['recordstatus'];
		}
		else
		{
		  $model = new Wagetype();
		  $model->attributes=$_POST['Wagetype'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Wagetype']['wagetypeid']);
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
			  $model=Wagetype::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Wagetype();
			  }
			  $model->wagetypeid = (int)$data[0];
			  $model->wagename = $data[1];
			  $model->ispph = $data[2];
			  $model->ispayroll = $data[3];
			  $model->isprint = $data[4];
			  $model->percentage = $data[5];
			  $model->maxvalue = $data[6];
              $currency = Currency::model()->findbyattributes(array('currencyname'=>$data[7]));
              if ($currency != null) 
              {
                $model->currencyid = $currency->currencyid;
              }
			  $model->recordstatus = (int)$data[8];
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
     $sql = "select a.wagename,a.percentage
      from wagetype a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.wagetypeid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->title='Benefit Type List';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    $this->pdf->setaligns(array('C','C','C','C'));
    $this->pdf->setwidths(array(90,40));
    $this->pdf->Row(array('Wage Type','Percentage'));
    $this->pdf->setaligns(array('L','L','L'));
    foreach($dataReader as $row1)
    {
      $this->pdf->row(array($row1['wagename'],$row1['percentage']));
    }
 
    // me-render ke browser
    $this->pdf->Output();
  }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
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
    $model=new Wagetype('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Wagetype']))
			$model->attributes=$_GET['Wagetype'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Wagetype::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='wagetype-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
