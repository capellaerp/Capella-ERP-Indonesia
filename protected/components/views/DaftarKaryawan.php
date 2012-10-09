<div class="daftarkaryawanform">
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model->searchultah(),
	'template'=>'{pager}<br>{items}{pager}',
    'itemView'=>'_listview',   // refers to the partial view named '_post'
));?>
</div>