<?php

class ReportsoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'reportso';

public function actionHelp()
	{
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $this->txt = '_help'; break;
				case 2 : $this->txt = '_helpmodif'; break;
				case 3 : $this->txt = '_helpdetail'; break;
				case 4 : $this->txt = '_helpdetailmodif'; break;
			}
		}
		parent::actionHelp();
	}

	public $sodetail;
		
	public function lookupdata()
	{
		$this->sodetail=new Sodetail('search');
	  $this->sodetail->unsetAttributes();  // clear any default values
	  if(isset($_GET['Sodetail']))
		$this->sodetail->attributes=$_GET['Sodetail'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            parent::actionCreate();
			$this->lookupdata();
		$model=new Soheader;
		$model->recordstatus=Wfgroup::model()->findstatusbyuser('insso');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (Yii::app()->request->isAjaxRequest)
        {
			if ($model->save()) {
			  echo CJSON::encode(array(
				  'status'=>'success',
				  'soheaderid'=>$model->soheaderid,
				  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'sodetail'=>$this->sodetail), true)
				  ));
			  Yii::app()->end();
			}
        }
	}

	public function actionCreatedetail()
	{
		$sodetail=new Sodetail;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                				  'currencyid'=>Company::model()->getcurrencyid(),
				  'currencyname'=>Company::model()->getcurrencyname(),
                'divcreate'=>$this->renderPartial('_formdetail',
				  array('model'=>$sodetail), true)
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
				'soheaderid'=>$model->soheaderid,
				'sodate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->sodate)),
				'addressbookid'=>$model->addressbookid,
				'fullname'=>($model->customer!==null)?$model->customer->fullname:"",
				'paymentmethodid'=>$model->paymentmethodid,
				'paycode'=>($model->paymentmethod!==null)?$model->paymentmethod->paycode:"",
				'headernote'=>$model->headernote,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
			'sodetail'=>$this->sodetail), true)
				));
            Yii::app()->end();
        }
      }
	}

	public function actionUpdatedetail()
	{
		$id=$_POST['id'];
	  $sodetail=$this->loadModeldetail($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'sodetailid'=>$sodetail->sodetailid,
				'productid'=>$sodetail->productid,
				'productname'=>($sodetail->product!==null)?$sodetail->product->productname:"",
				'qty'=>$sodetail->qty,
				'giqty'=>$sodetail->giqty,
				'unitofmeasureid'=>$sodetail->unitofmeasureid,
				'uomcode'=>($sodetail->unitofmeasure!==null)?$sodetail->unitofmeasure->uomcode:"",
				'price'=>$sodetail->price,
				'currencyid'=>$sodetail->currencyid,
				'currencyname'=>($sodetail->currency!==null)?$sodetail->currency->currencyname:"",
				'currencyrate'=>$sodetail->currencyrate,
				'slocid'=>$sodetail->slocid,
				'description'=>($sodetail->sloc!==null)?$sodetail->sloc->description:"",
				'taxid'=>$sodetail->taxid,
				'taxcode'=>($sodetail->tax!==null)?$sodetail->tax->taxcode:"",
				'itemnote'=>$sodetail->itemnote,
                'gidetailid'=>$sodetail->gidetailid,
                'prno'=>($sodetail->gidetail!==null)?(($sodetail->gidetail->prheader!==null)?$sodetail->gidetail->prheader->prno:""):"",
                'divcreate'=>$this->renderPartial('_formdetail',
				  array('model'=>$sodetail), true)
				));
            Yii::app()->end();
        }
	}

    public function actionCancelWrite()
    {
      $model = Soheader::model()->findbypk($_POST['Soheader']['soheaderid']);
      if ($model != null)
      {
        $model->Delete();
      }
      $this->DeleteLockCloseForm($this->menuname, $_POST['Soheader'], $_POST['Soheader']['soheaderid']);
    }

	public function actionWrite()
	{
            parent::actionWrite();
	  if(isset($_POST['Soheader']))
	  {
      $messages = $this->ValidateData(
                array(
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Soheader'];
		if ((int)$_POST['Soheader']['soheaderid'] > 0)
		{
		  $model=$this->loadModel($_POST['Soheader']['soheaderid']);
		  $model->addressbookid = $_POST['Soheader']['addressbookid'];
          $model->paymentmethodid = $_POST['Soheader']['paymentmethodid'];
		  $model->headernote = $_POST['Soheader']['headernote'];
		  $model->sodate = $_POST['Soheader']['sodate'];
		}
		else
		{
		  $model = new Soheader();
		  $model->attributes=$_POST['Soheader'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Soheader']['soheaderid']);
              $this->GetSMessage('mmpoinsertsuccess');
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

        public function actionGeneratedetail()
        {
            if(isset($_POST['productid']) & isset($_POST['supplierid']) & isset($_POST['prmaterialid']))
	  {
                $sodetail=Prmaterial::model()->findbysql('select * from prmaterial a inner join prheader b on b.prheaderid = a.prheaderid where prmaterialid = '.$_POST['prmaterialid'].
                        ' and productid = '.$_POST['productid'].
                        ' and qty > giqty '.
                        ' and b.prno is not null');
                $pirdetail=Purchinforec::model()->findbyattributes(array('addressbookid'=>$_POST['supplierid'],'productid'=>$_POST['productid']));

                echo CJSON::encode(array(
                'status'=>'success',
				'gidetailid'=>$sodetail->prmaterialid,
				'prno'=>($sodetail->prheader!==null)?$sodetail->prheader->prno:"",
				'productid'=>$sodetail->productid,
				'productname'=>($sodetail->product!==null)?$sodetail->product->productname:"",
				'giqty'=>($sodetail->qty - $sodetail->giqty),
				'unitofmeasureid'=>$sodetail->unitofmeasureid,
				'uomcode'=>($sodetail->unitofmeasure!==null)?$sodetail->unitofmeasure->uomcode:"",
				'slocid'=>$sodetail->prheader->slocid,
                    'itemtext'=>$sodetail->itemtext,
				//'description'=>($sodetail->prheader!==null)?$sodetail->prheader->sloc->description:"",
                    //'underdelvtol'=>($pirdetail!==null)?$pirdetail->underdelvtol:"",
                    //'overdelvtol'=>($pirdetail!==null)?$pirdetail->overdelvtol:""
					));
            Yii::app()->end();
            }
        }

	public function actionWritedetail()
	{
	  if(isset($_POST['Sodetail']))
	  {
        $messages = $this->ValidateData(
                array(
				
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Sodetail'];
		if ((int)$_POST['Sodetail']['sodetailid'] > 0)
		{
		  $model=Sodetail::model()->findbyPK($_POST['Sodetail']['sodetailid']);
		  $model->soheaderid = $_POST['Sodetail']['soheaderid'];
		  $model->productid = $_POST['Sodetail']['productid'];
		  $model->qty = $_POST['Sodetail']['qty'];
		  $model->unitofmeasureid = $_POST['Sodetail']['unitofmeasureid'];
		  $model->price = $_POST['Sodetail']['price'];
		  $model->currencyid = $_POST['Sodetail']['currencyid'];
		  $model->currencyrate = $_POST['Sodetail']['currencyrate'];
		  $model->slocid = $_POST['Sodetail']['slocid'];
		  $model->taxid = $_POST['Sodetail']['taxid'];
		  $model->itemnote = $_POST['Sodetail']['itemnote'];
		}
		else
		{
		  $model = new Sodetail();
		  $model->attributes=$_POST['Sodetail'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Sodetail']['sodetailid']);
              $this->GetSMessage('mmpoinsertsuccess');
            }
            else
            {
            print_r($model->getErrors());
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

	public function actionDeleteDetail()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Sodetail::model()->findbyPK($ids);
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
				$sql = 'call ApproveSO(:vid, :vlastupdateby)';
				$command=$connection->createCommand($sql);
				$command->bindvalue(':vid',$ids,PDO::PARAM_INT);
				$command->bindvalue(':vlastupdateby', $a,PDO::PARAM_STR);
				$command->execute();
				$transaction->commit();
				$this->GetSMessage('pprinsertsuccess');
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

		$model=new Soheader('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Soheader']))
			$model->attributes=$_GET['Soheader'];
			
			if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}

		$this->render('index',array(
			'model'=>$model,
			'sodetail'=>$this->sodetail,
		));
	}

	public function actionIndexDetail()
	{
	  		$sodetail=new Sodetail('searchbysoheaderid');
		$sodetail->unsetAttributes();  // clear any default values
		if(isset($_GET['Sodetail']))
			$sodetail->attributes=$_GET['Sodetail'];
if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
		$this->render('indexdetail',array(
			'sodetail'=>$sodetail
		));
	}
    
    public function actionDownload()
	{
	  parent::actionDownload();
	  $sql = "select b.fullname, a.pono, a.sodate,b.addressbookid,a.soheaderid,c.paymentname
      from soheader a
      left join addressbook b on b.addressbookid = a.addressbookid
      left join paymentmethod c on c.paymentmethodid = a.paymentmethodid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.soheaderid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

	  $this->pdf->title='Purchase Order';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    foreach($dataReader as $row)
    {
      $this->pdf->setFont('Arial','B',8);
      $this->pdf->text(100,30,'Purchase Order No ');$this->pdf->text(130,30,$row['pono']);
      $this->pdf->text(100,35,'PO Date ');$this->pdf->text(130,35,date(Yii::app()->params['dateviewfromdb'], strtotime($row['sodate'])));
      $this->pdf->text(100,40,'Payment ');$this->pdf->text(130,40,$row['paymentname']);

      $sql1 = "select b.addresstypename, a.addressname, c.cityname, a.phoneno
        from address a
        left join addresstype b on b.addresstypeid = a.addresstypeid
        left join city c on c.cityid = a.cityid
        where addressbookid = ".$row['addressbookid'].
        " order by addressid ".
        " limit 1";
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      foreach($dataReader1 as $row1)
      {
        $this->pdf->setFont('Arial','B',6);
        $this->pdf->Rect(5,25,60,25);
        $this->pdf->text(10,30,'Vendor');
        $this->pdf->setFont('Arial','',6);
        $this->pdf->text(10,35,'Name');$this->pdf->text(20,35,': '.$row['fullname']);
        $this->pdf->text(10,40,'Address');$this->pdf->text(20,40,': '.$row1['addressname']);
        $this->pdf->text(10,45,'Phone');$this->pdf->text(20,45,': '.$row1['phoneno']);
      }

      $sql1 = "select a.soheaderid,c.uomcode,a.giqty,a.delvdate,a.price,(giqty * price) as total,b.productname,
        d.symbol,d.i18n,e.taxvalue
        from sodetail a
        left join product b on b.productid = a.productid
        left join unitofmeasure c on c.unitofmeasureid = a.unitofmeasureid
        left join currency d on d.currencyid = a.currencyid
        left join tax e on e.taxid = a.taxid
        where soheaderid = ".$row['soheaderid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $total = 0;
      $this->pdf->sety(55);
      $this->pdf->setFont('Arial','B',6);
      $this->pdf->setaligns(array('C','C','C','C','C'));
      $this->pdf->setwidths(array(20,20,80,30,30));
      $this->pdf->setFont('Arial','',6);
      $this->pdf->Row(array('Qty','Units','Description', 'Unit Price','Total'));
      $this->pdf->setaligns(array('C','C','L','R','R'));
      foreach($dataReader1 as $row1)
      {
        Yii::app()->setLanguage($row1['i18n']);
        $this->pdf->row(array($row1['giqty'],$row1['uomcode'],$row1['productname'],
            Yii::app()->numberFormatter->formatCurrency($row1['price'], $row1['symbol']),
            Yii::app()->numberFormatter->formatCurrency($row1['total'], $row1['symbol'])));
        $total = $row1['total'] + $total;
      }
      Yii::app()->setLanguage('en');
      
      $this->pdf->rect(160,$this->pdf->gety(),30,5);
      $this->pdf->text(132,$this->pdf->gety()+3,'Sub Total');
      $this->pdf->text(161,$this->pdf->gety()+3,Yii::app()->numberFormatter->formatCurrency($total, $row1['symbol']));
      $this->pdf->sety($this->pdf->gety()+5);
      $this->pdf->rect(160,$this->pdf->gety(),30,5);
      $this->pdf->text(132,$this->pdf->gety()+3,'Total');
      $this->pdf->text(161,$this->pdf->gety()+3,Yii::app()->numberFormatter->formatCurrency($total, $row1['symbol']));
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
		$model=Soheader::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeldetail($id)
	{
		$model=Sodetail::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='soheader-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
