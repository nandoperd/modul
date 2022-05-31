<?php

namespace App\Models;

use CodeIgniter\Model;

class ModulModel extends Model
{
    // menyalakan database table modul pada database
    protected $table = 'modul';
    // menyalakan fitur useTimestamps untuk create dan update at
    protected $useTimestamps = true;
    // menyalakan data-data yang bisa diubah pada database
    protected $allowedFields = ['judul', 'slugh', 'penulis', 'penerbit', 'sampul'];

    //membuat tampilan jika slugh tidak ada maka menampilkan senmua data, kalau ada menampilkan detail data tsb
    public function getmodul($slugh = false)
    {
        if ($slugh == false) {
            return $this->findAll();
        }

        return $this->where(['slugh' => $slugh])->first();
    }
}
