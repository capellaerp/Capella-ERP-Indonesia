<div id="toolbar">
<ul>
	<?php
	if ($this->isCreate == true) {
		$imgcreate=CHtml::image(Yii::app()->request->baseUrl.'/images/create.png');
		echo CHtml :: openTag('li');
		echo CHtml::link($imgcreate,'#',array(
			'id'=>'create',
			'style'=>'cursor: pointer; text-decoration: underline;',
			'onclick'=>"{". $this->UrlCreate . "}",
			'title'=>Catalogsys::model()->getcatalog('createdata')
		));
		echo CHtml :: closeTag('li');
	};
	if ($this->isEdit == true) {
		$imgedit=CHtml::image(Yii::app()->request->baseUrl.'/images/edit.png');
		echo CHtml :: openTag('li');
		echo CHtml::link($imgedit,'#',array(
			'style'=>'cursor: pointer; text-decoration: underline;',
			'onclick'=>"{". $this->UrlEdit . "}",
			'id'=>'edit',
			'title'=>Catalogsys::model()->getcatalog('editdata')
		));
		echo CHtml :: closeTag('li');
	};
	if ($this->isApprove == true) {
		$imgapprove=CHtml::image(Yii::app()->request->baseUrl.'/images/approve.png');
		echo CHtml :: openTag('li');
		echo CHtml::link($imgapprove,'#',array(
		   'style'=>'cursor: pointer; text-decoration: underline;',
		   'onclick'=>"{". $this->UrlApprove . "}",
			'id'=>'refresh',
			'title'=>Catalogsys::model()->getcatalog('approvedata')
		));
		echo CHtml :: closeTag('li');
	};
	if ($this->isDelete == true) {
		$imgdelete=CHtml::image(Yii::app()->request->baseUrl.'/images/delete.png');
		echo CHtml :: openTag('li');
		echo CHtml::link($imgdelete,'#',array(
		   'style'=>'cursor: pointer; text-decoration: underline;',
		   'onclick'=>"{". $this->UrlDelete . "}",
			'id'=>'delete',
			'title'=>Catalogsys::model()->getcatalog('deletedata')
		));
		echo CHtml :: closeTag('li');
	};
	if ($this->isUpload == true) {?>
<li>
<a id="upload" class="hover" style="cursor: pointer; text-decoration: underline; padding-top:15px;" title="<?php echo Catalogsys::model()->getcatalog('uploaddata') ?>">
<img src="images/up.png" alt="">
</a>
</li><?php }
	if ($this->isDownload == true) {
		$imgdown=CHtml::image(Yii::app()->request->baseUrl.'/images/print.png');
		echo CHtml :: openTag('li');
		echo CHtml::link($imgdown,'#',array(
		   'style'=>'cursor: pointer; text-decoration: underline;',
			'onclick'=>"{". $this->UrlDownload . "}",
			'id'=>'download',
			'title'=>Catalogsys::model()->getcatalog('downloaddata')
		));
		echo CHtml :: closeTag('li');
	};
	if ($this->isRefresh == true) {
		$imgrefresh=CHtml::image(Yii::app()->request->baseUrl.'/images/refresh.png');
		echo CHtml :: openTag('li');
		echo CHtml::link($imgrefresh,'#',array(
		   'style'=>'cursor: pointer; text-decoration: underline;',
		   'onclick'=>"{". $this->UrlRefresh . "}",
			'id'=>'refresh',
			'title'=>Catalogsys::model()->getcatalog('refreshdata')
		));
		echo CHtml :: closeTag('li');
	};
	if ($this->isHelp == true) {
		$imghelp=CHtml::image(Yii::app()->request->baseUrl.'/images/help.png');
		echo CHtml :: openTag('li');
		echo CHtml::link($imghelp,'#',array(
		   'style'=>'cursor: pointer; text-decoration: underline;',
		   'onclick'=>$this->OnClick,
			'id'=>'help',
			'title'=>Catalogsys::model()->getcatalog('helpdata')
		));
		echo CHtml :: closeTag('li');
	};
	?>
	<div class="recordpage">
	<?php
	if ($this->isRecordPage == true) {
	?>
		Record/page<?php echo CHtml::textField('',Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),array('size'=>'5',
			// change 'user-grid' to the actual id of your grid!!
			'onchange'=>$this->OnChange,
						'id'=>'recordpage',
						'title'=>Catalogsys::model()->getcatalog('recordpage')
		  ));
	};
	?>
	</div>
			</ul>
</div>
<div id="toolbarform">
<ul>
	<?php
	if ($this->isHelpForm == true) {
		$imghelp=CHtml::image(Yii::app()->request->baseUrl.'/images/help.png');
		echo CHtml :: openTag('li');
		echo CHtml::link($imghelp,'#',array(
		   'style'=>'cursor: pointer; text-decoration: underline;',
		   'onclick'=>$this->OnClick,
		   'title'=>Yii::t('app','help')
		));
		echo CHtml :: closeTag('li');
	};
	if ($this->isSave == true) {
		echo CHtml :: openTag('li');
		echo CHtml::ajaxSubmitButton('Save',
			array($this->UrlSave),
		  array(
		  'success'=>'function(data)
			{
				var x = eval("(" + data + ")");
				document.getElementById("messages").innerHTML = x.div;
				if (x.status == "success")
				{
				  $.fn.yiiGridView.update("'.$this->DialogGrid.'");
				  $("#'.$this->DialogID.'").dialog("close");
				  document.getElementById("messages").innerHTML = "";
				}
			}')); 
		echo CHtml :: closeTag('li');
	};
	if ($this->isCancel == true) {
		echo CHtml :: openTag('li');
		echo CHtml::ajaxSubmitButton('Cancel',
			array($this->UrlCancel),
		  array(
		  'success'=>'function(data)
			{
				var x = eval("(" + data + ")");
				document.getElementById("messages").innerHTML = x.div;
				if (x.status == "success")
				{
				  $.fn.yiiGridView.update("'.$this->DialogGrid.'");
				  $("#'.$this->DialogID.'").dialog("close");
				  document.getElementById("messages").innerHTML = "";
				}
			}')); 
		echo CHtml :: closeTag('li');
	};
	?>
		</ul>
</div>
