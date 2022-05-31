<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use Config\Validation;

class Siswa extends BaseController
{
    protected $SiswaModel;
    public function __construct()
    {
        $this->SiswaModel = new SiswaModel();
    }
    public function index()
    {
        //untuk mengurutkan nomor di tiap halaman
        $currentpage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $siswa = $this->SiswaModel->search($keyword);
        } else {
            $siswa = $this->SiswaModel;
        }


        // $modul = $this->ModulModel->findAll();
        $data = [
            'title' => 'Daftar Siswa',
            // 'siswa' => $this->SiswaModel->findAll()
            'siswa' => $siswa->paginate(10, 'siswa'),
            'pager' => $this->SiswaModel->pager,
            'currentpage' => $currentpage
        ];

        //tanpa model
        //$db = \Config\Database::connect();
        //$modul = $db->query("SELECT * FROM modul");
        //dd($modul);

        //$ModulModel = new \App\Models\ModulModel();
        //$ModulModel = new ModulModel();
        //dd($modul);





        return view('siswa/index', $data);
    }
}
