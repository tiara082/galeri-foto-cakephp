<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php
$this->assign('title', __('User'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Users'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($user->nama) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Nama') ?></th>
                <td><?= h($user->nama) ?></td>
            </tr>
            <tr>
                <th><?= __('Username') ?></th>
                <td><?= h($user->username) ?></td>
            </tr>
            <tr>
                <th><?= __('Email') ?></th>
                <td><?= h($user->email) ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($user->id) ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Alamat') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($user->alamat)); ?>
    </div>
</div>

<div class="related related-album view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Related Albums') ?></h3>
        <div class="ml-auto">
            <?= $this->Html->link(__('New Album'), ['controller' => 'Albums', 'action' => 'add', '?' => ['user_id' => $user->id]], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= $this->Html->link(__('List Albums'), ['controller' => 'Albums', 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Nama') ?></th>
                <th><?= __('Deskripsi') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('User Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php if (empty($user->albums)) : ?>
                <tr>
                    <td colspan="6" class="text-muted">
                        <?= __('Albums record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($user->albums as $album) : ?>
                    <tr>
                        <td><?= h($album->id) ?></td>
                        <td><?= h($album->nama) ?></td>
                        <td><?= h($album->deskripsi) ?></td>
                        <td><?= h($album->created) ?></td>
                        <td><?= h($album->user_id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Albums', 'action' => 'view', $album->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Albums', 'action' => 'edit', $album->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Albums', 'action' => 'delete', $album->id], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $album->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

<div class="related related-likephoto view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Related Likephotos') ?></h3>
        <div class="ml-auto">
            <?= $this->Html->link(__('New Likephoto'), ['controller' => 'Likephotos', 'action' => 'add', '?' => ['user_id' => $user->id]], ['class' => 'btn btn-primary btn-sm']) ?>
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
            <?php if (empty($user->likephotos)) : ?>
                <tr>
                    <td colspan="5" class="text-muted">
                        <?= __('Likephotos record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($user->likephotos as $likephoto) : ?>
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
            <?= $this->Html->link(__('New Photocomment'), ['controller' => 'Photocomments', 'action' => 'add', '?' => ['user_id' => $user->id]], ['class' => 'btn btn-primary btn-sm']) ?>
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
            <?php if (empty($user->photocomments)) : ?>
                <tr>
                    <td colspan="6" class="text-muted">
                        <?= __('Photocomments record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($user->photocomments as $photocomment) : ?>
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

<div class="related related-photo view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Related Photos') ?></h3>
        <div class="ml-auto">
            <?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add', '?' => ['user_id' => $user->id]], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Nama') ?></th>
                <th><?= __('Deskripsi') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Foto') ?></th>
                <th><?= __('Album Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php if (empty($user->photos)) : ?>
                <tr>
                    <td colspan="8" class="text-muted">
                        <?= __('Photos record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($user->photos as $photo) : ?>
                    <tr>
                        <td><?= h($photo->id) ?></td>
                        <td><?= h($photo->nama) ?></td>
                        <td><?= h($photo->deskripsi) ?></td>
                        <td><?= h($photo->created) ?></td>
                        <td><?= h($photo->foto) ?></td>
                        <td><?= h($photo->album_id) ?></td>
                        <td><?= h($photo->user_id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Photos', 'action' => 'view', $photo->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Photos', 'action' => 'edit', $photo->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Photos', 'action' => 'delete', $photo->id], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $photo->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
