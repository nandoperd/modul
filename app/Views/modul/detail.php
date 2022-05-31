<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Modul</h2>
            <!-- diambil dari bootsrap card -->
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $modul['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $modul['judul'] ?></h5>
                            <p class="card-text"><b>Penulis :</b> <?= $modul['penulis'] ?> </p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit :</b> <?= $modul['penerbit'] ?></small></p>

                            <a href="/modul/edit/<?= $modul['slugh']; ?>" class="btn btn-warning">Edit</a>

                            <!-- membuat html methode spoofing untuk keperluan fitur delete agar tidak konvensional (bisa dihapus asal oleh oknum) d-inline : biar sejajar-->
                            <form action="/modul/<?= $modul['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>

                                <!-- mengakali delete/http method spoofing -->
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                            </form>

                            <br> </br>
                            <a href="/modul">Kembali ke daftar modul</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>