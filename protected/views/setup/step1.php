<?php
?>

<h1>Requirements</h1>

<div class="form">
    <form>
        <h2>Environment</h2>
        <table class="setup req">
            <tr>
                <td>PHP-Version >= 5.0</td>
                <?php $value = $phpVersion ? 'true' : 'false'; ?>
                <td class="<?php echo $value ?>"><?php echo $value ?></td>
            </tr>
            <tr>
                <td>php5-mcrypt</td>
                <?php $value = $isMcryptLoaded ? 'true' : 'false'; ?>
                <td class="<?php echo $value ?>"><?php echo $value ?></td>
            </tr>
            <tr>
                <td>php5-pdo</td>
                <?php $value = $isPDOLoaded ? 'true' : 'false'; ?>
                <td class="<?php echo $value ?>"><?php echo $value ?></td>
            </tr>
            <tr>
                <td>php5-pdo_mysql</td>
                <?php $value = $isPDO_mysqlLoaded ? 'true' : 'false'; ?>
                <td class="<?php echo $value ?>"><?php echo $value ?></td>
            </tr>
        </table>

        <h2>Permissions</h2>
        <table class="setup req">
            <?php foreach ($permissions as $path => $isWritable) : ?>
                <tr>
                    <td><?php echo $path ?></td>
                    <td class="<?php echo ($isWritable ? 'true' : 'false') ?>"><?php echo ($isWritable ? 'writable' : 'not writable') ?></td>
                </tr>
            <?php endforeach ?>
        </table>

        <?php if ($continue) : ?>
            <a class="setup" href="<?php echo $this->createUrl('setup/', array('step' => 2)) ?>">
                <?php echo CHtml::button('Next »', array('class' => 'button radius'))?>
            </a>
        <?php endif; ?>
    </form>
</div>
