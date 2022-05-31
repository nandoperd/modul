<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'alamat'];


    public function search($keyword)
    {
        return $this->table('siswa')->like('nama', $keyword)->orLike('alamat', $keyword); //untuk fitur pencarian nama dan alamat, di ci query builder class
    }
}
