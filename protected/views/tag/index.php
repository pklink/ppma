<?php
    $this->breadcrumbs = array(
        'Tags' => array('index'),
        'Manage',
    );

    $this->menu = array(
        array('label' => 'Create Tag', 'url' => array('create'), 'linkOptions' => array('rel' => 'fancy')),
    );

?>

<h1>Manage Tags</h1>

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
    <div class="two columns" style="line-height: 2em" data-url="<?php echo CHtml::normalizeUrl(array('tag/index')) ?>">
        <?php echo CHtml::dropDownList(
            'pageSize',
            Setting::model()->name(Setting::PAGINATION_PAGE_SIZE_TAGS)->find()->value,
            array(5 => 5, 10 => 10, 25 => 25, 50 => 50, 100 => 100, 250 => 250)
        ) ?>
    </div>
</div>

<?php $this->widget('GridView', array(
    'ajaxUpdate'   => false,
    'dataProvider' => $model->search(),
    'cssFile'      => false,
	'columns'      => array(
        'name',
        array(
            'value'  => '$data->entryCounter',
            'header' => 'Used',
        ),
        array(
            'class' => 'ButtonColumn',
            'buttons' => array(
                'view' => array(
                    'url' => 'array("entry/index", "Entry[tagList]" => $data->name)',
                ),
                'update' => array(
                    'url' => 'array("tag/update", "id" => $data->id, "returnUrl" => Yii::app()->request->requestUri)',
                )
            )
        ),
	),
)); ?>