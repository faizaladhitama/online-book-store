- Agenda tugas akhir
- This file was created by : Faizal Adhitama
- NB: Agenda dapat berubah sewaktu-waktu

1. Login/Logout
   Yang harus dikerjakan :
   - Client validation (javascript)
   - Server validation (database -> php)
   - Logout (Cek session)
   - 14 - 16 November 2016 (Kayaknya masih ada bug)
   - Status : Udah selesai, belom di cek ada bug apa engga

2. Melihat daftar buku
   Yang harus dikerjakan :
   - Mengambil data buku oleh PHP
     (gambar buku, judul, penulis, penerbit,
      jumlah buku tersedia,tombol peminjaman buku)
   - Daftar buku pake grid n kolom x n baris 
     (misalkan: grid persegi atau 4x4) atau 
     1 kolom x n baris
   - User dan admin bisa melihat daftar buku
   - Belum login bisa melihat daftar buku
   - Tidak memakai PHP Session untuk cek sudah login
     atau belum
   - 16 - 18 November 2016
   - Status : Udah selesai, tinggal dibagusin cssnya, ga responsive, kalo di resive malah berantakan

3. Meminjam buku
   - Hanya bisa diakses ketika login (Cek session)
   - User hanya bisa meminjam ketika sudah menekan
     tombol pinjam
   - Ketika stok buku 0, user tidak bisa meminjam buku
   - Disable button ketika stok 0
   - Stok buku berkurang ketika dipinjam
   - Di database user stok yang dipinjam user bertambah    
   - 18 - 20 November 2016
   - Status : Belom bikin scriptnya

4. Mengembalikan buku
   - User bisa mengembalikan buku yang dipinjam
   - User punya daftar peminjaman(kayak no.2) tetapi
     tombol peminjaman menjadi tombol mengembalikkan.
   - Stok buku yang dipinjam berkurang atau hilang ketika
     0
   - Jumlah buku yang ada di perpustakaan bertambah
   - User harus sudah login (Cek session)
   - 20 - 22 November 2016
   - Status : Belom bikin scriptnya

5. Melihat detail informasi buku dan review buku
   - 1 halaman berisi informasi buku
   - Informasi yang harus ditampilkan : 
     gambar buku, judul, penulis, penerbit,deskripsi
     ,jumlah ketersediaan buku, daftar review pengguna
     lain.
   - Review terdiri dari nama, tanggal, isi
   - tombol meminjam ada ketika user sudah login
     dan stok buku tidak 0   
   - 22 - 24 November 2016
   - Status : Desain page belom dibikin 

6. Membuat review
   - User bisa membuat review
   - Review dikirim ke database
   - Setelah disubmit akan disend ke page
   - Hanya bisa diakses ketika user sudah login 
     (Cek session)
   - 24 - 26 November 2016
   - Status : Belom dibikin scriptnya

7. Menambah buku
   - Admin bisa membuat dan menyimpan detail buku
     ke database.
   - Jika berhasil memasukkan data buku, akan redirect
     ke halaman buku tersebut
   - Admin harus sudah login
     (Cek session)
   - 26 28 November 2016
   - Status : Belom dibikin scriptnya

8. Desain tampilan
   - Tata letak
   - Background
   - Bootstrap
   - Animasi
   - 28 - 30 November 2016
   - Status : Masih acak acakan

9. Submit dengan AJAX
   - Ajax menggunakan post
   - Variable yang diperlukan :
     nama,isi,tanggal
   - 30 - 2 Desember 2016
   - Status : Belom kepikiran caranya

10. Perbaikan bugs
   - Cek error
   - Perbaikan algoritma
   - Bugs animasi
   - Tombol tidak berfungsi
   - Logic error
   - 3 - 7 Desember 2016
   - Status : Belom dicek