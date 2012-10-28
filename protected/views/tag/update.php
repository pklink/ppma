<?php
    $this->breadcrumbs = array(
        'Tags'         => array('index'),
        $model->name,
        'Update',
    );

    $this->menu = array(
        array('label' => 'Manage Tags', 'url' => array('index')),
        array('label' => 'Create Tag', 'url' => array('create'), 'linkOptions' => array('rel' => 'fancy')),
    );
?>

<h1>Update "<?php echo CHtml::encode($model->name); ?>"</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>