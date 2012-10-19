<?php

    /* @var EntryController $this */
    /* @var Entry $model */

    $this->breadcrumbs = array(
        'Entries'                => array('index'),
        'bla' => array('view', 'id' => $model->id),
        'Update',
    );

    $this->menu = array(
        array('label' => 'Manage Entry', 'url' => array('index')),
        array('label' => 'Create Entry', 'url' => array('create'), 'linkOptions' => array('rel' => 'fancy')),
    );
?>

<h1>Update "<?php echo CHtml::encode($model->identifier); ?>"</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>