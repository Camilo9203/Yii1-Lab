<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Countries', 'url'=>array('index')),
	array('label'=>'Create Country', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="container">
    <div class="row-fluid">
        <div class="span12">
            <br>
            <!-- Message Session -->
            <?php $this->renderPartial('_messages'); ?>
            <!-- Content -->
            <h1>Manage Countries</h1>
            <p>
                You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
                or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
            </p>

            <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
            <div class="search-form" style="display:none">
                <?php $this->renderPartial('_search',array(
                    'model'=>$model,
                )); ?>
            </div><!-- search-form -->

            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'users-grid',
                'itemsCssClass' => 'table table-striped',
                #'pager' => array('htmlOptions' => array('class' => 'pagination')),
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'columns'=>array(
                    'id',
                    'name',
                    array(               
                        'name'=>'status',
                        'value'=> 'CHtml::encode($data->status==1 ? "Enabled" : "Disabled")',
                    ),
                    array(
                        'class'=>'CButtonColumn',
                    ),
                ),
            )); ?>

        </div>
    </div>
</div><br><br>
