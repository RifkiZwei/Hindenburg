<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Member;
use App\Models\TransaksiBuku;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $kategori = collect(KategoriBuku::GENRES)->mapWithKeys(function (string $genre) {
            $item = KategoriBuku::create(['nama_kategori' => $genre]);

            return [$genre => $item];
        });

        $members = collect([
            ['nama_member' => 'Andi Pratama', 'email' => 'andi@example.com', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1998-04-12'],
            ['nama_member' => 'Bunga Lestari', 'email' => 'bunga@example.com', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '2000-08-21'],
            ['nama_member' => 'Citra Maharani', 'email' => 'citra@example.com', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1997-01-30'],
            ['nama_member' => 'Dimas Saputra', 'email' => 'dimas@example.com', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1999-11-05'],
            ['nama_member' => 'Eka Ramadhan', 'email' => 'eka@example.com', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '2001-06-17'],
        ])->map(fn (array $data) => Member::create($data));

        $books = collect([
            ['isbn' => '9786020010011', 'nama_buku' => 'Fate/stay night: Prologue of the Holy Grail War', 'kategori_id' => $kategori['Fiksi']->id, 'stok' => 8],
            ['isbn' => '9786020010028', 'nama_buku' => 'Fate/stay night: Unlimited Blade Works', 'kategori_id' => $kategori['Romance']->id, 'stok' => 5],
            ['isbn' => '9786020010035', 'nama_buku' => 'Fate/stay night: Heaven\'s Feel', 'kategori_id' => $kategori['Horror']->id, 'stok' => 0],
            ['isbn' => '9786020010042', 'nama_buku' => 'Fate/Grand Order: Observer on Timeless Temple', 'kategori_id' => $kategori['Komedi']->id, 'stok' => 4],
            ['isbn' => '9786020010059', 'nama_buku' => 'Fate/Grand Order: Absolute Demonic Front Babylonia', 'kategori_id' => $kategori['Misteri']->id, 'stok' => 3],
            ['isbn' => '9786020010066', 'nama_buku' => 'Fate/Grand Order: Cosmos in the Lostbelt', 'kategori_id' => $kategori['Petualangan']->id, 'stok' => 6],
            ['isbn' => '9786020010073', 'nama_buku' => 'Fate/strange Fake: Whispers of the Holy Grail', 'kategori_id' => $kategori['Fantasi']->id, 'stok' => 2],
            ['isbn' => '9786020010080', 'nama_buku' => 'Fate/Apocrypha: The Great Holy Grail War', 'kategori_id' => $kategori['Sejarah']->id, 'stok' => 7],
            ['isbn' => '9786020010097', 'nama_buku' => 'Fate/Zero: The Beginning of the Fourth War', 'kategori_id' => $kategori['Biografi']->id, 'stok' => 4],
            ['isbn' => '9786020010103', 'nama_buku' => 'Fate/EXTRA: Moon Cell Record', 'kategori_id' => $kategori['Pendidikan']->id, 'stok' => 10],
            ['isbn' => '9786020010110', 'nama_buku' => 'Fate/Prototype: Fragments of Blue and Silver', 'kategori_id' => $kategori['Agama']->id, 'stok' => 5],
            ['isbn' => '9786020010127', 'nama_buku' => 'Fate/kaleid liner Prisma Illya: Magical Grail', 'kategori_id' => $kategori['Sains']->id, 'stok' => 3],
        ])->map(fn (array $data) => Buku::create($data));

        TransaksiBuku::create([
            'member_id' => $members[0]->id,
            'buku_id' => $books[0]->id,
            'jenis' => 'pinjam',
            'jumlah' => 1,
        ]);
        $books[0]->decrement('stok');

        TransaksiBuku::create([
            'member_id' => $members[1]->id,
            'buku_id' => $books[1]->id,
            'jenis' => 'beli',
            'jumlah' => 1,
        ]);
        $books[1]->decrement('stok');

    }
}
