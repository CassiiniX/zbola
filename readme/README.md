<h2> Sourcecode Pemesanan Lapangan Futsal </h2>
<div>
  Dapat digunakan sebagai bahan refrensi belajar 
  dan juga referensi untuk tugas akhir
</div>

<h4> Halaman-halaman : </h4>
<div>
 <ul>
  <li>Maintaince</li>
  <li>
    User <br/>
    <ul>
      <li>Halaman Depan (Landing Page)</li>
      <li>Masuk (Signin)</li>
      <li>Daftar (Signup)</li>
      <li>Profil</li>    
      <li>Lapangan (Product)</li>
      <li>Detail Lapangan</li>
      <li>Order Lapangan</li>
      <li>Invoice</li>
      <li>Riwayat Invoice</li>
      <li>Notifikasi</li>
      <li>Pembayaran Manual</li>
    </ul>      
  </li>
  <li>
    Admin <br/>
    <ul>
      <li>Kelola User</li>
      <li>Kelola Lapangan</li>
      <li>Kelola Review</li>
      <li>Kelola Invoice</li>
      <li>Kelola Pembayaran Manual</li>
      <li>Kelola Setting Website</li>
    </ul>
  </li>
 </ul>
</div>

<h4> Photo : </h4>
<div style="padding:10px">
  <img src="photo/1.png" height="100px">
  <img src="photo/2.png" height="100px">
  <img src="photo/3.png" height="100px">
  <img src="photo/4.png" height="100px">
  <img src="photo/5.png" height="100px">
  <img src="photo/6.png" height="100px">
</div>

<h4> Requirement : </h4>
<div>
  <ul>
    <li>Php 7.2.0 ></li>
    <li>Composer 2.0.11 ></li>
    <li>Mysql</li>
    <li>Phpmyadmin (Optional)</li>
  </ul>
</div>

<h4> Langkah-langkah : </h4>
<div>
  <ul>
    <li>
      <p>
        buat database dengan mengunakan <b>phpmyadmin/mysqli client</b>
      </p>
    </li>
    <li>
      <p>
        copy folder <b>public/assets/images-backup</b> 
        menjadi <b>public/assets/images</b> 
      </p>
    </li>
    <li> 
      <p>
        copy <b>.env.example</b> file ganti namanya dengan <b>.env</b>
      </p>
    </li>    
    <li>  
      <p>
        edit <b>.env</b> file <br/><br/>
        DB_DATABASE=<b>{DATABASE_NAME}</b> <br/>
        DB_USERNAME=<b>{USERNAME_MYSQL}</b> <br/>
        DB_PASSWORD=<b>{PASSWORD_MYSQL}</b> <br/>
      </p>
    </li>
    <li>  
      <p>
        <b>composer install</b>
      </p>
    </li>
    <li>    
      <p>
        <b>php artisan migrate:fresh --seed</b>
      </p>
    </li>
    <li>  
      <p>
        <b>php artisan serve</b>
      </p>
    </li>
  <ul>
</div>

<h4> Alur : </h4>
<div>
  <a href="flow/README.md">Alur</a>
</div>

<h4> Perubahan : </h5>
<div>
  <a href="change/README.md">Perubahan</a>
</div>