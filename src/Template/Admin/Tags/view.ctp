<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Tags.Tag $tag
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tagged Items'), ['controller' => 'TaggedItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tagged Item'), ['controller' => 'TaggedItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tags view large-9 medium-8 columns content">
    <h3><?= h($tag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($tag->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($tag->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tag->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($tag->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tagged Items') ?></h4>
        <?php if (!empty($tag->tagged_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Foreign Key') ?></th>
                <th scope="col"><?= __('Display Order') ?></th>
                <th scope="col"><?= __('Tag Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tag->tagged_items as $taggedItems): ?>
            <tr>
                <td><?= h($taggedItems->id) ?></td>
                <td><?= h($taggedItems->created) ?></td>
                <td><?= h($taggedItems->model) ?></td>
                <td><?= h($taggedItems->foreign_key) ?></td>
                <td><?= h($taggedItems->display_order) ?></td>
                <td><?= h($taggedItems->tag_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TaggedItems', 'action' => 'view', $taggedItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TaggedItems', 'action' => 'edit', $taggedItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TaggedItems', 'action' => 'delete', $taggedItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taggedItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
