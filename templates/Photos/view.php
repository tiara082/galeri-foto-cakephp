<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Photo $photo
 */
?>

<?php
$this->assign('title', __('Photo'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Photos'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($photo->nama) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Nama') ?></th>
                <td><?= h($photo->nama) ?></td>
            </tr>
            <tr>
                <th><?= __('Foto') ?></th>
                <td>                             <img src="<?= $this->Url->build('/img/postingan/' . $photo->foto) ?>" alt="Photo Image" width="500" height="300">
</td>
            </tr>
            <tr>
                <th><?= __('Album') ?></th>
                <td><?= $photo->has('album') ? $this->Html->link($photo->album->nama, ['controller' => 'Albums', 'action' => 'view', $photo->album->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('User') ?></th>
                <td><?= $photo->has('user') ? $this->Html->link($photo->user->nama, ['controller' => 'Users', 'action' => 'view', $photo->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($photo->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($photo->created) ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $photo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $photo->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $photo->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Deskripsi') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($photo->deskripsi)); ?>
    </div>
</div>

<div class="related related-likephoto view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Related Likephotos') ?></h3>
        <div class="ml-auto">
            <?= $this->Html->link(__('New Likephoto'), ['controller' => 'Likephotos', 'action' => 'add', '?' => ['photo_id' => $photo->id]], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= $this->Html->link(__('List Likephotos'), ['controller' => 'Likephotos', 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Photo Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php if (empty($photo->likephotos)) : ?>
                <tr>
                    <td colspan="5" class="text-muted">
                        <?= __('Likephotos record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($photo->likephotos as $likephoto) : ?>
                    <tr>
                        <td><?= h($likephoto->id) ?></td>
                        <td><?= h($likephoto->created) ?></td>
                        <td><?= h($likephoto->user_id) ?></td>
                        <td><?= h($likephoto->photo_id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Likephotos', 'action' => 'view', $likephoto->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Likephotos', 'action' => 'edit', $likephoto->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Likephotos', 'action' => 'delete', $likephoto->id], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $likephoto->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

<div class="related related-photocomment view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Related Photocomments') ?></h3>
        <div class="ml-auto">
            <?= $this->Html->link(__('New Photocomment'), ['controller' => 'Photocomments', 'action' => 'add', '?' => ['photo_id' => $photo->id]], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= $this->Html->link(__('List Photocomments'), ['controller' => 'Photocomments', 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Isi') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Photo Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php if (empty($photo->photocomments)) : ?>
                <tr>
                    <td colspan="6" class="text-muted">
                        <?= __('Photocomments record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($photo->photocomments as $photocomment) : ?>
                    <tr>
                        <td><?= h($photocomment->id) ?></td>
                        <td><?= h($photocomment->isi) ?></td>
                        <td><?= h($photocomment->created) ?></td>
                        <td><?= h($photocomment->user_id) ?></td>
                        <td><?= h($photocomment->photo_id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Photocomments', 'action' => 'view', $photocomment->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Photocomments', 'action' => 'edit', $photocomment->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Photocomments', 'action' => 'delete', $photocomment->id], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $photocomment->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
