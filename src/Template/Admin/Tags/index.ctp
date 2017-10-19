<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Tags.Tag[]|\Cake\Collection\CollectionInterface $tags
  */
?>

<?php $this->start("heading"); ?>
Tags
<?php $this->end("heading"); ?>
<?php $this->start("heading_action"); ?>
<a href="" class="btn btn-primary">Add New Tag</a>
<?php $this->end("heading_action"); ?>
<div class="tags index ibox-content white-bg">
    <?php echo $this->element("paginator-nav") ?>
    <table cellpadding="0" cellspacing="0" class='table table-striped table-hover'>
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?= $this->Number->format($tag->id) ?></td>
                <td><?= h($tag->name) ?></td>
                <td><?= h($tag->created) ?></td>
                <td><?= h($tag->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tag->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tag->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
