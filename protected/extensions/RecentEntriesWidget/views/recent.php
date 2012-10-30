<?php /* @var Entry[] $models */ ?>

<div class="recent-entries panel">

    <h5><?php echo $this->title ?></h5>

    <?php if (count($models) == 0) : ?>
        <i>no entries found</i>
    <?php else : ?>
        <ul>
            <?php foreach ($models as $model) : ?>
                <li>
                    <?php echo CHtml::link(CHtml::encode($model->name), array('/entry/update', 'id' => $model->id), array(
                        'data-reveal-id' => 'entry-form-modal',
                        'rel'            => CHtml::normalizeUrl(array('/entry/getData', 'id' => $model->id, 'withPassword' => 1)),
                        'class'          => 'update-entry',
                    )) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>