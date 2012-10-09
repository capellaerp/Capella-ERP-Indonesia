<?php

class ReportgiController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'reportgi';

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
	
	public $gidetail;

	public function lookupdata()
	{
	  $this->gidetail=new Gidetail('searchbygiheaderid');
	  $this->gidetail->unsetAttributes();  // clear any default values
	  if(isset($_GET['Gidetail']))
		$this->gidetail->attributes=$_GET['Gidetail'];
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
	  $this->lookupdata();
	  $model=new Giheader;
	  $model->recordstatus=1;
	  if (Yii::app()->request->isAjaxRequest)
	  {
		if ($model->save()) {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'giheaderid'=>$model->giheaderid,
			  'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
				'gidetail'=>$this->gidetail), true)
			  ));
		  Yii::app()->end();
		}
	  }
	}

	public function actionCreatedetail()
	{
	  $gidetail=new Gidetail;
	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'divcreate'=>$this->renderPartial('_formdetail',
				array('model'=>$gidetail), true)
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
	  if (Yii::app()->request->isAjaxRequest)
	  {
		echo CJSON::encode(array(
			'status'=>'success',
			'giheaderid'=>$model->giheaderid,
			'gino'=>$model->gino,
			'gidate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->gidate)),
			'postdate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->postdate)),
			'soheaderid'=>$model->soheaderid,
			'sono'=>($model->soheader!==null)?$model->soheader->sono:"",
			'deliveryadviceid'=>$model->deliveryadviceid,
			'dano'=>($model->deliveryadvice!==null)?$model->deliveryadvice->dano:"",
			'location'=>$model->location,
			'div'=>$this->renderPartial('_form', array('model'=>$model,
				'gidetail'=>$this->gidetail), true)
			));
		Yii::app()->end();
	  }
	}

	public function actionUpdatedetail()
	{
	  $id=$_POST['id'];
	  $gidetail=$this->loadModeldetail($id[0]);
	  if (Yii::app()->request->isAjaxRequest)
	  {
		  echo CJSON::encode(array(
			  'status'=>'success',
			  'gidetailid'=>$gidetail->gidetailid,
			  'productid'=>$gidetail->productid,
			  'productname'=>($gidetail->product!==null)?$gidetail->product->productname:"",
			  'unitofmeasureid'=>$gidetail->unitofmeasureid,
			  'uomcode'=>($gidetail->unitofmeasure!==null)?$gidetail->unitofmeasure->uomcode:"",
			  'slocid'=>$gidetail->slocid,
			  'sloccode'=>($gidetail->sloc!==null)?$gidetail->sloc->sloccode:"",
			  'qty'=>$gidetail->qty,
              'itemnote'=>$gidetail->itemnote,
              'serialno'=>$gidetail->serialno,
			  'div'=>$this->renderPartial('_formdetail',
				array('model'=>$gidetail), true)
			  ));
		  Yii::app()->end();
	  }
	}
   
    public function actionCancelWrite()
    {
      $model = Giheader::model()->findbypk($_POST['Giheader']['giheaderid']);
      if ($model != null)
      {
        $model->Delete();
      }
      $this->DeleteLockCloseForm($this->menuname, $_POST['Giheader'], $_POST['Giheader']['giheaderid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Giheader']))
	  {
        $messages = $this->ValidateData(
                array(
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Giheader'];
		if ((int)$_POST['Giheader']['giheaderid'] > 0)
		{
		  $model=$this->loadModel($_POST['Giheader']['giheaderid']);
		  $model->deliveryadviceid = $_POST['Giheader']['deliveryadviceid'];
		  $model->gidate = $_POST['Giheader']['gidate'];
		  $model->location = $_POST['Giheader']['location'];
		  $model->headernote = $_POST['Giheader']['headernote'];
		  $model->soheaderid = $_POST['Giheader']['soheaderid'];
		}
		else
		{
		  $model = new Giheader();
		  $model->attributes=$_POST['Giheader'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Giheader']['giheaderid']);
              $this->GetSMessage('igiinsertsuccess');
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

        public function actionGenerateso()
        {
            if(isset($_POST['id']) & isset($_POST['hid']))
	  {
              $connection=Yii::app()->db;
			  $transaction=$connection->beginTransaction();
			  try
			  {
				$sql = 'call GenerateGISO(:vid, :vhid)';
				$command=$connection->createCommand($sql);
				$command->bindvalue(':vid',$_POST['id'],PDO::PARAM_INT);
				$command->bindvalue(':vhid', $_POST['hid'],PDO::PARAM_INT);
				$command->execute();
				$transaction->commit();
				$this->GetSMessage('igiinsertsuccess');
			  }
			  catch(Exception $e) // an exception is raised if a query fails
			  {
				  $transaction->rollBack();
				  $this->GetMessage($e->getMessage());
			  }
          }
           Yii::app()->end();
        }

        public function actionGenerateda()
        {
            if(isset($_POST['id']) & isset($_POST['hid']))
	  {
              $connection=Yii::app()->db;
			  $transaction=$connection->beginTransaction();
			  try
			  {
				$sql = 'call GenerateGIDA(:vid, :vhid)';
				$command=$connection->createCommand($sql);
				$command->bindvalue(':vid',$_POST['id'],PDO::PARAM_INT);
				$command->bindvalue(':vhid', $_POST['hid'],PDO::PARAM_INT);
				$command->execute();
				$transaction->commit();
				$this->GetSMessage('igiinsertsuccess');
			  }
			  catch(Exception $e) // an exception is raised if a query fails
			  {
				  $transaction->rollBack();
				  $this->GetMessage($e->getMessage());
			  }
          }
           Yii::app()->end();
        }

	public function actionWritedetail()
	{
	  if(isset($_POST['Gidetail']))
	  {
        $messages = $this->ValidateData(
                array(
                    array($_POST['Gidetail']['productid'],'igiemptyproductid','emptystring'),
                    array($_POST['Gidetail']['unitofmeasureid'],'igiemptyunitofmeasureid','emptystring'),
                    array($_POST['Gidetail']['slocid'],'igiemptyslocid','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Gidetail'];
		if ((int)$_POST['Gidetail']['gidetailid'] > 0)
		{
		  $model=Gidetail::model()->findbyPK($_POST['Gidetail']['gidetailid']);
		  $model->giheaderid = $_POST['Gidetail']['giheaderid'];
		  $model->productid = $_POST['Gidetail']['productid'];
		  $model->unitofmeasureid = $_POST['Gidetail']['unitofmeasureid'];
		  $model->qty = $_POST['Gidetail']['qty'];
		  $model->slocid = $_POST['Gidetail']['slocid'];
		  $model->itemnote = $_POST['Gidetail']['itemnote'];
		  $model->serialno = $_POST['Gidetail']['serialno'];
		}
		else
		{
		  $model = new Gidetail();
		  $model->attributes=$_POST['Gidetail'];
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Gidetail']['gidetailid']);
              $this->GetSMessage('igiinsertsuccess');
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
		  $model=Gidetail::model()->findbyPK($ids);
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
			$connection=Yii::app()->db;
			  $transaction=$connection->beginTransaction();
			  try
			  {
				$sql = 'call ApproveGI(:vid, :vlastupdateby)';
				$command=$connection->createCommand($sql);
				$command->bindValue(':vid',$ids,PDO::PARAM_INT);
				$command->bindValue(':vlastupdateby', Yii::app()->user->name,PDO::PARAM_STR);
				$command->execute();
				$transaction->commit();
				$this->GetSMessage('igiapprovesuccess');
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
	  $model=new Giheader('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Giheader']))
		  $model->attributes=$_GET['Giheader'];
	  if(isset($_GET['Gidetail']))
	  {
		$this->gidetail=new Gidetail('searchbygiheaderid');
		$this->gidetail->unsetAttributes();  // clear any default values
		if(isset($_GET['Gidetail']))
		  $this->gidetail->attributes=$_GET['Gidetail'];
	  }
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		  'model'=>$model,
				  'gidetail'=>$this->gidetail
	  ));
	}

	public function actionIndexdetail()
	{
	  $gidetail=new Gidetail('searchbygiheaderid');
	  $gidetail->unsetAttributes();  // clear any default values
	  if(isset($_GET['Gidetail']))
		$gidetail->attributes=$_GET['Gidetail'];

	  $this->renderPartial('indexdetail',
		array('gidetail'=>$gidetail));
	  Yii::app()->end();
	}

	public function actionDownload()
  {
	parent::actionDownload();
    $sql = "select a.gino,a.gidate,b.dano,a.location,a.giheaderid,a.headernote
      from giheader a
      left join deliveryadvice b on b.deliveryadviceid = a.deliveryadviceid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.giheaderid = ".$_GET['id'];
		}
		    $command=$this->connection->createCommand($sql);
    $dataReader=$command->queryAll();
	  $this->pdf->title='Nota Pengiriman Barang';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    foreach($dataReader as $row)
    {
      $this->pdf->setFont('Arial','B',8);
      $this->pdf->text(10,30,'No ');$this->pdf->text(50,30,': '.$row['gino']);
      $this->pdf->text(10,35,'Date ');$this->pdf->text(50,35,': '.$row['gidate']);
      $this->pdf->text(10,40,'Form No ');$this->pdf->text(50,40,': '.$row['dano']);
      $this->pdf->text(10,45,'Location ');$this->pdf->text(50,45,': '.$row['location']);

      $sql1 = "select b.productname, a.qty, c.uomcode,d.description,a.serialno
        from gidetail a
        left join product b on b.productid = a.productid
        left join unitofmeasure c on c.unitofmeasureid = a.unitofmeasureid
        left join sloc d on d.slocid = a.slocid
        where giheaderid = ".$row['giheaderid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,55,'Items');
      $this->pdf->SetY(60);
      $this->pdf->setaligns(array('C','C','C','C','C','C','C'));
      $this->pdf->setFont('Arial','B',6);
      $this->pdf->setwidths(array(10,80,30,20,20,20,40));
      $this->pdf->Row(array('No','Nama Barang','Serial No','Qty','Unit','Gudang'));
      $this->pdf->setFont('Arial','',6);
      $this->pdf->setaligns(array('L','L','L','L','L','L','L'));
      $i=0;
      foreach($dataReader1 as $row1)
      {
        $i=$i+1;
        $this->pdf->row(array($i,$row1['productname'],
            $row1['serialno'],
            Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$row1['qty']),
            $row1['uomcode'],
            $row1['description']));
      }
	  $this->pdf->text(10,$this->pdf->gety()+10,'Catatan: ');
	  $this->pdf->text(10,$this->pdf->gety()+15,$row['headernote']);

      
      $this->pdf->text(10,$this->pdf->gety()+30,'PT SATKOMINDO MEDIYASA'); $this->pdf->text(50,$this->pdf->gety()+30,'PETUGAS GUDANG');$this->pdf->text(100,$this->pdf->gety()+30,'PENGIRIM');$this->pdf->text(150,$this->pdf->gety()+30,'PENERIMA');
      $this->pdf->text(10,$this->pdf->gety()+40,'----------------------');$this->pdf->text(50,$this->pdf->gety()+40,'----------------------');$this->pdf->text(100,$this->pdf->gety()+40,'----------------------');$this->pdf->text(150,$this->pdf->gety()+40,'----------------------');
      
      $this->pdf->AddPage('P');
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
		$model=Giheader::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeldetail($id)
	{
		$model=Gidetail::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='giheader-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='gidetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
