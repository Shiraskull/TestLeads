<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomerOrder;
use App\Models\Leads;
use Carbon\Carbon;

class LeadsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ["UF25020019","21-2-2025","Customer 25","082313323221","Jalan Raya 1","KELURAHAN 25","KECAMATAN 20","KOTA 3","Mobil 9","MERAH",417482811,52400000,"Tunai"],
            ["UF25020032","28-2-2025","Customer 33","082313323222","Jalan Raya 2","KELURAHAN 33","KECAMATAN 26","KOTA 7","Mobil 11","MERAH",258845594,16396396,"Tunai"],
            ["UF25020023","24-2-2025","Customer 30","082313323223","Jalan Raya 3","KELURAHAN 30","KECAMATAN 24","KOTA 6","Mobil 12","MERAH",278250233,15000000,"Tunai"],
            ["UF25020026","27-2-2025","Customer 10","082313323224","Jalan Raya 4","KELURAHAN 10","KECAMATAN 9","KOTA 7","Mobil 12","MERAH",278250233,15000000,"Tunai"],
            ["UF25020034","28-2-2025","Customer 29","082313323225","Jalan Raya 5","KELURAHAN 29","KECAMATAN 23","KOTA 5","Mobil 1","HITAM",177482576,10000000,"Tunai"],
            ["UF25020010","15-2-2025","Customer 13","082313323226","Jalan Raya 6","KELURAHAN 13","KECAMATAN 11","KOTA 6","Mobil 1","HITAM",177482576,10000000,"Tunai"],
            ["UF25020017","19-2-2025","Customer 1","082313323227","Jalan Raya 7","KELURAHAN 1","KECAMATAN 1","KOTA 8","Mobil 1","HITAM",177482576,10000000,"Tunai"],
            ["UF25020025","27-2-2025","Customer 5","082313323228","Jalan Raya 8","KELURAHAN 5","KECAMATAN 5","KOTA 6","Mobil 3","HITAM",151371878,10000000,"Tunai"],
            ["UF25020011","15-2-2025","Customer 3","082313323229","Jalan Raya 9","KELURAHAN 3","KECAMATAN 3","KOTA 2","Mobil 4","HITAM",162139094,10000000,"Tunai"],
            ["UF25020007","13-2-2025","Customer 27","082313323230","Jalan Raya 10","KELURAHAN 27","KECAMATAN 22","KOTA 3","Mobil 4","HITAM",163352944,10000000,"Tunai"],
            ["UF25020016","19-2-2025","Customer 12","082313323231","Jalan Raya 11","KELURAHAN 12","KECAMATAN 11","KOTA 6","Mobil 5","HITAM",267521361,59300000,"Tunai"],
            ["UF25020003","10-2-2025","Customer 32","082313323232","Jalan Raya 12","KELURAHAN 32","KECAMATAN 25","KOTA 3","Mobil 9","HITAM",333063548,40180181,"Tunai"],
            ["UF25020006","13-2-2025","Customer 23","082313323233","Jalan Raya 13","KELURAHAN 23","KECAMATAN 18","KOTA 6","Mobil 9","HITAM",323484000,45180181,"Tunai"],
            ["UF25020015","19-2-2025","Customer 31","082313323234","Jalan Raya 14","KELURAHAN 31","KECAMATAN 24","KOTA 6","Mobil 9","HITAM",417742789,52400000,"Tunai"],
            ["UF25020021","22-2-2025","Customer 16","082313323235","Jalan Raya 15","KELURAHAN 16","KECAMATAN 12","KOTA 6","Mobil 2","KUNING",221558469,10000000,"Tunai"],
            ["UF25020014","18-2-2025","Customer 6","082313323236","Jalan Raya 16","KELURAHAN 6","KECAMATAN 6","KOTA 6","Mobil 1","ABU - ABU",177482576,10000000,"Tunai"],
            ["UF25020033","28-2-2025","Customer 14","082313323237","Jalan Raya 17","KELURAHAN 14","KECAMATAN 11","KOTA 6","Mobil 1","ABU - ABU",177482576,10000000,"Tunai"],
            ["UF25020024","26-2-2025","Customer 26","082313323238","Jalan Raya 18","KELURAHAN 26","KECAMATAN 21","KOTA 6","Mobil 1","ABU - ABU",177214719,10300000,"Kredit"],
            ["UF25020004","11-2-2025","Customer 11","082313323239","Jalan Raya 19","KELURAHAN 11","KECAMATAN 10","KOTA 6","Mobil 2","ABU - ABU",206280590,27000000,"Kredit"],
            ["UF25020013","17-2-2025","Customer 20","082313323240","Jalan Raya 20","KELURAHAN 20","KECAMATAN 16","KOTA 3","Mobil 8","ABU - ABU",223119697,61600000,"Kredit"],
            ["UF25020029","27-2-2025","Customer 4","082313323241","Jalan Raya 21","KELURAHAN 4","KECAMATAN 4","KOTA 1","Mobil 10","ABU - ABU",236602026,25741041,"Kredit"],
            ["UF25020005","12-2-2025","Customer 9","082313323242","Jalan Raya 22","KELURAHAN 9","KECAMATAN 8","KOTA 6","Mobil 9","PUTIH",327948286,40180181,"Kredit"],
            ["UF25020008","13-2-2025","Customer 28","082313323243","Jalan Raya 23","KELURAHAN 28","KECAMATAN 22","KOTA 3","Mobil 9","PUTIH",417482811,45000000,"Kredit"],
            ["UF25020002","7-2-2025","Customer 21","082313323244","Jalan Raya 24","KELURAHAN 21","KECAMATAN 17","KOTA 2","Mobil 6","PUTIH",254029006,52684685,"Kredit"],
            ["UF25020031","28-2-2025","Customer 22","082313323245","Jalan Raya 25","KELURAHAN 22","KECAMATAN 17","KOTA 2","Mobil 4","MERAH CERAH",162139094,10000000,"Kredit"],
            ["UF25020020","22-2-2025","Customer 7","082313323246","Jalan Raya 26","KELURAHAN 7","KECAMATAN 6","KOTA 6","Mobil 7","MERAH CERAH",270891383,65000000,"Kredit"],
            ["UF25020001","4-2-2025","Customer 19","082313323247","Jalan Raya 27","KELURAHAN 19","KECAMATAN 15","KOTA 6","Mobil 9","COKLAT PASIR",317522075,32000000,"Kredit"],
            ["UF25020009","14-2-2025","Customer 18","082313323248","Jalan Raya 28","KELURAHAN 18","KECAMATAN 14","KOTA 3","Mobil 9","COKLAT PASIR",325367281,48800000,"Kredit"],
            ["UF25020028","27-2-2025","Customer 8","082313323249","Jalan Raya 29","KELURAHAN 8","KECAMATAN 7","KOTA 4","Mobil 9","COKLAT PASIR",322723422,51750000,"Kredit"],
            ["UF25020012","17-2-2025","Customer 15","082313323250","Jalan Raya 30","KELURAHAN 15","KECAMATAN 11","KOTA 6","Mobil 9","COKLAT PASIR",417742789,52400000,"Kredit"],
            ["UF25020022","24-2-2025","Customer 24","082313323251","Jalan Raya 31","KELURAHAN 24","KECAMATAN 19","KOTA 3","Mobil 1","PUTIH",177482576,10000000,"Kredit"],
            ["UF25020027","27-2-2025","Customer 2","082313323252","Jalan Raya 32","KELURAHAN 2","KECAMATAN 2","KOTA 6","Mobil 1","PUTIH",178914365,8396396,"Kredit"],
            ["UF25020018","21-2-2025","Customer 34","082313323253","Jalan Raya 33","KELURAHAN 34","KECAMATAN 27","KOTA 6","Mobil 1","PUTIH",175696862,12000000,"Kredit"],
            ["UF25020030","28-2-2025","Customer 17","082313323254","Jalan Raya 34","KELURAHAN 17","KECAMATAN 13","KOTA 3","Mobil 4","PUTIH",161567229,12000000,"Kredit"],
        ];

        foreach ($data as $item) {
            Leads::create([
                'nomor' => $item[0],
                'tanggal' => Carbon::createFromFormat('d-m-Y', $item[1]),
                'nama' => $item[2],
                'nohp' => $item[3],
                'alamat' => $item[4],
                'kelurahan' => $item[5],
                'kecamatan' => $item[6],
                'kota' => $item[7],
                'tipe' => $item[8],
                'warna' => $item[9],
                'hargajual' => $item[10],
                'discount' => $item[11],
                'status' => $item[12],
            ]);
        }
    }
}
