<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Photo[]|\Cake\Collection\CollectionInterface $photos
 * @var int $jumlahFoto
 * @var int $jumlahKoleksiPribadi
 * @var int $jumlahLikes
 */
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Style CSS -->
<style>
    /* Tombol Like default */
    .like-button {
        color: red; /* Warna tulisan */
        border-color: red; /* Warna border */
        transition: color 0.3s, background-color 0.3s; /* Transisi perubahan warna */
    }

    /* Ketika tombol di-hover */
    .like-button:hover {
        background-color: red; /* Warna background saat di-hover */
        color: white; /* Warna tulisan saat di-hover */
        transition: color 0.3s, background-color 0.3s; /* Transisi perubahan warna */
    }

    /* Ikon hati default */
    .heart-icon {
        color: red; /* Warna ikon hati */
        transition: color 0.3s; /* Transisi perubahan warna */
    }

    /* Ketika tombol di-hover, ikon hati juga berubah warna */
    .like-button:hover .heart-icon {
        color: white; /* Warna ikon saat di-hover */
        transition: color 0.3s; /* Transisi perubahan warna */
    }    
    .like-button.on .heart-icon {
        color: white; /* Warna ikon saat di-hover */
        transition: color 0.3s; /* Transisi perubahan warna */
    }

    /* Style untuk tombol ter-disable */
    .like-button.on {
        background-color: red; /* Warna background saat ter-disable */
        color: white; /* Warna tulisan saat ter-disable */
        border-color: red; /* Warna border saat ter-disable */
    }
</style>

<?php
$this->assign('title', __('Users'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('Halaman Utama')],
]);
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <!-- Tambahkan sidebar dengan informasi user dan koleksi -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <!-- Informasi user -->
                        <div class="text-center">
                            <!-- Tambahkan gambar profil user -->
                            <img class="profile-user-img img-fluid img-circle" src="https://randomuser.me/api/portraits/lego/1.jpg" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center"><?= $this->Identity->get('username') ?></h3>
                        <p class="text-muted text-center"><?= $this->Identity->get('email') ?></p>
                        <!-- Informasi statistik -->
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Jumlah Foto</b> <span class="float-right"><?= $jumlahFoto ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Jumlah Koleksi Pribadi</b> <span class="float-right"><?= $jumlahKoleksiPribadi ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Total Suka</b> <span class="float-right"><?= $jumlahLikes ?></span>
                            </li>
                        </ul>
                        <!-- Tombol follow -->
                        <?= $this->Html->link(__('View Profile'), ['action' => 'view', $this->Identity->get('id')], ['class' => 'btn btn-primary btn-block', 'escape' => false]) ?>
                    </div>
                    
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Album Pribadi</h3>
                    </div>

                    <div class="card-body">
                        <?php foreach ($albumsByUser as $album): ?>
                            <strong><i class="fas fa-book mr-1"></i> <?= h($album->nama) ?></strong>
                            <!-- Informasi album -->
                            <p class="text-muted"><strong> Created:    </strong><?= $album->created->format('F d, Y') ?></p>
                            <!-- Informasi lainnya sesuai kebutuhan -->
                            <div class="card-tools">
                                <!-- Tombol untuk melihat album -->
                                <?= $this->Html->link(__('View'), ['action' => 'view', $album->id], ['class' => 'btn btn-info btn-sm']) ?>
                                <!-- Tombol untuk mengedit album -->
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $album->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                <!-- Tombol untuk menghapus album -->
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $album->id], ['confirm' => __('Are you sure you want to delete {0}?', $album->name), 'class' => 'btn btn-danger btn-sm']) ?>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
            <!-- Konten utama -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-primary p-3">
                        <h3 class="card-title fw-bold">Galeri Komunitas</h3>
                    </div>
                    <div class="card-body">
                        <!-- Isi tab -->
                        <div class="tab-content">
                            <!-- Tab Aktivitas -->
                            <div class="active tab-pane" id="activity">
                                <!-- Looping untuk menampilkan koleksi foto -->
                                <?php foreach ($photos as $photo): ?>
                                    <div class="post">
                                        <!-- Informasi pengguna yang memposting -->
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="https://randomuser.me/api/portraits/lego/1.jpg" alt="user image">
                                            <span class="username">
                                                <a href="#"><?= $photo->user->username ?></a>
                                            </span>
                                            <span class="description"><?= $photo->created->timeAgoInWords() ?></span>
                                        </div>
                                        
                                        <!-- Gambar foto -->
                                        <img class="img-fluid" src="<?= $this->Url->build('/img/postingan/' . $photo->foto) ?>" alt="Photo Image">
                                        <!-- Deskripsi foto -->
                                        <br><br>
                                        <p><?= $photo->deskripsi ?></p>
                                        <p>
                                            <!-- Tombol aksi Like -->
                                            <?php
                                            $likeClass = 'btn btn-outline-danger like-button link-black text-sm';
                                            if ($photo->is_liked) {
                                                $likeClass .= ' on'; // Menambahkan class disabled jika sudah dilike
                                            }
                                            ?>
                                            <?= $this->Form->postLink(
                                                '<i class="far fa-heart heart-icon mr-1"></i> ' . ($photo->is_liked ? 'Unlike' : 'Like'), // Label tombol disesuaikan dengan status like
                                                ['controller' => 'Likephotos', 'action' => ($photo->is_liked ? 'delete' : 'add')], // URL aksi Like atau Unlike
                                                ['class' => $likeClass, 'escape' => false, 'data' => ['photo_id' => $photo->id]] // Opsi tambahan, seperti class, data tambahan
                                            ) ?>
                                        </p>

                                        <div class="card direct-chat direct-chat-primary">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Lihat Komentar</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body" style="display: block;">
    <div class="direct-chat-messages">
        <!-- Chat bubbles -->
        <?php foreach ($photo->comments as $comment): ?>
            <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left"><?= $comment->user->username ?></span>
                    <span class="direct-chat-timestamp float-right"><?= $comment->created->format('d M Y H:i') ?></span>
                    <!-- Ubah format timestamp sesuai kebutuhan -->
                </div>

                <img class="direct-chat-img" src="https://randomuser.me/api/portraits/lego/2.jpg" alt="message user image">


                <div class="direct-chat-text">
                    <?= $comment->isi ?>
                </div>

                
            </div>
        <?php endforeach; ?>

 </div>

    <!-- Chat input form -->

    <div class="card-footer" style="display: block; ">
    <form action="<?= $this->Url->build(['controller' => 'Photocomments', 'action' => 'add']) ?>" method="post">
        <!-- Tambahkan CSRF token -->
        <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]) ?>
        <!-- Input untuk isi komentar -->
        <div class="input-group">
            <input type="text" name="isi" placeholder="Type Message ..." class="form-control">
            <!-- Masukkan user_id dan photo_id sebagai hidden fields -->
            <input type="hidden" name="user_id" value="<?= $this->Identity->get('id') ?>">
            <input type="hidden" name="photo_id" value="<?= $photo->id ?>">
            <span class="input-group-append">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </span>
        </div>
    </form>
</div>



   
        </div>
</div>

                                     </div>
                                    <hr>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- JavaScript untuk menghilangkan tombol Like saat sudah dilike -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeButtons = document.querySelectorAll('.like-button');
        likeButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                const isLiked = this.classList.contains('on');
                if (isLiked) {
                    this.style.display = 'none'; // Menghilangkan tombol Like saat sudah dilike
                }
            });
        });
    });
</script>
