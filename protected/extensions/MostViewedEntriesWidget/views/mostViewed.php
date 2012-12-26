<?php /* @var Entry[] $models */ ?>

<div id="most-viewed-entries" class="panel">

    <h5><?php echo $this->title ?></h5>
    <div class="settings"><i class="foundicon-settings"></i></div>

    <?php if (count($models) == 0) : ?>
        <i>no entries found</i>
    <?php else : ?>
        <ul>
            <?php foreach ($models as $model) : ?>
                <li>
                    <?php echo CHtml::link((strlen($model->name) == 0 ? '<i>- no name given -</i>' : CHtml::encode($model->name)), array('/entry/update', 'id' => $model->id), array(
                        'data-reveal-id' => 'entry-form-modal',
                        'rel'            => CHtml::normalizeUrl(array('/entry/getData', 'id' => $model->id, 'withPassword' => 1)),
                        'class'          => 'update-entry',
                        'title'          => sprintf('has been viewed %d time(s)', $model->viewCount),
                    )) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>