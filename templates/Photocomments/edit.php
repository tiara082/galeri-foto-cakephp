<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Photocomment $photocomment
 */
?>

<?php
$this->assign('title', __('Edit Photocomment'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Photocomments'), 'url' => ['action' => 'index']],
    ['title' => __('View'), 'url' => ['action' => 'view', $photocomment->id]],
    ['title' => __('Edit')],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($photocomment) ?>
    <div class="card-body">
        <?= $this->Form->control('isi') ?>
        <?= $this->Form->hidden('user_id', ['value' => $this->Identity->get('id'), 'readonly' => true]) ?>
        <?= $this->Form->control('photo_id', ['options' => $photos, 'class' => 'form-control']) ?>
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
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'view', $photocomment->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>