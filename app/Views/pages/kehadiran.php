<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Kehadiran :</h1>
            <h2>
                <?php foreach ($hari as $a) : ?>

                    <ul>
                        <li><?= $a['satu']; ?></li>
                        <li><?= $a['dua']; ?></li>
                        <li><?= $a['tiga']; ?></li>
                        <li><?= $a['pat']; ?></li>
                        <li><?= $a['lima']; ?></li>
                    </ul>
                <?php endforeach; ?>

            </h2>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>