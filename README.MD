//Agenda tugas akhir//
- This file was created by : Faizal Adhitama

1. Login/Logout
   Yang harus dikerjakan :
   - Client validation (javascript)
   - Server validation (database -> php)
   - Logout (Cek session)
   - 13 - 15 November 2016

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
   - 15 - 17 November 2016

3. Meminjam buku
   - Hanya bisa diakses ketika login (Cek session)
   - User hanya bisa meminjam ketika sudah menekan
     tombol pinjam
   - Ketika stok buku 0, user tidak bisa meminjam buku
   - Disable button ketika stok 0
   - Stok buku berkurang ketika dipinjam
   - Di database user stok yang dipinjam user bertambah    
   - 17 - 19 November 2016

4. Mengembalikan buku
   - User bisa mengembalikan buku yang dipinjam
   - User punya daftar peminjaman(kayak no.2) tetapi
     tombol peminjaman menjadi tombol mengembalikkan.
   - Stok buku yang dipinjam berkurang atau hilang ketika
     0
   - Jumlah buku yang ada di perpustakaan bertambah
   - User harus sudah login (Cek session)
   - 19 - 21 November 2016

5. Melihat detail informasi buku dan review buku
   - 1 halaman berisi informasi buku
   - Informasi yang harus ditampilkan : 
     gambar buku, judul, penulis, penerbit,deskripsi
     ,jumlah ketersediaan buku, daftar review pengguna
     lain.
   - Review terdiri dari nama, tanggal, isi
   - tombol meminjam ada ketika user sudah login
     dan stok buku tidak 0   
   - 21 - 23 November 2016   

6. Membuat review
   - User bisa membuat review
   - Review dikirim ke database
   - Setelah disubmit akan disend ke page
   - Hanya bisa diakses ketika user sudah login 
     (Cek session)
   - 23 - 25 November 2016

7. Menambah buku
   - Admin bisa membuat dan menyimpan detail buku
     ke database.
   - Jika berhasil memasukkan data buku, akan redirect
     ke halaman buku tersebut
   - Admin harus sudah login
     (Cek session)
   - 25 - 27 November 2016

8. Desain tampilan
   - Tata letak
   - Background
   - Bootstrap
   - Animasi
   - 27 - 29 November 2016

9. Submit dengan AJAX
   - Ajax menggunakan post
   - Variable yang diperlukan :
     nama,isi,tanggal
   - 29 - 1 Desember 2016

10. Perbaikan bugs
   - Cek error
   - Perbaikan algoritma
   - Bugs animasi
   - Tombol tidak berfungsi
   - Logic error
   - 2 - 7 Desember 2016