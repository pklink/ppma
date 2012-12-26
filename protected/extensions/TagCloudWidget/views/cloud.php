<div id="tag-cloud" class="panel">

    <h5><?php echo $this->title ?></h5>
    <div class="settings"><i class="foundicon-settings"></i></div>

    <?php if (count($tags) == 0) : ?>
        <i>no tags found</i>
    <?php else : ?>
        <?php foreach ($tags as $tag) : ?>
            <span class="weight-<?php echo $tag['weight'] ?>">
                <?php echo CHtml::link(CHtml::encode($tag['name']), array('entry/index', 'Entry[tagList]' => $tag['name'])) ?>
            </span>
        <?php endforeach; ?>
    <?php endif; ?>

</div>