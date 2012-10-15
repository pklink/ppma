<?php
    $this->breadcrumbs = array(
        'Tags' => array('index'),
        'Manage',
    );

    $this->menu = array(
        array('label' => 'Create Tag', 'url' => array('create'), 'linkOptions' => array('rel' => 'fancy')),
    );

    // register scripts
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/toggle-search.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/form.js');
?>

<h1>Manage Tags</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<a class="search-button">Advanced Search</a>
<div class="search-form">
    <?php $this->renderPartial('_search',array(
	   'model' => $model,
    )); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'cssFile'      => Yii::app()->baseUrl . '/css/grid.css',
	'columns'      => array(
        'name',
        array(
            'class'           => 'CLinkColumn',
            'labelExpression' => '$data->entryCounter',
            'urlExpression'   => 'array("entry/index", "Entry[tagList]" => $data->name)',
            'header'          => 'Used',
        ),
        array(
            'class'               => 'CButtonColumn',
            'template'            => '{update} {delete}',
            'updateButtonOptions' => array('rel' => 'fancy'),
        ),
	),
)); ?>