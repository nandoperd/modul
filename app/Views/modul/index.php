<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/modul/create" class="btn btn-primary mt-3">Tambah modul</a>
            <h1 class="mt-3">Daftar Modul</h1>

            <!-- memilah jika isi daftar modul berhasil atau tidak -->
            <!-- membuat pesan notifikasi -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Pelajaran</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- membuat nomor berurutan -->
                    <?php $i = 1; ?>

                    <!-- mengambil data dari modul.php  -->
                    <?php foreach ($modul as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>

                            <!-- memanggil link pada dokumen sampul yang bentuknya gambar jpg dan memanggil class sampul di style.css -->
                            <td><img src="img/<?= $m['sampul']; ?>" alt="" class="sampul"></td>
                            <td><?= $m['judul']; ?></td>
                            <td>

                                <!-- memanggil aksi dengan menggunakan slugh (data yang sudah dibuat unik) -->
                                <a href="/modul/<?= $m['slugh']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>