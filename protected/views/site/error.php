<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
<font size='1'><table dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Fatal error: Call to a member function hasErrors() on a non-object in /var/www/framework/web/helpers/CHtml.php on line <i>1792</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0005</td><td bgcolor='#eeeeec' align='right'>75008</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='/var/www/capella/index.php' bgcolor='#eeeeec'>../index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0549</td><td bgcolor='#eeeeec' align='right'>1418220</td><td bgcolor='#eeeeec'>CApplication->run(  )</td><td title='/var/www/capella/index.php' bgcolor='#eeeeec'>../index.php<b>:</b>13</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0549</td><td bgcolor='#eeeeec' align='right'>1418284</td><td bgcolor='#eeeeec'>CWebApplication->processRequest(  )</td><td title='/var/www/framework/base/CApplication.php' bgcolor='#eeeeec'>../CApplication.php<b>:</b>158</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0633</td><td bgcolor='#eeeeec' align='right'>1620316</td><td bgcolor='#eeeeec'>CWebApplication->runController(  )</td><td title='/var/www/framework/web/CWebApplication.php' bgcolor='#eeeeec'>../CWebApplication.php<b>:</b>136</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.0833</td><td bgcolor='#eeeeec' align='right'>2186688</td><td bgcolor='#eeeeec'>CController->run(  )</td><td title='/var/www/framework/web/CWebApplication.php' bgcolor='#eeeeec'>../CWebApplication.php<b>:</b>277</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.0851</td><td bgcolor='#eeeeec' align='right'>2228852</td><td bgcolor='#eeeeec'>CController->runActionWithFilters(  )</td><td title='/var/www/framework/web/CController.php' bgcolor='#eeeeec'>../CController.php<b>:</b>257</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.0852</td><td bgcolor='#eeeeec' align='right'>2229052</td><td bgcolor='#eeeeec'>CController->runAction(  )</td><td title='/var/www/framework/web/CController.php' bgcolor='#eeeeec'>../CController.php<b>:</b>278</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.0852</td><td bgcolor='#eeeeec' align='right'>2229192</td><td bgcolor='#eeeeec'>CInlineAction->runWithParams(  )</td><td title='/var/www/framework/web/CController.php' bgcolor='#eeeeec'>../CController.php<b>:</b>300</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.0853</td><td bgcolor='#eeeeec' align='right'>2230312</td><td bgcolor='#eeeeec'>GenjournalController->actionCreatedetail(  )</td><td title='/var/www/framework/web/actions/CInlineAction.php' bgcolor='#eeeeec'>../CInlineAction.php<b>:</b>50</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.1856</td><td bgcolor='#eeeeec' align='right'>4260168</td><td bgcolor='#eeeeec'>CController->renderPartial(  )</td><td title='/var/www/capella/protected/controllers/GenjournalController.php' bgcolor='#eeeeec'>../GenjournalController.php<b>:</b>72</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.1861</td><td bgcolor='#eeeeec' align='right'>4260864</td><td bgcolor='#eeeeec'>CBaseController->renderFile(  )</td><td title='/var/www/framework/web/CController.php' bgcolor='#eeeeec'>../CController.php<b>:</b>866</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>12</td><td bgcolor='#eeeeec' align='center'>0.1862</td><td bgcolor='#eeeeec' align='right'>4261348</td><td bgcolor='#eeeeec'>CBaseController->renderInternal(  )</td><td title='/var/www/framework/web/CBaseController.php' bgcolor='#eeeeec'>../CBaseController.php<b>:</b>88</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>13</td><td bgcolor='#eeeeec' align='center'>0.1884</td><td bgcolor='#eeeeec' align='right'>4345388</td><td bgcolor='#eeeeec'>require( <font color='#00bb00'>'/var/www/capella/protected/views/genjournal/_formdetail.php'</font> )</td><td title='/var/www/framework/web/CBaseController.php' bgcolor='#eeeeec'>../CBaseController.php<b>:</b>119</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>14</td><td bgcolor='#eeeeec' align='center'>0.2225</td><td bgcolor='#eeeeec' align='right'>5072352</td><td bgcolor='#eeeeec'>CActiveForm->hiddenField(  )</td><td title='/var/www/capella/protected/views/genjournal/_formdetail.php' bgcolor='#eeeeec'>../_formdetail.php<b>:</b>14</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>15</td><td bgcolor='#eeeeec' align='center'>0.2225</td><td bgcolor='#eeeeec' align='right'>5072724</td><td bgcolor='#eeeeec'>CHtml::activeHiddenField(  )</td><td title='/var/www/framework/web/widgets/CActiveForm.php' bgcolor='#eeeeec'>../CActiveForm.php<b>:</b>583</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>16</td><td bgcolor='#eeeeec' align='center'>0.2228</td><td bgcolor='#eeeeec' align='right'>5073544</td><td bgcolor='#eeeeec'>CHtml::activeInputField(  )</td><td title='/var/www/framework/web/helpers/CHtml.php' bgcolor='#eeeeec'>../CHtml.php<b>:</b>1213</td></tr>
</table></font>
