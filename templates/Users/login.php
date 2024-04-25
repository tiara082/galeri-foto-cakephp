<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg"><?= __('Masuk ke Website Galeri Foto') ?></p>

        <?= $this->Form->create() ?>

        <?= $this->Form->control('username', [
            'label' => false,
            'placeholder' => __('Username'),
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('password', [
            'label' => false,
            'placeholder' => __('Password'),
            'append' => '<i class="fas fa-lock"></i>',
        ]) ?>

        <div class="row">
            <div class="col-4 offset-4"> <!-- Menambahkan kelas offset-4 untuk memusatkan kolom di tengah -->
                <?= $this->Form->control(__('Masuk'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

        <div class="social-auth-links text-center mb-3">
            <p>
            Belum memiliki akun? <?= $this->Html->link(__('Daftar'), ['action' => 'register']) ?>
            </p>
        </div>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
</div>
