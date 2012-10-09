<?php

class CompanyController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'company';

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

        public $currency,$city;

	public function lookupdata()
	{
	  $this->currency=new Currency('searchwstatus');
	  $this->currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$this->currency->attributes=$_GET['Currency'];
	  $this->city=new City('searchwstatus');
	  $this->city->unsetAttributes();  // clear any default values
	  if(isset($_GET['City']))
		$this->city->attributes=$_GET['City'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
      parent::actionCreate();
      $this->lookupdata();
      $model=new Company;

      if (Yii::app()->request->isAjaxRequest)
      {
          echo CJSON::encode(array(
              'status'=>'success',
              'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
                  'currency'=>$this->currency,
				  'city'=>$this->city), true)
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
				'companyid'=>$model->companyid,
				'companyname'=>$model->companyname,
				'address'=>$model->address,
                'cityid'=>$model->cityid,
                'cityname'=>($model->city!==null)?$model->city->cityname:"",
				'zipcode'=>$model->zipcode,
				'taxno'=>$model->taxno,
                'currencyid'=>$model->currencyid,
                'currencyname'=>($model->currency!==null)?$model->currency->currencyname:"",
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
                    'currency'=>$this->currency,
				  'city'=>$this->city), true)
				));
            Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Company'], $_POST['Company']['companyid']);
    }

	public function actionWrite()
	{
      parent::actionWrite();
	  if(isset($_POST['Company']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Company']['companyname'],'emptycompanyname','emptystring'),
            array($_POST['Company']['address'],'emptyaddressname','emptystring'),
            array($_POST['Company']['cityid'],'emptycityname','emptystring'),
            array($_POST['Company']['zipcode'],'emptyzipcode','emptystring'),
            array($_POST['Company']['currencyid'],'emptycurrency','emptystring'),
            )
        );
        if ($messages == '') {
          if ((int)$_POST['Company']['companyid'] > 0)
          {
            $model=$this->loadModel($_POST['Company']['companyid']);
            $model->companyname = $_POST['Company']['companyname'];
            $model->address = $_POST['Company']['address'];
            $model->cityid = $_POST['Company']['cityid'];
            $model->zipcode = $_POST['Company']['zipcode'];
            $model->taxno = $_POST['Company']['taxno'];
            $model->currencyid = $_POST['Company']['currencyid'];
            $model->recordstatus = $_POST['Company']['recordstatus'];
          }
          else
          {
            $model = new Company();
            $model->attributes=$_POST['Company'];
          }
          try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Company']['companyid']);
              $this->GetSMessage('scoinsertsuccess');
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
    $model=new Company('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
                    'currency'=>$this->currency,
				  'city'=>$this->city
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
		$sql = "SELECT c.*,d.currencyname, e.cityname
FROM company c
left join currency d on d.currencyid = c.currencyid
left join city e on e.cityid = c.cityid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.companyid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		
		$this->pdf->title='Company List';
		$this->pdf->AddPage('P');
		$this->pdf->setFont('Arial','B',12);

		// definisi font
		$this->pdf->setFont('Arial','B',8);

		$this->pdf->setaligns(array('C','C','C','C','C','C'));
		$this->pdf->setwidths(array(40,40,40,20,20,20));
		$this->pdf->Row(array('Company Name','Address','City','Zip Code','Tax No','Currency'));
		$this->pdf->setaligns(array('L','L','L','L','L','L'));
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['companyname'],$row1['address'],
		  $row1['cityname'],$row1['zipcode'],$row1['taxno'],$row1['currencyname']));
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
		$model=Company::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
