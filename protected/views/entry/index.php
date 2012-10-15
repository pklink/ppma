<?php
    // set breadcrumbs
    $this->breadcrumbs = array(
        'Entries' => array('index'),
        'Manage',
    );

    // register scripts
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/toggle-search.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/entry-index-modal.js');
?>

<h1>Manage Entries</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php if (Yii::app()->user->hasFlash('success')) : ?>
    <div class="alert-box success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
        <a href="" class="close">&times;</a>
    </div>
<?php endif; ?>

<p><a class="search-button">Advanced Search</a></p>
<div class="search-form">
    <?php $this->renderPartial('_search',array(
	   'model' => $model,
    )); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'cssFile'      => false,
    'pager'        => array(
        'cssFile'              => false,
        'header'               => false,
        'htmlOptions'          => array('class' => 'pagination'),
        'prevPageLabel'        => '&laquo;',
        'previousPageCssClass' => 'arrow',
        'nextPageLabel'        => '&raquo;',
        'nextPageCssClass'     => 'arrow',
        'firstPageLabel'       => false,
        'firstPageCssClass'    => 'hide',
        'lastPageLabel'        => false,
        'lastPageCssClass'     => 'hide',
        'selectedPageCssClass' => 'current',
    ),
	'columns'      => array(
        'name',
        'username',
        array(
            'name'  => 'tagList',
            'value' => '$data->getTagList(true)',
            'type'  => 'raw',
        ),
        array(
            'class' => 'ButtonColumn',
        ),
	),
)); ?>

<?php $this->beginWidget('ext.EModal.EModal', array('id' => 'entry-form-modal')); ?>
    <h2>Update entry</h2>
    <?php $this->renderPartial('_form', array('model' => new Entry())); ?>
<?php $this->endWidget(); ?>