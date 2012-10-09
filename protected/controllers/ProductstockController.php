<?php

class ProductstockController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
protected $menuname = 'productstock';

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
	  $productstockhist=new Productstockhist('search');
		$productstockhist->unsetAttributes();  
		if(isset($_GET['Productstockhist']))
		$productstockhist->attributes=$_GET['Productstockhist'];
		
		$model=new Productstock('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Productstock']))
			$model->attributes=$_GET['Productstock'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
			'productstockhist'=>$productstockhist
		));
	}

	public function actionDownload()
  {
    parent::actionDownload();
    $pdf = new PDF();
    $pdf->title='Material Stock Overview List';
    $pdf->AddPage('L');
    $pdf->setFont('Arial','B',12);

    // definisi font
    $pdf->setFont('Arial','B',8);

    // menuliskan tabel
    $header = array('No','ID','Material Name','Sloc','Qty','UOM','Prod Trans Type',
	'Ref Source');
    $model=new Productstock('search');
    $dataprovider=$model->search();
    $dataprovider->pagination=false;
    $data = $dataprovider->getData();
    $cols = $dataprovider->getKeys();
    $dataku=array(count($data));
    //var_dump($dataku);
    $w= array(10,15,70,30,30,30,40,30);

    $pdf->SetTableHeader();
    //Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    $pdf->SetTableData();
    //Data
    $fill=false;
    $i=0;
    foreach($data as $datas)
    {
        $i=$i+1;
        $pdf->Cell($w[0],6,$i,'LR',0,'L',$fill);
        $pdf->Cell($w[1],6,$datas['productstockid'],'LR',0,'L',$fill);
        $pdf->Cell($w[2],6,Product::model()->findbypk($datas['productid'])->productname,'LR',0,'L',$fill);
        $pdf->Cell($w[3],6,Sloc::model()->findbypk($datas['slocid'])->sloccode,'LR',0,'L',$fill);
        $pdf->Cell($w[4],6,$datas['qty'],'LR',0,'L',$fill);
        $pdf->Cell($w[5],6,Unitofmeasure::model()->findbypk($datas['unitofmeasureid'])->uomcode,'LR',0,'L',$fill);
        $pdf->Cell($w[6],6,Prodtranstype::model()->findbypk($datas['prodtranstypeid'])->description,'LR',0,'L',$fill);
        $pdf->Cell($w[7],6,$datas['refsource'],'LR',0,'L',$fill);
        $pdf->Ln();
        $fill=!$fill;
    }
    $pdf->Cell(array_sum($w),0,'','T');
    // me-render ke browser
    $pdf->Output('productstock.pdf','D');
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Productstock::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='productstock-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
