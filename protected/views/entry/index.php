<?php
    // set breadcrumbs
    $this->breadcrumbs = array(
        'Entries' => array('index'),
        'Manage',
    );
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

<div class="row page-nav" style="padding-bottom: 10px">
    <div class="ten columns" style="text-align: right; line-height: 2em">
        Results per page:
    </div>
    <div class="two columns" style="line-height: 2em" data-url="<?php echo CHtml::normalizeUrl(array('entry/index')) ?>">
        <?php echo CHtml::dropDownList(
            'pageSize',
            Setting::model()->name(Setting::PAGINATION_PAGE_SIZE_ENTRIES)->find()->value,
            array(5 => 5, 10 => 10, 25 => 25, 50 => 50, 100 => 100, 250 => 250)
        ) ?>
    </div>
</div>

<?php $this->widget('GridView', array(
    'id'           => 'entries',
    'ajaxUpdate'   => false,
    'dataProvider' => $model->search(),
    'cssFile'      => false,
	'columns'      => array(
	    array(
	        'class'  => 'EntryLinkColumn',
            'name'   => 'name',
            'header' => 'Name'
        ),
        'username',
        array(
            'name'  => 'tagList',
            'value' => '$data->getTagList(true)',
            'type'  => 'raw',
        ),
        array(
            'class' => 'EntryButtonColumn',
        ),
	),
)); ?>