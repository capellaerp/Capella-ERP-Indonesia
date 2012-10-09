<?php $this->pageTitle=Yii::app()->name; ?>
<?php $this->beginWidget('bootstrap.widgets.BootHero', array(
    'heading'=>'Berita Terbaru',
)); ?>
<?php $this->widget('bootstrap.widgets.BootCarousel', array(
    'items'=>array(
		array('image'=>'images/brosur-depan.jpg', 
			'label'=>'Brosur Depan', 
			'caption'=>'Brosur Depan'),
    ),
    'events'=>array(
        'slide'=>"js:function() { console.log('Carousel slide.'); }",
        'slid'=>"js:function() { console.log('Carousel slid.'); }",
    ),
)); ?>
<?php $this->endWidget(); ?>