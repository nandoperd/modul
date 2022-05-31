<!-- memanggil template dari header s/d navbar -->
<?= $this->extend('layout/template'); ?>

<!-- memanggil content untuk page ini -->
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Selamat datang</h1>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>