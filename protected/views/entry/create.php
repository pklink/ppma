<?php
    /* @var Entry $model */

    $this->breadcrumbs = array(
        'Entries' => array('index'),
        'Create',
    );

    $this->menu = array(
	   array('label' => 'Manage Entries', 'url' => array('index')),
    );
?>

<h1>Create Entry</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>