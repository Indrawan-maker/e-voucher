<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## E- Voucher
<br>
Adalah sistem voucher wifi yang bisa track setiap transaksi dan pembayaran, termasuk menghilangkan kesalahan pencatatan dll.
<br>




## feature
<br>

login : role superadmin, role admin (role admin dibuat oleh superadmin)<br>
tambah role admin : untuk menambah toko yang membeli langganan voucher<br>
penghitungan otomatis berdasarkan quantity voucher yang dipilih<br>
melakukan transaksi berdasarkan toko yang sudah dibuat<br>
melakukan pembayaran berdasarkan transaksi yang dilakukan<br>
menampilkan detail transaksi sebeleum melakukan pembayaran untuk menghindari kesalahan<br>
hide & show password menggunakan state livewire

<br>

demo video : https://drive.google.com/file/d/1faxj_plKk5sjx6gi4pGIYS5sK-tvImXs/view?usp=drive_link<br>


## tech stack

- laravel 12 <br>
- php 8.x
- livewire 4 (otomatis akan menginstall alphinejs) <br>
- bootsrap <br>
- adminLTE 3 <br>



contoh env (sesuaikan dengan env anda) : <br>

DB_CONNECTION=mysql
<br>
DB_HOST=127.0.0.1
<br>
DB_PORT=3306<br>
DB_DATABASE=e-voucher<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br>

