<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg"><?= __('Daftar akun baru.') ?></p>

        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'add']]) ?>

        <?= $this->Form->control('nama', [
            'placeholder' => __('Nama Lengkap'),
            'label' => false,
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('username', [
            'placeholder' => __('Username'),
            'label' => false,
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('email', [
            'placeholder' => __('Email'),
            'label' => false,
            'append' => '<i class="fas fa-envelope"></i>',
        ]) ?>

        <?= $this->Form->control('password', [
            'type' => 'password',
            'placeholder' => __('Password'),
            'label' => false,
            'append' => '<i class="fas fa-lock"></i>',
        ]) ?>

        <?= $this->Form->control('alamat', [
            'placeholder' => __('Alamat'),
            'label' => false,
            'append' => '<i class="fas fa-map-marker-alt"></i>',
        ]) ?>

        <div class="row">

            <div class="col-4 offset-4">
                <?= $this->Form->control(__('Register'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary btn-block',
                ]) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

        <div class="social-auth-links text-center mb-3">
            <p>
            Sudah memiliki akun? <?= $this->Html->link(__(' Masuk'), ['action' => 'login']) ?>
            </p>
        </div>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.register-card-body -->
</div>