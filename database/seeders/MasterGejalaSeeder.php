<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterGejala;
use Illuminate\Support\Facades\DB;

class MasterGejalaSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MasterGejala::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $data = [
            // HP001 - Penggerek Buah Kopi
            ['id_gejala' => 'G001', 'nama_gejala' => 'Terdapat kotoran bekas gerekan di sekitar lubang masuk pada ujung bawah buah'],
            ['id_gejala' => 'G002', 'nama_gejala' => 'Pada buah muda: buah tidak berkembang, warna buah berubah menjadi kuning kemerahan dan buah gugur'],
            ['id_gejala' => 'G003', 'nama_gejala' => 'Pada buah tua: biji berlubang, biji kopi cacat dan penurunan mutu biji'],
            
            // HP002 - Penggerek Batang Merah
            ['id_gejala' => 'G004', 'nama_gejala' => 'Terdapat lubang masuk larva di permukaan kulit batang atau cabang dengan diameter sekitar 2 mm'],
            ['id_gejala' => 'G005', 'nama_gejala' => 'Terdapat serbuk gerek berbentuk bulatan kecil berdiameter 1–2 mm dengan warna cokelat kemerahan yang terkumpul di bawah pohon jika larva masih aktif'],
            ['id_gejala' => 'G006', 'nama_gejala' => 'Daun tanaman layu kemudian rontok, tanaman menjadi kering, dan akhirnya mati'],
            ['id_gejala' => 'G007', 'nama_gejala' => 'Bagian tanaman di atas gerekan mengering, mati, dan mudah patah apabila luas gerekan melingkar dan bertemu'],
            
            // HP003 - Penggerek Cabang
            ['id_gejala' => 'G008', 'nama_gejala' => 'Terdapat lubang gerekan pada cabang dan ranting dengan diameter 1-2 mm'],
            ['id_gejala' => 'G009', 'nama_gejala' => 'Cabang dan ranting yang terserang menjadi rapuh dan mudah patah'],
            
            // HP004 - Kutu Hijau
            ['id_gejala' => 'G010', 'nama_gejala' => 'Daun menguning dan mengering pada bagian ujung cabang'],
            ['id_gejala' => 'G011', 'nama_gejala' => 'Terdapat koloni kutu berwarna hijau pada permukaan bawah daun'],
            ['id_gejala' => 'G012', 'nama_gejala' => 'Permukaan bawah daun ditumbuhi jamur embun jelaga berwarna hitam'],
            ['id_gejala' => 'G013', 'nama_gejala' => 'Daun dan batang muda ditutupi embun jelaga sehingga mengganggu proses fotosintesis'],
            
            // HP005 - Wereng
            ['id_gejala' => 'G014', 'nama_gejala' => 'Daun berlubang kecil akibat tusukan wereng'],
            ['id_gejala' => 'G015', 'nama_gejala' => 'Terdapat bercak-bercak kuning pada daun'],
            ['id_gejala' => 'G016', 'nama_gejala' => 'Pertumbuhan tanaman terhambat, tunas cacat bentuknya, rontok, atau mati'],
            ['id_gejala' => 'G017', 'nama_gejala' => 'Lapisan lilin yang dihasilkan wereng ditumbuhi jamur jelaga sehingga daun susah berfotosintesis'],
            
            // HP006 - Karat Daun
            ['id_gejala' => 'G018', 'nama_gejala' => 'Bercak kuning pucat pada permukaan atas daun'],
            ['id_gejala' => 'G019', 'nama_gejala' => 'Bercak berkembang menjadi spora berwarna kuning-oranye seperti karat pada permukaan bawah daun'],
            ['id_gejala' => 'G020', 'nama_gejala' => 'Daun gugur prematur dan tanaman menjadi gundul'],
            
            // HP007 - Bercak Daun
            ['id_gejala' => 'G021', 'nama_gejala' => 'Bercak coklat dengan tepi kuning pada daun'],
            ['id_gejala' => 'G022', 'nama_gejala' => 'Bercak meluas dan bergabung membentuk area nekrotik yang luas'],
            ['id_gejala' => 'G023', 'nama_gejala' => 'Daun gugur dan tanaman melemah'],
            
            // HP008 - Jamur Upas
            ['id_gejala' => 'G024', 'nama_gejala' => 'Benang-benang jamur berwarna jingga atau merah muda pada batang dan cabang'],
            ['id_gejala' => 'G025', 'nama_gejala' => 'Kulit batang terkelupas dan menampakkan kayu di bawahnya'],
            ['id_gejala' => 'G026', 'nama_gejala' => 'Bagian tanaman di atas infeksi mati perlahan'],
            
            // HP009 - Kanker Belah
            ['id_gejala' => 'G027', 'nama_gejala' => 'Batang pecah atau belah secara vertikal'],
            ['id_gejala' => 'G028', 'nama_gejala' => 'Terdapat gusi atau getah yang keluar dari luka'],
            ['id_gejala' => 'G029', 'nama_gejala' => 'Miselium jamur putih terlihat pada kayu yang terinfeksi'],
            ['id_gejala' => 'G030', 'nama_gejala' => 'Akar tanaman membusuk dengan miselium jamur putih'],
            
            // HP010 - Jamur Akar Putih
            ['id_gejala' => 'G031', 'nama_gejala' => 'Tanaman layu mendadak meskipun air cukup'],
            ['id_gejala' => 'G032', 'nama_gejala' => 'Akar tertutup miselium jamur berwarna putih seperti benang'],
            ['id_gejala' => 'G033', 'nama_gejala' => 'Kulit akar mudah terkelupas dan menampakkan kayu yang membusuk'],
            ['id_gejala' => 'G034', 'nama_gejala' => 'Tanaman mati dalam waktu singkat setelah gejala muncul'],
            
            // HP012 - Jamur Akar Coklat
            ['id_gejala' => 'G035', 'nama_gejala' => 'Daun-daun menguning, layu, dan akhirnya gugur serta cabang-cabang mati'],
            ['id_gejala' => 'G036', 'nama_gejala' => 'Akar tertutup miselium jamur berwarna coklat'],
            ['id_gejala' => 'G037', 'nama_gejala' => 'Akar membusuk dan rapuh'],
            ['id_gejala' => 'G038', 'nama_gejala' => 'Tanaman mudah roboh karena sistem perakaran rusak'],
            
            // HP013 - Jamur Akar Hitam
            ['id_gejala' => 'G039', 'nama_gejala' => 'Pertumbuhan tanaman terhambat dan kerdil'],
            ['id_gejala' => 'G040', 'nama_gejala' => 'Daun menguning dan gugur tidak normal'],
            ['id_gejala' => 'G041', 'nama_gejala' => 'Akar tertutup miselium jamur berwarna hitam'],
            ['id_gejala' => 'G042', 'nama_gejala' => 'Akar membusuk dengan bau busuk yang khas'],
            
            // HP014 - Mati Pucuk
            ['id_gejala' => 'G043', 'nama_gejala' => 'Pucuk tanaman mati dan mengering'],
            ['id_gejala' => 'G044', 'nama_gejala' => 'Daun muda berwarna coklat kehitaman'],
            ['id_gejala' => 'G045', 'nama_gejala' => 'Batang muda menghitam dan membusuk dari ujung'],
            ['id_gejala' => 'G046', 'nama_gejala' => 'Bunga dan buah muda gugur'],
            ['id_gejala' => 'G047', 'nama_gejala' => 'Cabang primer mati mundur dari ujung'],
            ['id_gejala' => 'G048', 'nama_gejala' => 'Pada batang: Batang pecah atau belah'],
            ['id_gejala' => 'G049', 'nama_gejala' => 'Pada batang: Luka terbuka pada kulit batang'],
            ['id_gejala' => 'G050', 'nama_gejala' => 'Pada pohon muda: Pertumbuhan batang terhambat'],
            ['id_gejala' => 'G051', 'nama_gejala' => 'Pada pohon muda: Tanaman kerdil atau tidak tumbuh normal'],
            ['id_gejala' => 'G052', 'nama_gejala' => 'Pada pohon dewasa: Cabang-cabang mati bertahap'],
            ['id_gejala' => 'G053', 'nama_gejala' => 'Pada pohon dewasa: Daun menguning dan rontok tidak merata'],
            
            // HP015 - Rebah Batang
            ['id_gejala' => 'G054', 'nama_gejala' => 'Benih atau bibit membusuk sebelum tumbuh'],
            ['id_gejala' => 'G055', 'nama_gejala' => 'Batang bibit muda terlihat basah dan berair'],
            ['id_gejala' => 'G056', 'nama_gejala' => 'Batang mengecil dan melemah di dekat permukaan tanah'],
            ['id_gejala' => 'G057', 'nama_gejala' => 'Tanaman rebah atau roboh karena batang tidak kuat menopang'],
            ['id_gejala' => 'G058', 'nama_gejala' => 'Akar membusuk berwarna coklat kehitaman'],
            
            // HP016 - Nematoda
            ['id_gejala' => 'G059', 'nama_gejala' => 'Akar bengkak atau membentuk puru-puru (galls)'],
            ['id_gejala' => 'G060', 'nama_gejala' => 'Pertumbuhan tanaman terhambat'],
            ['id_gejala' => 'G061', 'nama_gejala' => 'Daun menguning, layu, dan gugur'],
            ['id_gejala' => 'G062', 'nama_gejala' => 'Cabang-cabang samping tidak tumbuh dengan baik'],
            ['id_gejala' => 'G063', 'nama_gejala' => 'Tanaman mudah kekurangan air meskipun disiram cukup'],
            ['id_gejala' => 'G064', 'nama_gejala' => 'Sistem perakaran dangkal dan tidak berkembang'],
        ];

        foreach ($data as $item) {
            MasterGejala::create($item);
        }
    }
}