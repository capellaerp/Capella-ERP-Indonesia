<?php

class FakturpajakController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'fakturpajak';

	public function actionHelp()
	{
		if (isset($_POST['id'])) {
			$id= (int)$_POST['id'];
			switch ($id) {
				case 1 : $this->txt = '_help'; break;
				case 2 : $this->txt = '_helpmodif'; break;
				case 3 : $this->txt = '_helpservice'; break;
				case 4 : $this->txt = '_helpservicemodif'; break;
				case 5 : $this->txt = '_helppic'; break;
				case 6 : $this->txt = '_helppicmodif'; break;
				case 7 : $this->txt = '_helplocation'; break;
				case 8 : $this->txt = '_helplocationmodif'; break;
				case 9 : $this->txt = '_helpdocument'; break;
				case 10 : $this->txt = '_helpdocumentmodif'; break;
				case 11 : $this->txt = '_helpnetwork'; break;
				case 12 : $this->txt = '_helpnetworkmodif'; break;
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
		$model=new Fakturpajak('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Fakturpajak']))
			$model->attributes=$_GET['Fakturpajak'];
		if (isset($_GET['pageSize']))
		{
		  Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		  unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}

		$this->render('index',array(
			'model'=>$model
		));
	}

	
	public function actionDownload()
	{
	  parent::actionDownload();
	   $sql = "select b.invoiceid,fakturpajakno,fullname,invoicedate,
				(select addressname as custaddress from address z where z.addressbookid = c.addressbookid limit 1) as addressname,
				(select cityname from city y left join address x on x.cityid = y.cityid where x.addressbookid = c.addressbookid limit 1) as cityname,
				c.taxno,d.taxvalue,
				(select companyname from company limit 1) as companyname,
				(select address from company limit 1) as companyaddressname,
				(select cityname from company w left join city v on v.cityid = w.cityid limit 1) as companycityname,
				(select taxno from company limit 1) as companytaxno
			from fakturpajak a
			left join invoice b on b.invoiceid = a.invoiceid
			left join addressbook c on c.addressbookid = b.addressbookid 
			left join tax d on d.taxid = b.taxid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.fakturpajakid = ".$_GET['id'];
		}
		$sql = $sql . " order by fakturpajakid";
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
	  $this->pdf->isheader = false;
	  $this->pdf->AddPage('P');

    foreach($dataReader as $row)
    {
      $this->pdf->setFont('Arial','',6);
	  $this->pdf->rect(115,5,75,18);
      $this->pdf->text(120,10,'Lembar ke-1 : Untuk Pembeli BKP/Penerima JKP (putih)');
      $this->pdf->text(120,15,'Lembar ke-2 : Untuk PKP yang menerbitkan faktur pajak (merah)');
      $this->pdf->text(120,20,'Lembar ke-3 : Extra copy (kuning)');

      $this->pdf->setFont('Arial','B',12);
      $this->pdf->text(50,30,'FAKTUR PAJAK');

      $this->pdf->setFont('Arial','',8);
	  $this->pdf->rect(10,35,180,6);
      $this->pdf->text(12,39,'Kode dan Nomor Seri Faktur Pajak : '.$row['fakturpajakno']);
	  $this->pdf->rect(10,41,180,6);
      $this->pdf->text(12,45,'Pengusaha Kena Pajak');
	  $this->pdf->rect(10,47,180,20);
      $this->pdf->text(12,51,'N a m a');$this->pdf->text(50,51,':');$this->pdf->text(60,51,$row['companyname']);
      $this->pdf->text(12,56,'A l a m a t');$this->pdf->text(50,56,':');$this->pdf->text(60,56,$row['companyaddressname']);
      $this->pdf->text(12,61,'');$this->pdf->text(50,61,'');$this->pdf->text(60,61,$row['companycityname']);
      $this->pdf->text(12,66,'NPWP');$this->pdf->text(50,66,':');$this->pdf->text(60,66,$row['companytaxno']);
	  $this->pdf->rect(10,67,180,6);
      $this->pdf->text(12,71,'Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak');
	  $this->pdf->rect(10,73,180,22);
      $this->pdf->text(12,78,'N a m a');$this->pdf->text(50,78,':');$this->pdf->text(60,78,$row['fullname']);
      $this->pdf->text(12,83,'A l a m a t');$this->pdf->text(50,83,':');$this->pdf->text(60,83,$row['addressname']);
      $this->pdf->text(12,88,'');$this->pdf->text(50,88,'');$this->pdf->text(60,88,$row['cityname']);
      $this->pdf->text(12,93,'NPWP');$this->pdf->text(50,93,':');$this->pdf->text(60,93,$row['taxno']);

	  
       $sql1 = "select itemname,qty,uomcode,price,currencyname,rate,a.description,
	    price * ".$row['taxvalue']. "/100 as taxvalue
        from invoicedet a
		left join currency b on b.currencyid = a.currencyid
		left join unitofmeasure c on c.unitofmeasureid = a.unitofmeasureid
        where invoiceid = ".$row['invoiceid'];
      $command1=$this->connection->createCommand($sql1);
      $dataReader1=$command1->queryAll();

      $this->pdf->SetY($this->pdf->gety()+85);
		$this->pdf->setFont('Arial','B',8);
      $this->pdf->setaligns(array('C','C','C'));
      $this->pdf->setwidths(array(20,90,70));
      $this->pdf->setbordercell(array('LTRB','LTRB','LTRB'));
      $this->pdf->Row(array(
		'No Urut',
		'Nama Barang Kena Pajak / Jasa Kena Pajak',
		'Harga Jual/Penggantian/Uang Muka/Termin'));
		$this->pdf->setFont('Arial','',8);
      $this->pdf->setaligns(array('L','L','R'));
      $this->pdf->setbordercell(array('LR','LR','LR'));
	  $total = 0;$i=0;
      foreach($dataReader1 as $row1)
      {
		$i = $i+1;
        $this->pdf->row(array($i,$row1['itemname'],
			'Rp.'.Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$row1['price'])));
		$total = $total + ($row1['price']);
      }
	  for ($i=0;$i<10;$i++)
	  {
        $this->pdf->row(array(' ',' ',' '));
	  }
      $this->pdf->setbordercell(array('LTB','TRB','LTRB'));
        $this->pdf->row(array('','Harga Jual/Penggantian/Uang Muka/Termin**)',
			'Rp.'.Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$total)));
        $this->pdf->row(array('','Dikurangi Potongan Harga',
			'-'));
        $this->pdf->row(array('','Dikurangi Uang Muka yang telah diterima',
			'-'));
        $this->pdf->row(array('','Dasar Pengenaan Pajak',
			'Rp.'.Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$total)));
        $this->pdf->row(array('','PPN = 10% x Dasar Pengenaan Pajak',
			'Rp.'.Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$total*$row['taxvalue']/100)));

		$this->pdf->sety($this->pdf->gety()+10);
      $this->pdf->text(12,$this->pdf->gety(),'Pajak Penjualan Atas Barang Mewah');
      $this->pdf->text(150,$this->pdf->gety(),'Jakarta, tgl '.date(Yii::app()->params['dateviewfromdb'], strtotime($row['invoicedate'])));

		$this->pdf->sety($this->pdf->gety()+10);
	        $this->pdf->setaligns(array('C','C','C'));
      $this->pdf->setwidths(array(15,15,15));
      $this->pdf->setbordercell(array('LTRB','LTRB','LTRB'));
      $this->pdf->Row(array(
		'Tarif',
		'DPP',
		'PPnBM'));
      $this->pdf->setbordercell(array('LR','LR','LR'));
      $this->pdf->Row(array(
		'.........%',
		'Rp........',
		'Rp........'));
      $this->pdf->Row(array(
		'.........%',
		'Rp........',
		'Rp........'));
      $this->pdf->Row(array(
		'.........%',
		'Rp........',
		'Rp........'));
      $this->pdf->Row(array(
		'.........%',
		'Rp........',
		'Rp........'));
      $this->pdf->setbordercell(array('LTB','RTB','LRTB'));
      $this->pdf->Row(array(
		'Jumlah',
		'',
		'Rp........'));

	      $this->pdf->text(12,$this->pdf->gety()+20,'**) Coret yang tidak perlu');
  
	      $this->pdf->text(150,$this->pdf->gety(),'Nama        Maya Dhamayanti');
	      $this->pdf->text(150,$this->pdf->gety()+5,'Jabatan     Accounting');


		  
      /*  $this->pdf->rect(10,$this->pdf->gety()+5,20,5);$this->pdf->rect(30,$this->pdf->gety()+5,20,5);$this->pdf->rect(50,$this->pdf->gety()+5,20,5);
      $this->pdf->text(12,$this->pdf->gety()+8,'Tarif');$this->pdf->text(32,$this->pdf->gety()+8,'DPP');$this->pdf->text(52,$this->pdf->gety()+8,'PPnBM');
        $this->pdf->rect(10,$this->pdf->gety()+10,20,5);$this->pdf->rect(30,$this->pdf->gety()+10,20,5);$this->pdf->rect(50,$this->pdf->gety()+10,20,5);
      $this->pdf->text(12,$this->pdf->gety()+8,'Tarif');$this->pdf->text(32,$this->pdf->gety()+8,'DPP');$this->pdf->text(52,$this->pdf->gety()+8,'PPnBM');
*/

			$this->pdf->AddPage('P');
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
		$model=Invoice::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelinvoicedet($id)
	{
		$model=Invoicedet::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModeldetailinvoiceacc($id)
	{
		$model=Invoiceacc::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoiceap-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoiceapservice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
