## Projek UAS Millenial Auction

Tema Website : Lelang <br>
Kelas : PW A

<h3>Anggota Kelompok 2:</h3>

<p>Rachelia Ayu Herdani - 210711019</p>
<p>Idelia Jonathan - 210711105</p>
<p>Stepanus Petra Pambudi - 210711441</p>
<p>Fadhel Sitakka - 210711183</p>

<h3>Set-up Projek:</h3>

1. git clone
2. composer install
3. import database millenial_auction (DB_A_2.sql) di root
4. membuat file .env (menyesuaikan DB_DATABASE dengan millenial_auction)
5. php artisan key:generate
6. composer require laravel/passport
7. php artisan migrate
8. php artisan passport:install
9. membuat app password dari google account
10. membuat setting SMTP .env sesuai email dan app password
11. php artisan storage:link

<h3>Account</h3>
<b>Cara setup admin yaitu secara manual menambahkan foreign key id user di tabel admin.</b>
<br> <br>
    - Admin <br>
        Admin email : roma@gmail.com<br>
        Admin password : romaroma<br><br>
    - User<br>
        User email: marquez@gmail.com<br>
        User password: marquez<br>
    - User2<br>
        User email: nobitakun@gmail.com<br>
        User password: nobita<br>

## Pembagian Tugas

1. Idelia

    - Register user
    - Login user dan admin
    - Sell auction di user
    - Profil user
    - Manage user oleh admin (show, update, delete)
    - DB
    - Forgot Password
    - Logout

2. Rachellia

    - DB
    - Dashboard admin
    - Manage Auction Admin (history, soon to be launched, on going)
        - Kelola Bid (show, hapus)
        - Kelola Produk (show, update, delete)
        - Verifikasi Auction (show, update)

3. Stepanus

    - Home User
    - Detail Produk
    - CRUD BID
    - DB
    - Hosting

4. Fadhel (TIDAK KERJA)

## BONUS API

1. Register

    - post /api/registerStep1 - untuk register step 1 (biodata)
    - put /api/register2/{idregistered} - untuk register step 2 (alamat lengkap)
    - get /api/register/verify/{verify_key} - untuk verify email setelah register

2. Login

    - post /api/login - untuk login user
    - post /api/loginadmin - untuk login admin

3. User account

    - post /api/logout - logout account
    - get /api/profile - mengambil data user login
    - put /api/updateProfilePic - update profile picture user login
    - put /api/updateProfile1 - update data user login part 1 (biodata)
    - put /api/updateProfile2 - update data user login part 2 (alamat lengkap)
    - put /api/forgotPassword - update password user dengan inputan email

4. User Sell with us

    - post /api/sell/storeProduk - create produk
    - post /api/sell/storeShipment - create shipment
    - post /api/sell/storeAuction/{idproduk}/{idshipment} - create auction dengan fk produk dan shipment

5. Admin Manage User

    - get /api/admin/showuser - menampilkan semua user
    - get /api/admin/showuser/{id} - menampilkan user berdasarkan id
    - delete /api/admin/deleteuser/{id} - menghapus user berdasarkan id
    - put /api/admin/editpicture/{id} - update profile picture user tertentu
    - put /api/admin/edituser1/{id} - update data user tertentu part 1 (biodata)
    - put /api/admin/edituser2/{id} - update data user tertentu part 2 (alamat lengkap)

6. Produk

    - GET /api/produk - mendapatkan semua produk yang sudah di verif oleh admin
    - GET /api/produk/{id} - mendapatkan semua produk berdasarkan auction id
    - POST /api/produk/search - mendapatkan/mencari produk dari nama produk

7. Bid

    - GET /api/bid/{id} - mendapatkan bid berdasarkan id auction
    - POST /api/bid - melakukan create bid berdasarkan id auction
    - GET /api/bid/check/{id} - Mendapatkan user apakah sudah melakukan bid atau belum berdasarkan auction id
    - PUT /api/bid/{id} - melakukan Update pada bid berdasarkan auction id
    - DELETE /api/bid/{id} melakukan delete bid user berdasarkan id auction

8. Admin Manage Auction

    - get /api/manageAuc - menampilkan data auction dalam keadaan ongoing
    - get /api/manageHistory - menampilkan data auction dalam keadaan lampau
    - get /api/manageSoon - menampilkan data auction dalam keadaan yang akan datang

9. Admin verifikasi

    - put /api/verif/{id}' - mengubah nilai verified dari 0 menjadi 1 untuk melakukan verifikasi auction
    - get /api/verif/{id}' - menampilkan data auction yang perlu diverifikasi

10. Admin manage Produk

    - put /api/auction/{id} - melakukan update data produk pada auction tertentu
    - delete /api/auction/{id} - menghapus data auction tertentu
    - get /api/auction/{id} - menampilkan data produk auction tertentu

11. Admin Manage Bid

    - delete /api/bidder/{id} - menghapus salah satu bid pada auction tertentu
    - get /api/bidder/{id} - mengambil semua bid yang dilakukan pada satu auction

12. Admin Dashboard

    - get /api/stat - menampilkan data-data pada auction yang sedang berlangsung
    - get /api/statAuc - menampilkan total auction yang telah dikelola sepanjang hayat website
    - get /api/statBid - menampilkan total bid yang ada sepanjang hayat website

## BONUS Hosting

-   LINK : [https://millennialauctions.my.id/](https://millennialauctions.my.id/)
