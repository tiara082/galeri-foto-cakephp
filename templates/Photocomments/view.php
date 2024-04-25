<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Photocomment $photocomment
 */
?>

<?php
$this->assign('title', __('Photocomment'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Photocomments'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($photocomment->id) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('User') ?></th>
                <td><?= $photocomment->has('user') ? $this->Html->link($photocomment->user->nama, ['controller' => 'Users', 'action' => 'view', $photocomment->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Photo') ?></th>
                <td><?= $photocomment->has('photo') ? $this->Html->link($photocomment->photo->nama, ['controller' => 'Photos', 'action' => 'view', $photocomment->photo->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($photocomment->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($photocomment->created) ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $photocomment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $photocomment->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $photocomment->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Isi') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($photocomment->isi)); ?>
    </div>
</div>
