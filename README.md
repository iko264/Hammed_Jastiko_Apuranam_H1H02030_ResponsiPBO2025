# PokéCare - Responsi PBO (Pidgey)

Project sederhana: simulasi pelatihan Pokémon (Pidgey) menggunakan PHP native dan OOP.

Nama        : Hammed Jastiko Apuranam
Nim         : H1H024030
Shift Awal  : A
Shift Akhir : D

## perbedaan tipe dalam pelatihan
Pidgey merupakan Pokémon tipe Normal/Flying sehingga gaya pelatihannya lebih fokus pada latihan kecepatan dan kemampuan manuver. Tipe Flying memiliki keunggulan dalam latihan Speed sehingga aplikasi memberikan bonus peningkatan Speed ketika Pidgey melakukan latihan Speed.

Tipe Pokémon juga memengaruhi bagaimana stat meningkat. Pokémon Flying seperti Pidgey lebih cepat berkembang pada Speed, sedangkan Normal-type tetap seimbang pada stat lainnya.

Jurus spesial Pidgey adalah Gust, yang sesuai dengan elemen Flying: serangan berbasis angin yang mengandalkan kelincahan dan kemampuan terbang.


## Cara menjalankan (lokal)
1. Jalankan server PHP (atau gunakan Laragon/XAMPP).  
2. Letakkan folder Hammed_Jastiko_Apuranam_H1H02030_ResponsiPBO2025 di folder laragon/www/
3. Buka `http://localhost/Hammed_Jastiko_Apuranam_H1H02030_ResponsiPBO2025/`

## penjelasan kode
a. Pokemon.php (Abstract Class)
   Class dasar yang tidak bisa diinstansiasi secara langsung.
   Berisi:
      - Properti umum Pokémon: name, type, level, hp, attack, defense, speed, specialMove
      - Method dasar:
         - getData() → mengambil seluruh informasi Pokémon
         - train($type, $intensity) → mengatur logika kenaikan level, HP, dan stat
         - specialMove() → method abstract yang wajib diimplementasikan oleh setiap Pokémon

b. FlyingPokemon.php (Class Turunan)
   Mewarisi Pokemon.
   Menambahkan:
   - property tambahan: wingPower
   - method khusus flying-type: flyBoost()
   - iplementasi dasar specialMove() untuk Pokémon tipe terbang
c. Pidgey.php
   Turunan dari FlyingPokemon.
   Berisi:
   - Base stats Pidgey (HP 40, Attack 45, Defense 40, Speed 56)
   - Special move: Gust
   - Override specialMove() untuk menampilkan deskripsi khusus Pidgey
   - Override train() untuk memberikan bonus kecepatan (Flying Type Advantage)
d. index.php
   sebagai beranda yang memunculkan informasi dari pokemon dan menu untuk latih
e. train.php – Halaman Latihan
   Fitur:
   - Form memilih jenis latihan: Attack, Defense, Speed
   - Input intensitas latihan
   - Ketika form disubmit:
      - Memanggil $pokemon->train(...)
      - ssion Pokémon diperbarui
      - Riwayat latihan disimpan pada $_SESSION['history']
      - Redirect ke index.php agar perubahan langsung terlihat
f. history.php – Riwayat Latihan
   Menampilkan daftar seluruh sesi latihan:
   - Jenis latihan
   - Intensitas
   - Level sebelum → sesudah
   - HP sebelum → sesudah
   - waktu latihan

