<?php

class GenledgerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
    protected $menuname = 'genledger';

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
	 * Lists all models.
	 */
	public function actionIndex()
	{
            parent::actionIndex();
			if (isset($_POST['startperiod']))
      {
       $this->pdf->title='General Ledger';
        $this->pdf->AddPage('P', 'A4');
		$connection=Yii::app()->db;
		$sql = "select accountid,accountcode,accountname from account  ";
		if ($_POST['accountid'] !== '')
		{
			$sql = $sql . " where accountid = ".$_POST['accountid'];
		}
		$command=$connection->createCommand($sql);
        $dataReader=$command->queryAll();
			$this->pdf->Text(10,$this->pdf->GetY(),date(Yii::app()->params['dateviewfromdb'], strtotime($_POST['startperiod'])) . 
				' - '.date(Yii::app()->params['dateviewfromdb'], strtotime($_POST['endperiod'])));
		
		foreach($dataReader as $row)
          {
		  $this->pdf->setFont('Arial','B',6);
		  $starty = 10;
			$this->pdf->Text(10,$starty+$this->pdf->GetY(),'Account Code : '.$row['accountcode']);
			$this->pdf->Text(60,$starty+$this->pdf->GetY(),'Account Name : '.$row['accountname']);
        $sql1 = "select b.accountcode,b.accountname, a.debit,a.credit,a.postdate,c.currencyname,a.ratevalue
from genledger a
left join account b on b.accountid = a.accountid
left join currency c on c.currencyid = a.currencyid
where postdate between '".$_POST['startperiod']."' and '".$_POST['endperiod']."' and a.accountid = ".$row['accountid']." order by postdate";
          $command1=$connection->createCommand($sql1);
        $dataReader1=$command1->queryAll();
		$starty = $this->pdf->GetY() + 15;
		$this->pdf->setY($starty);
          $this->pdf->setFont('Arial','B',6);
          $this->pdf->setwidths(array(30,40,40,20,30));
      $this->pdf->setaligns(array('C','C','C','C','C'));
      $this->pdf->setbordercell(array('LTRB','LTRB','LTRB','LTRB','LTRB'));
          $this->pdf->row(array('Post Date','Debit','Credit','Currency Name','Rate'));
      $this->pdf->setbordercell(array('LTRB','LTRB','LTRB','LTRB','LTRB'));
          $this->pdf->SetTableData();
		  $totaldebit = 0;
		  $totalcredit = 0;
		  $selisih = 0;
      $this->pdf->setaligns(array('L','R','R','L','R'));
          foreach($dataReader1 as $row1)
          {
            $this->pdf->row(array(
				date(Yii::app()->params['dateviewfromdb'], strtotime($row1['postdate'])),
				Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$row1['debit']),
				Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$row1['credit']),
				$row1['currencyname'],
				Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$row1['ratevalue']),
			));
			$totaldebit = ($row1['debit'] * $row1['ratevalue']) + $totaldebit;
			$totalcredit = ($row1['credit'] * $row1['ratevalue']) + $totalcredit;
          }
		  $this->pdf->row(array(
			'Sub Total',
			Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$totaldebit),
			Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$totalcredit),
			'',
			''
		  ));
		  $this->pdf->row(array(
			'Total',
			Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],($totaldebit>=$totalcredit)?$totaldebit-$totalcredit:0),
			Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],($totaldebit<$totalcredit)?$totalcredit-$totaldebit:0),
			'',
		  ));
		  		  }
          $this->pdf->Output();
	  }
	  else
	  {
		$this->render('index');
	  }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Genledger::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='genledger-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
