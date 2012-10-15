<?php
    $this->breadcrumbs = array(
        'Register',
    );
?>

<h1>Register</h1>

<?php if (Yii::app()->user->hasFlash('success')) : ?>
    <div class="flash-success">Successfully registered!</div>

<?php else : ?>
    <div class="form">
        <?php echo $form ?>
    </div>
<?php endif;?>