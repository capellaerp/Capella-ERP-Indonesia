<?php

class PurchinforecController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'purchinforec';

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
	  $supplier=new Supplier('searchwstatus');
	  $supplier->unsetAttributes();  // clear any default values
	  if(isset($_GET['Supplier']))
		$supplier->attributes=$_GET['Supplier'];

		$product=new Product('searchwstatus');
	  $product->unsetAttributes();  // clear any default values
	  if(isset($_GET['Product']))
		$product->attributes=$_GET['Product'];

		$purchasinggroup=new Purchasinggroup('searchwstatus');
	  $purchasinggroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Purchasinggroup']))
		$purchasinggroup->attributes=$_GET['Purchasinggroup'];

      $currency=new Currency('searchwstatus');
	  $currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$currency->attributes=$_GET['Currency'];

		$model=new Purchinforec;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'supplier'=>$supplier,
				  'product'=>$product,
				  'purchasinggroup'=>$purchasinggroup,
                    'currency'=>$currency), true)
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
	  $supplier=new Supplier('searchwstatus');
	  $supplier->unsetAttributes();  // clear any default values
	  if(isset($_GET['Supplier']))
		$supplier->attributes=$_GET['Supplier'];

		$product=new Product('searchwstatus');
	  $product->unsetAttributes();  // clear any default values
	  if(isset($_GET['Product']))
		$product->attributes=$_GET['Product'];

		$purchasinggroup=new Purchasinggroup('searchwstatus');
	  $purchasinggroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Purchasinggroup']))
		$purchasinggroup->attributes=$_GET['Purchasinggroup'];

      $currency=new Currency('searchwstatus');
	  $currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$currency->attributes=$_GET['Currency'];

		$id=$_POST['id'];
	  $model=$this->loadModel($id[0]);
if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'purchinforecid'=>$model->purchinforecid,
				'addressbookid'=>$model->addressbookid,
				'suppliername'=>($model->addressbook!==null)?$model->addressbook->fullname:"",
				'productid'=>$model->productid,
				'productname'=>($model->product!==null)?$model->product->productname:"",
				'deliverytime'=>$model->deliverytime,
				'purchasinggroupid'=>$model->purchasinggroupid,
				'purchasinggroupcode'=>($model->purchasinggroup!==null)?$model->purchasinggroup->purchasinggroupcode:"",
				'currencyid'=>$model->currencyid,
				'currencyname'=>($model->currency!==null)?$model->currency->currencyname:"",
				'underdelvtol'=>$model->underdelvtol,
				'overdelvtol'=>$model->overdelvtol,
                'biddate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->biddate)),
                'div'=>$this->renderPartial('_form', array('model'=>$model,
				  'supplier'=>$supplier,
				  'product'=>$product,
				  'purchasinggroup'=>$purchasinggroup,
                    'currency'=>$currency), true)
				));
            Yii::app()->end();
        }
        }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Purchinforec'], $_POST['Purchinforec']['purchinforecid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Purchinforec']))
	  {
         $messages = $this->ValidateData(
                array(array($_POST['Purchinforec']['addressbookid'],'ppiremptyaddressbookid','emptystring'),
            array($_POST['Purchinforec']['productid'],'ppiremptyproductid','emptystring'),
            )
        );
        if ($messages == '') {
		if ((int)$_POST['Purchinforec']['purchinforecid'] > 0)
		{
		  $model=$this->loadModel($_POST['Purchinforec']['purchinforecid']);
		  $model->addressbookid = $_POST['Purchinforec']['addressbookid'];
		  $model->productid = $_POST['Purchinforec']['productid'];
		  $model->deliverytime = $_POST['Purchinforec']['deliverytime'];
		  $model->purchasinggroupid = $_POST['Purchinforec']['purchasinggroupid'];
		  $model->underdelvtol = $_POST['Purchinforec']['underdelvtol'];
		  $model->overdelvtol = $_POST['Purchinforec']['overdelvtol'];
		  $model->price = $_POST['Purchinforec']['price'];
		  $model->currencyid = $_POST['Purchinforec']['currencyid'];
		  $model->biddate = $_POST['Purchinforec']['biddate'];
		}
		else
		{
		  $model = new Purchinforec();
		  $model->attributes=$_POST['Purchinforec'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Purchinforec']['purchinforecid']);
              $this->GetSMessage('ppirinsertsuccess');
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
	  $supplier=new Supplier('searchwstatus');
	  $supplier->unsetAttributes();  // clear any default values
	  if(isset($_GET['Supplier']))
		$supplier->attributes=$_GET['Supplier'];

		$product=new Product('searchwstatus');
	  $product->unsetAttributes();  // clear any default values
	  if(isset($_GET['Product']))
		$product->attributes=$_GET['Product'];

		$purchasinggroup=new Purchasinggroup('searchwstatus');
	  $purchasinggroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Purchasinggroup']))
		$purchasinggroup->attributes=$_GET['Purchasinggroup'];

      $currency=new Currency('searchwstatus');
	  $currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$currency->attributes=$_GET['Currency'];

		$model=new Purchinforec('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Purchinforec']))
			$model->attributes=$_GET['Purchinforec'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
				  'supplier'=>$supplier,
				  'product'=>$product,
				  'purchasinggroup'=>$purchasinggroup,
            'currency'=>$currency
		));
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
			  $model=Purchinforec::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Purchinforec();
			  }
			  $model->purchinforecid = (int)$data[0];
			  $model->addressbookid = (int)$data[1];
			  $model->productid = (int)$data[2];
			  $model->materialgroupid = (int)$data[3];
			  $model->deliverytime = (int)$data[5];
			  $model->purchasinggroupid = (int)$data[6];
			  $model->underdelvtol = $data[7];
			  $model->overdelvtol = $data[8];
			  $model->recordstatus = (int)$data[9];
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
    $sql = "select b.fullname, e.productname,a.deliverytime,c.purchasinggroupcode,
      a.underdelvtol,a.overdelvtol,a.price,d.currencyname,a.biddate
      from purchinforec a
      left join addressbook b on b.addressbookid = a.addressbookid
      left join purchasinggroup c on c.purchasinggroupid = a.purchasinggroupid
      left join currency d on d.currencyid = a.currencyid
      left join product e on e.productid = a.productid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.purchinforecid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

	  $this->pdf->title='Purchasing Info Record List';
	  $this->pdf->AddPage('L');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);
    $this->pdf->setaligns(array('C','C','C','C','C','C','C','C','C'));
    $this->pdf->setwidths(array(50,30,30,30,30,30,30,20,20));
    $this->pdf->Row(array('Supplier','Product','Delivery Time','Purchasing Group',
        'Under Tol','Over Tol','Price','Currency','Bid Date'));
    $this->pdf->setaligns(array('L','L','L','L','L','L','L'));
    foreach($dataReader as $row1)
    {
      $this->pdf->row(array($row1['fullname'],$row1['productname'],$row1['deliverytime'],
          $row1['purchasinggroupcode'],$row1['underdelvtol'],
          $row1['overdelvtol'],$row1['price'],$row1['currencyname']
          ,$row1['biddate']));
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
		$model=Purchinforec::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='purchinforec-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
