<?php

class DeliveryadviceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
        protected $menuname = 'deliveryadvice';

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

    public $deliveryadvicedetail;

    public function lookupdata()
    {
      $this->deliveryadvicedetail=new Deliveryadvicedetail('search');
	  $this->deliveryadvicedetail->unsetAttributes();  // clear any default values
	  if(isset($_GET['Deliveryadvicedetail']))
		$this->deliveryadvicedetail->attributes=$_GET['Deliveryadvicedetail'];
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
      parent::actionCreate();
	  $this->lookupdata();
      $model=new Deliveryadvice;
      $model->recordstatus = Wfgroup::model()->findstatusbyuser('insda');
      $model->useraccessid = Useraccess::model()->findbysql("select * from useraccess 
        where upper(username)=upper('".Yii::app()->user->name."')")->useraccessid;

      if (Yii::app()->request->isAjaxRequest)
      {
          if ($model->save()) {
            echo CJSON::encode(array(
                'status'=>'success',
                'deliveryadviceid'=>$model->deliveryadviceid,
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
                  'deliveryadvicedetail'=>$this->deliveryadvicedetail), true)
                ));
            Yii::app()->end();
          }
      }
	}

	public function actionCreatedetail()
	{
      $deliveryadvicedetail=new Deliveryadvicedetail;

      if (Yii::app()->request->isAjaxRequest)
      {
          echo CJSON::encode(array(
              'status'=>'success',
              'divcreate'=>$this->renderPartial('_formdetail',
                array('model'=>$deliveryadvicedetail), true)
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

		// Uncomment the following line if AJAX validation is needed
if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'deliveryadviceid'=>$model->deliveryadviceid,
				'dadate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->dadate)),
				'headernote'=>$model->headernote,
				'recordstatus'=>$model->recordstatus,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
                  'deliveryadvicedetail'=>$this->deliveryadvicedetail), true)
				));
            Yii::app()->end();
        }
        }
	}

	public function actionUpdatedetail()
	{
		$id=$_POST['id'];
	  $deliveryadvicedetail=$this->loadModeldetail($id[0]);

		// Uncomment the following line if AJAX validation is needed

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				'deliveryadvicedetailid'=>$deliveryadvicedetail->deliveryadvicedetailid,
				'productid'=>$deliveryadvicedetail->productid,
				'productname'=>($deliveryadvicedetail->product!==null)?$deliveryadvicedetail->product->productname:"",
				'qty'=>$deliveryadvicedetail->qty,
				'unitofmeasureid'=>$deliveryadvicedetail->unitofmeasureid,
				'uomcode'=>($deliveryadvicedetail->unitofmeasure!==null)?$deliveryadvicedetail->unitofmeasure->uomcode:"",
				'requestedbyid'=>$deliveryadvicedetail->requestedbyid,
				'requestedbycode'=>($deliveryadvicedetail->requestedby!==null)?$deliveryadvicedetail->requestedby->requestedbycode:"",
                'itemtext'=>$deliveryadvicedetail->itemtext,
                'reqdate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($deliveryadvicedetail->reqdate)),
                'div'=>$this->renderPartial('_formdetail',
				  array('model'=>$deliveryadvicedetail), true)
				));
            Yii::app()->end();
        }
	}

    public function actionCancelWrite()
    {
            $this->DeleteLockCloseForm($this->menuname, $_POST['Deliveryadvice'], $_POST['Deliveryadvice']['deliveryadviceid']);
    }

	public function actionWrite()
	{
	  if(isset($_POST['Deliveryadvice']))
	  {
        $messages = $this->ValidateData(
                array(
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Deliveryadvice'];
		if ((int)$_POST['Deliveryadvice']['deliveryadviceid'] > 0)
		{
		  $model=$this->loadModel($_POST['Deliveryadvice']['deliveryadviceid']);
		  $model->headernote = $_POST['Deliveryadvice']['headernote'];
		  $model->dadate = $_POST['Deliveryadvice']['dadate'];
		}
		else
		{
		  $model = new Deliveryadvice();
		  $model->attributes=$_POST['Deliveryadvice'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Deliveryadvice']['deliveryadviceid']);
              $this->GetSMessage('iprinsertsuccess');
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
	  if(isset($_POST['Deliveryadvicedetail']))
	  {
        $messages = $this->ValidateData(
                array(
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Deliveryadvicedetail'];
		if ((int)$_POST['Deliveryadvicedetail']['deliveryadvicedetailid'] > 0)
		{
		  $model=Deliveryadvicedetail::model()->findbyPK($_POST['Deliveryadvicedetail']['deliveryadvicedetailid']);
		  $model->deliveryadviceid = $_POST['Deliveryadvicedetail']['deliveryadviceid'];
		  $model->productid = $_POST['Deliveryadvicedetail']['productid'];
		  $model->qty = $_POST['Deliveryadvicedetail']['qty'];
		  $model->requestedbyid = $_POST['Deliveryadvicedetail']['requestedbyid'];
		  $model->reqdate = $_POST['Deliveryadvicedetail']['reqdate'];
		  $model->itemtext = $_POST['Deliveryadvicedetail']['itemtext'];
		}
		else
		{
		  $model = new Deliveryadvicedetail();
		  $model->attributes=$_POST['Deliveryadvicedetail'];
		}
		try
          {
            if($model->save())
            {
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
            $sql = 'call ApproveDA(:vid, :vlastupdateby)';
            $command=$connection->createCommand($sql);
            $command->bindValue(':vid',$ids,PDO::PARAM_INT);
            $command->bindValue(':vlastupdateby', $a,PDO::PARAM_STR);
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

		$model=new Deliveryadvice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Deliveryadvice']))
			$model->attributes=$_GET['Deliveryadvice'];
if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
		$this->render('index',array(
			'model'=>$model,
					'deliveryadvicedetail'=>$this->deliveryadvicedetail
		));
	}

	public function actionIndexdetail()
	{
		$deliveryadvicedetail=new Deliveryadvicedetail('search');
	  $deliveryadvicedetail->unsetAttributes();  // clear any default values
	  if(isset($_GET['Deliveryadvicedetail']))
		$deliveryadvicedetail->attributes=$_GET['Deliveryadvicedetail'];

	  $this->renderPartial('indexdetail',
		array('deliveryadvicedetail'=>$deliveryadvicedetail));
	  Yii::app()->end();
	}
    
    public function actionDownload()
	{
	  parent::actionDownload();
	  $pdf = new PDF();
	  $pdf->title='Form Permintaan (Barang/Jasa)';
	  $pdf->AddPage('P');
	  $pdf->setFont('Arial','B',12);

	  // definisi font
	  $pdf->setFont('Arial','B',8);

	  // menuliskan tabel
	  $connection=Yii::app()->db;
    $sql = "select a.dano,a.dadate,a.headernote,a.deliveryadviceid
      from deliveryadvice a
      where deliveryadviceid = ".$_GET['id'];
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();

    foreach($dataReader as $row)
    {
      $pdf->setFont('Arial','B',8);
      $pdf->text(10,30,'No ');$pdf->text(50,30,': '.$row['dano']);
      $pdf->text(10,35,'Date ');$pdf->text(50,35,': '.$row['dadate']);
      $pdf->text(10,40,'Note ');$pdf->text(50,40,': '.$row['headernote']);

      $sql1 = "select b.productname, a.qty, c.uomcode, a.itemtext
        from deliveryadvicedetail a
        left join product b on b.productid = a.productid
        left join unitofmeasure c on c.unitofmeasureid = a.unitofmeasureid
        where deliveryadviceid = ".$row['deliveryadviceid'];
      $command1=$connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $pdf->text(10,50,'Items');
      $pdf->SetY(55);
      $pdf->setFont('Arial','B',6);
      $pdf->setaligns(array('C','C','C','C','C'));
      $pdf->setwidths(array(10,90,25,25,40));
      $pdf->setFont('Arial','',6);
      $pdf->Row(array('No','Items','Qty','Unit','Remark'));
      $pdf->setaligns(array('L','L','L','L','L'));
      $i=0;
      foreach($dataReader1 as $row1)
      {
        $i=$i+1;
        $pdf->row(array($i,$row1['productname'],
            Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$row1['qty']),
            $row1['uomcode'],
            $row1['itemtext']));
      }
      
      $pdf->text(100,$pdf->gety()+5,'Jakarta, '.$row['dadate']);
      $pdf->text(10,$pdf->gety()+10,'Approved By');$pdf->text(100,$pdf->gety()+10,'Proposed By');
      $pdf->text(10,$pdf->gety()+20,'------------ ');$pdf->text(100,$pdf->gety()+20,'------------');

      $pdf->AddPage('P');
      }
	  $pdf->Output();
	}

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

	public function actionDeletedetail()
	{
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=Deliveryadvicedetail::model()->findbyPK($ids);
		  $model->delete();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Deliveryadvice::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeldetail($id)
	{
		$model=Deliveryadvicedetail::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='deliveryadvice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
