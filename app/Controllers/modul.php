<?php

namespace App\Controllers;

use App\Models\ModulModel;
use Config\Validation;

class Modul extends BaseController
{
    // menyalakan protected model terlrbih dahulu
    protected $ModulModel;

    // menyalakan construct agar bisa memakai semua method
    public function __construct()
    {
        $this->ModulModel = new ModulModel();
    }
    public function index()
    {
        // $modul = $this->ModulModel->findAll();
        $data = [
            'title' => 'Daftar Modul',
            'modul' => $this->ModulModel->getmodul()
        ];

        //tanpa model
        //$db = \Config\Database::connect();
        //$modul = $db->query("SELECT * FROM modul");
        //dd($modul);

        //$ModulModel = new \App\Models\ModulModel();
        //$ModulModel = new ModulModel();
        //dd($modul);





        return view('modul/index', $data);
    }

    public function detail($slugh)
    {
        $data = [
            'title' => 'Detail Modul',
            // melemparkan ke ModulModel.php
            'modul' => $this->ModulModel->getmodul($slugh)
        ];
        //jika data modul tidak ada menampilkan pesan
        if (empty($data['modul'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Modul ' . $slugh . ' tidak ditemukan.');
        }
        return view('modul/detail', $data);
    }

    public function create()
    {
        // session(); tapi session tidak ditulis disini lagi karena sudah ditaruh pada file BaseController.php
        $data = [
            'title' => 'Form tambah modul',

            //memanggil validation yang akan diakses save
            'validation' => \config\Services::validation()
        ];

        return view('modul/create', $data);
    }

    public function save()
    {
        //validasi input
        //menggunakan kondisi (if) menggunakan rules/aturan yang kita buat. bisa dilihat di dokumentasi ci validate available rules
        if (!$this->validate([
            'judul' => [

                // wajib diisi dan unik (tidak boleh ada yang sama data pada tabelnya)
                'rules' => 'required|is_unique[modul.judul]',

                //rules jika ada error
                'errors' => [
                    'required' => '{field} modul harus diisi.',
                    'is_unique' => '{field} modul sudah terdaftar.',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar kegedean',
                    'is_image' => 'pilih gambar woy',
                    'mime_in' => 'pilih gambar woy',
                ]
            ]
        ])) {
            // $validation = \config\Services::validation();
            // return redirect()->to('/modul/create')->withInput()->with('Validation', $validation);

            //withinput gunanya untuk menyimpan apa yang sudah diinput ke dalam session
            return redirect()->to('/modul/create')->withInput();
        }
        //ambil gambar
        $filesampul = $this->request->getFile('sampul');
        //apakah ada gambar yg diupload
        if ($filesampul->getError() == 4) {
            $namasampul = 'default.png';
        } else {
            //generate nama sampul random
            $namasampul = $filesampul->getRandomName();

            //pindah file ke folder img
            $filesampul->move('img', $namasampul);
        }

        // membuat data unik slugh, karena slugh disini tidak boleh sama dengan data manapun
        $slugh = url_title($this->request->getVar('judul'), '-', true);

        // fitur save pada sistem ini
        $this->ModulModel->save([
            'judul' => $this->request->getVar('judul'),
            'slugh' => $slugh,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namasampul
        ]);

        //menampilkan pesan bahwa data berhasil disimpan
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/modul');
    }

    public function delete($id)
    {

        // cari gambar berdasarkan id
        $modul = $this->ModulModel->find($id);

        // cek jika gambarnya default
        if ($modul['sampul'] != 'default.png') {

            // hapus file gambar
            unlink('img/' . $modul['sampul']);
        }


        $this->ModulModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/modul');
    }

    public function edit($slugh)
    {
        $data = [
            'title' => 'Form ubah data modul',
            'validation' => \config\Services::validation(),
            'modul' => $this->ModulModel->getmodul($slugh)
        ];

        return view('modul/edit', $data);
    }

    public function update($id)
    {
        //cek judul
        $modullama = $this->ModulModel->getmodul($this->request->getVar('slugh'));
        if ($modullama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[modul.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} modul harus diisi.',
                    'is_unique' => '{field} modul sudah terdaftar.',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar kegedean',
                    'is_image' => 'pilih gambar woy',
                    'mime_in' => 'pilih gambar woy',
                ]
            ]
        ])) {

            return redirect()->to('/modul/edit/' . $this->request->getVar('slugh'))->withInput();
        }

        $filesampul = $this->request->getFile('sampul');

        //cek gambar apakah tetap gambar lama
        if ($filesampul->getError() == 4) {
            $namasampul = $this->request->getVar('sampullama');
        } else {
            //generate nama sampul random
            $namasampul = $filesampul->getRandomName();

            //pindah file ke folder img
            $filesampul->move('img', $namasampul);

            //hapus file lama
            unlink('img/' . $this->request->getVar('sampullama'));
        }


        $slugh = url_title($this->request->getVar('judul'), '-', true);
        $this->ModulModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slugh' => $slugh,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namasampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/modul');
    }
}
