<?php

class PoheaderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'poheader';

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

	public $podetail;
		
	public function lookupdata()
	{
		$this->podetail=new Podetail('search');
	  $this->podetail->unsetAttributes();  // clear any default values
	  if(isset($_GET['Podetail']))
		$this->podetail->attributes=$_GET['Podetail'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            parent::actionCreate();
			$this->lookupdata();
		$model=new Poheader;
		$model->recordstatus=Wfgroup::model()->findstatusbyuser('inspo');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (Yii::app()->request->isAjaxRequest)
        {
			if ($model->save()) {
			  echo CJSON::encode(array(
				  'status'=>'success',
				  'poheaderid'=>$model->poheaderid,
				  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				  'podetail'=>$this->podetail), true)
				  ));
			  Yii::app()->end();
			}
        }
	}

	public function actionCreatedetail()
	{
		$podetail=new Podetail;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'currencyid'=>Company::model()->getcurrencyid(),
				  'currencyname'=>Company::model()->getcurrencyname(),
                'divcreate'=>$this->renderPartial('_formdetail',
				  array('model'=>$podetail), true)
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
				'poheaderid'=>$model->poheaderid,
				'purchasinggroupid'=>$model->purchasinggroupid,
				'purchasinggroupcode'=>($model->purchasinggroup!==null)?$model->purchasinggroup->description:"",
				'docdate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->docdate)),
				'addressbookid'=>$model->addressbookid,
				'fullname'=>($model->supplier!==null)?$model->supplier->fullname:"",
				'paymentmethodid'=>$model->paymentmethodid,
				'paycode'=>($model->paymentmethod!==null)?$model->paymentmethod->paycode:"",
				'headernote'=>$model->headernote,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
			'podetail'=>$this->podetail), true)
				));
            Yii::app()->end();
        }
      }
	}

	public function actionUpdatedetail()
	{
		$id=$_POST['id'];
	  $podetail=$this->loadModeldetail($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'podetailid'=>$podetail->podetailid,
				'productid'=>$podetail->productid,
				'productname'=>($podetail->product!==null)?$podetail->product->productname:"",
				'poqty'=>$podetail->poqty,
				'unitofmeasureid'=>$podetail->unitofmeasureid,
				'uomcode'=>($podetail->unitofmeasure!==null)?$podetail->unitofmeasure->uomcode:"",
				'delvdate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($podetail->delvdate)),
				'netprice'=>$podetail->netprice,
				'currencyid'=>$podetail->currencyid,
				'currencyname'=>($podetail->currency!==null)?$podetail->currency->currencyname:"",
				'ratevalue'=>$podetail->ratevalue,
				'slocid'=>$podetail->slocid,
				'description'=>($podetail->sloc!==null)?$podetail->sloc->description:"",
				'taxid'=>$podetail->taxid,
				'taxcode'=>($podetail->tax!==null)?$podetail->tax->taxcode:"",
				'itemtext'=>$podetail->itemtext,
                'underdelvtol'=>$podetail->underdelvtol,
                'overdelvtol'=>$podetail->overdelvtol,
                'prdetailid'=>$podetail->prdetailid,
                'prno'=>($podetail->prdetail!==null)?(($podetail->prdetail->prheader!==null)?$podetail->prdetail->prheader->prno:""):"",
                'divcreate'=>$this->renderPartial('_formdetail',
				  array('model'=>$podetail), true)
				));
            Yii::app()->end();
        }
	}

    public function actionCancelWrite()
    {
		$this->DeleteLockCloseForm($this->menuname, $_POST['Poheader'], $_POST['Poheader']['poheaderid']);
    }

	public function actionWrite()
	{
            parent::actionWrite();
	  if(isset($_POST['Poheader']))
	  {
      $messages = $this->ValidateData(
                array(
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Poheader'];
		if ((int)$_POST['Poheader']['poheaderid'] > 0)
		{
		  $model=$this->loadModel($_POST['Poheader']['poheaderid']);
		  $model->purchasinggroupid = $_POST['Poheader']['purchasinggroupid'];
		  $model->addressbookid = $_POST['Poheader']['addressbookid'];
          $model->paymentmethodid = $_POST['Poheader']['paymentmethodid'];
		  $model->headernote = $_POST['Poheader']['headernote'];
		  $model->docdate = $_POST['Poheader']['docdate'];
		}
		else
		{
		  $model = new Poheader();
		  $model->attributes=$_POST['Poheader'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Poheader']['poheaderid']);
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
                $podetail=Prmaterial::model()->findbysql('select * from prmaterial a inner join prheader b on b.prheaderid = a.prheaderid where prmaterialid = '.$_POST['prmaterialid'].
                        ' and productid = '.$_POST['productid'].
                        ' and qty > poqty '.
                        ' and b.prno is not null');
                $pirdetail=Purchinforec::model()->findbyattributes(array('addressbookid'=>$_POST['supplierid'],'productid'=>$_POST['productid']));

                echo CJSON::encode(array(
                'status'=>'success',
				'prdetailid'=>$podetail->prmaterialid,
				'prno'=>($podetail->prheader!==null)?$podetail->prheader->prno:"",
				'productid'=>$podetail->productid,
				'productname'=>($podetail->product!==null)?$podetail->product->productname:"",
				'poqty'=>($podetail->qty - $podetail->poqty),
				'unitofmeasureid'=>$podetail->unitofmeasureid,
				'uomcode'=>($podetail->unitofmeasure!==null)?$podetail->unitofmeasure->uomcode:"",
				'slocid'=>$podetail->prheader->slocid,
                    'itemtext'=>$podetail->itemtext,
				//'description'=>($podetail->prheader!==null)?$podetail->prheader->sloc->description:"",
                    //'underdelvtol'=>($pirdetail!==null)?$pirdetail->underdelvtol:"",
                    //'overdelvtol'=>($pirdetail!==null)?$pirdetail->overdelvtol:""
					));
            Yii::app()->end();
            }
        }
		
		public function actionCancelWritedetail()
    {
		$this->DeleteLockCloseForm($this->menuname, $_POST['Podetail'], $_POST['Podetail']['podetailid']);
    }

	public function actionWritedetail()
	{
	  if(isset($_POST['Podetail']))
	  {
        $messages = $this->ValidateData(
                array(
				
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Podetail'];
		if ((int)$_POST['Podetail']['podetailid'] > 0)
		{
		  $model=Podetail::model()->findbyPK($_POST['Podetail']['podetailid']);
		  $model->poheaderid = $_POST['Podetail']['poheaderid'];
		  $model->productid = $_POST['Podetail']['productid'];
		  $model->poqty = $_POST['Podetail']['poqty'];
		  $model->unitofmeasureid = $_POST['Podetail']['unitofmeasureid'];
		  $model->delvdate = $_POST['Podetail']['delvdate'];
		  $model->netprice = $_POST['Podetail']['netprice'];
		  $model->currencyid = $_POST['Podetail']['currencyid'];
		  $model->slocid = $_POST['Podetail']['slocid'];
		  $model->taxid = $_POST['Podetail']['taxid'];
		  $model->itemtext = $_POST['Podetail']['itemtext'];
		  $model->ratevalue = $_POST['Podetail']['ratevalue'];
		  $model->underdelvtol = $_POST['Podetail']['underdelvtol'];
		  $model->prdetailid = $_POST['Podetail']['prdetailid'];
		  $model->overdelvtol = $_POST['Podetail']['overdelvtol'];
		}
		else
		{
		  $model = new Podetail();
		  $model->attributes=$_POST['Podetail'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Podetail']['podetailid']);
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
		  $model=Podetail::model()->findbyPK($ids);
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
				$sql = 'call ApprovePO(:vid, :vlastupdateby)';
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

		$model=new Poheader('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Poheader']))
			$model->attributes=$_GET['Poheader'];
			
			if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}

		$this->render('index',array(
			'model'=>$model,
			'podetail'=>$this->podetail,
		));
	}

	public function actionIndexDetail()
	{
	  		$podetail=new Podetail('searchbypoheaderid');
		$podetail->unsetAttributes();  // clear any default values
		if(isset($_GET['Podetail']))
			$podetail->attributes=$_GET['Podetail'];
if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
		$this->render('indexdetail',array(
			'podetail'=>$podetail
		));
	}
    
    public function actionDownload()
	{
	  parent::actionDownload();
	  $sql = "select b.fullname, a.pono, a.docdate,b.addressbookid,a.poheaderid,c.paymentname
      from poheader a
      left join addressbook b on b.addressbookid = a.addressbookid
      left join paymentmethod c on c.paymentmethodid = a.paymentmethodid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.poheaderid = ".$_GET['id'];
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
      $this->pdf->text(100,35,'PO Date ');$this->pdf->text(130,35,date(Yii::app()->params['dateviewfromdb'], strtotime($row['docdate'])));
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

      $sql1 = "select a.poheaderid,c.uomcode,a.poqty,a.delvdate,a.netprice,(poqty * netprice) as total,b.productname,
        d.symbol,d.i18n,e.taxvalue
        from podetail a
        left join product b on b.productid = a.productid
        left join unitofmeasure c on c.unitofmeasureid = a.unitofmeasureid
        left join currency d on d.currencyid = a.currencyid
        left join tax e on e.taxid = a.taxid
        where poheaderid = ".$row['poheaderid'];
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
        $this->pdf->row(array($row1['poqty'],$row1['uomcode'],$row1['productname'],
            Yii::app()->numberFormatter->formatCurrency($row1['netprice'], $row1['symbol']),
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
		$model=Poheader::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeldetail($id)
	{
		$model=Podetail::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='poheader-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
