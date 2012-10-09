<?php
Yii::import('zii.widgets.CPortlet');
class ToolbarButton extends CPortlet
{
    public $title='';
	public $isCreate=false;
	public $UrlCreate='adddata()';
	public $isEdit=false;
	public $UrlEdit='editdata()';
	public $isApprove=false;
	public $UrlApprove='approvedata()';
	public $isDelete=false;
	public $UrlDelete='deletedata()';
	public $isUpload=false;
	public $UrlUpload='uploaddata()';
	public $isDownload=false;
	public $UrlDownload='downloaddata()';
	public $isRefresh=false;
	public $UrlRefresh='refreshdata()';
	public $isHelp=false;
	public $isRecordPage=false;
	public $OnChange='';
	public $PageSize=10;
	public $OnClick='';
	public $isHelpForm=false;
	public $isSave=false;
	public $UrlSave='';
	public $isCancel=false;
	public $UrlCancel='';
	public $DialogID='createdialog';
	public $DialogGrid='datagrid';
 
    protected function renderContent()
    {
        $this->render('ToolbarButton');
    }
}