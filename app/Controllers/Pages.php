<?php

namespace App\Controllers;

class Pages extends BaseController
{
    // membuat fungsi public jika dicarikan pada web/localhost
    public function index()
    {
        // data-data yang ingin ditampilkan dipanggil disini
        $data = [
            'title' =>   'Beranda | Sistem Pembelajaran'
        ];

        // memanggil link dan data pada page
        return view('pages/home', $data);
    }
    public function biodata()
    {
        $data = [
            'title' =>   'Biodata | Sistem Pembelajaran'
        ];
        return view('pages/biodata', $data);
    }
    public function kehadiran()
    {
        $data = [
            'title' =>   'Kehadiran | Sistem Pembelajaran',
            'hari' => [
                [
                    'satu' => 'senin',
                    'dua' => 'selasa',
                    'tiga' => 'rabu',
                    'pat' => 'kamis',
                    'lima' => 'jumat',
                ]
            ]


        ];
        return view('pages/kehadiran', $data);
    }
    public function pengumuman()
    {
        $data = [
            'title' =>   'Pengumuman | Sistem Pembelajaran'
        ];
        return view('pages/pengumuman', $data);
    }
}
