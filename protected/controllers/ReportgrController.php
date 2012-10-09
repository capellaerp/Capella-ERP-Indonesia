<?php

class ReportgrController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'reportgr';

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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
           parent::actionIndex();
	  $grdetail=new Grdetail('search');
	  $grdetail->unsetAttributes();  // clear any default values
	  if(isset($_GET['Grdetail']))
		$grdetail->attributes=$_GET['Grdetail'];

		$poheader=new Poheader('search');
	  $poheader->unsetAttributes();  // clear any default values
	  if(isset($_GET['Poheader']))
		$poheader->attributes=$_GET['Poheader'];

		$model=new Grheader('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Grheader']))
			$model->attributes=$_GET['Grheader'];
		if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
		$this->render('index',array(
			'model'=>$model,
					'poheader'=>$poheader,
					'grdetail'=>$grdetail
		));
	}

    public function actionDownload()
  {
	parent::actionDownload();
    $sql = "select a.grno,a.grdate,a.grheaderid,b.pono,c.fullname
      from grheader a
      left join poheader b on b.poheaderid = a.poheaderid
      left join addressbook c on c.addressbookid = b.addressbookid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.grheaderid = ".$_GET['id'];
		}
		    $command=$this->connection->createCommand($sql);
    $dataReader=$command->queryAll();
	  $this->pdf->title='Nota Penerimaan Barang';
	  $this->pdf->AddPage('P');
	  $this->pdf->setFont('Arial','B',12);

	  // definisi font
	  $this->pdf->setFont('Arial','B',8);

    foreach($dataReader as $row)
    {
      $this->pdf->setFont('Arial','B',8);
      $this->pdf->text(10,30,'No ');$this->pdf->text(50,30,': '.$row['grno']);
      $this->pdf->text(10,35,'Date ');$this->pdf->text(50,35,': '.$row['grdate']);
      $this->pdf->text(10,40,'PO No ');$this->pdf->text(50,40,': '.$row['pono']);
      $this->pdf->text(10,45,'Vendor ');$this->pdf->text(50,45,': '.$row['fullname']);

      $sql1 = "select b.productname, a.qty, c.uomcode,d.description
        from grdetail a
        left join product b on b.productid = a.productid
        left join unitofmeasure c on c.unitofmeasureid = a.unitofmeasureid
        left join sloc d on d.slocid = a.slocid
        where grheaderid = ".$row['grheaderid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->text(10,55,'Items');
      $this->pdf->SetY(60);
      $this->pdf->setaligns(array('C','C','C','C','C','C'));
      $this->pdf->setFont('Arial','B',6);
      $this->pdf->setwidths(array(10,110,20,20,20,40));
      $this->pdf->Row(array('No','Nama Barang','Qty','Unit','Gudang'));
      $this->pdf->setFont('Arial','',6);
      $this->pdf->setaligns(array('L','L','L','L','L','L'));
      $i=0;
      foreach($dataReader1 as $row1)
      {
        $i=$i+1;
        $this->pdf->row(array($i,$row1['productname'],
            Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$row1['qty']),
            $row1['uomcode'],
            $row1['description']));
      }
      
      $this->pdf->text(10,$this->pdf->gety()+10,'PT SATKOMINDO MEDIYASA'); $this->pdf->text(50,$this->pdf->gety()+10,'PETUGAS GUDANG');$this->pdf->text(100,$this->pdf->gety()+10,'PENGIRIM');$this->pdf->text(150,$this->pdf->gety()+10,'PENERIMA');
      $this->pdf->text(10,$this->pdf->gety()+20,'----------------------');$this->pdf->text(50,$this->pdf->gety()+20,'----------------------');$this->pdf->text(100,$this->pdf->gety()+20,'----------------------');$this->pdf->text(150,$this->pdf->gety()+20,'----------------------');
      
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
		$model=Reportgr::model()->findByPk((int)$id);
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
