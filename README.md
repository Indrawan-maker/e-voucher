<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## E- Voucher

Adalah sistem voucher wifi yang bisa track setiap transaksi dan pembayaran, keuntungan hutang, dll

## feature

login : role superadmin, role admin (role admin dibuat oleh superadmin)
tambah role admin : untuk menambah toko yang membeli langganan
penghitungan otomatis berdasarkan quantity voucher yang dipilih
melakukan transaksi berdasarkan toko yang sudah dibuat
melakukan pembayaran berdasarkan transaksi yang dilakukan
menampilkan detail transaksi sebeleum melakukan pembayaran untuk menghindari kesalahan
hide & show password menggunakan state livewire



demo video : https://drive.google.com/file/d/1faxj_plKk5sjx6gi4pGIYS5sK-tvImXs/view?usp=drive_link


sesuaikan env : 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e-voucher
DB_USERNAME=root
DB_PASSWORD=
