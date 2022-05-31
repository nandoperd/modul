<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time; //buat time

use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'nama' => 'Upil',
        //         'alamat'    => 'Jambi',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'nama' => 'Ingus',
        //         'alamat'    => 'Jawa',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'nama' => 'Sasuke',
        //         'alamat'    => 'Jepang',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ]
        // ];

        $faker = \Faker\Factory::create('id_ID'); //id_ID itu maksudnya perscon indonesia wkwk
        for ($i = 0; $i < 100; $i++) {  //yok looping jangan lupa, pengulangan 100x itu
            $data = [
                'nama' => $faker->name,
                'alamat'    => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),  //pakai unixtime karena datetime ga bisa dipake karena datetime di faker masuk ke kategori object sedangkan time yg dibutuh CI adalah string
                'updated_at' => Time::now()
            ];
            $this->db->table('siswa')->insert($data); //insertbatch buat looping banyak data
        }

        //cara masukin datanya ada 2 pilihan :
        // Simple Queries, jadi harus satu2
        // $this->db->query(
        //     "INSERT INTO siswa (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)",
        //     $data
        // );

        // Using Query Builder, jadi tidak perlu lagi mengisi satu2 tinggal panggil datanya aja 
    }
}
