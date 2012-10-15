<?php
    $this->breadcrumbs = array(
        'Tags' => array('index'),
        'Create',
    );

    $this->menu = array(
	   array('label' => 'Manage Tags', 'url' => array('index')),
    );
?>

<h1>Create Tag</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>