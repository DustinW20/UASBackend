BACKEND UAS ESTEH SOLO

Dustin Welliken ( 535220157 )
Raynaldo Gracia Buntoto ( 535220162 )
Iqbal Alfaridzi Balman ( 535220248 )


# Implementasi website pada umkm es teh solo


This project aims to develop a user-friendly and engaging website for UMKM Es Teh Solo, a local small and medium-sized enterprise specializing in traditional and innovative iced tea beverages. The website will serve as an online presence for the business, providing essential information about products, services, and the brand's story, while also offering a platform for customer interaction and online sales.

Objectives
Online Presence: Establish a professional and attractive online presence for UMKM Es Teh Solo to reach a wider audience.
Product Showcase: Display a catalog of iced tea products with detailed descriptions, prices, and high-quality images.
E-commerce Functionality: Enable customers to place orders online, with options for delivery or pick-up.
Customer Engagement: Provide information about the brand's history, mission, and values to build a connection with customers.
Promotions and Updates: Share the latest news, promotions, and events to keep customers informed and engaged.

### Instalasi

-  Pastikan sudah isntall php versi 8.2 yang lebih aman
-  Pastikan sudah insall composer untuk management library pada laravel





## Installation

Install my-project with composer install

```bash
  composer install
```

### Edit file env pada database agar sesuai dengan database postgree anda


```bash
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=esteh_db
    DB_USERNAME=postgres
    DB_PASSWORD=root // sesuaikan dengan password postgree kamu
```

### Buat database di postgree

##### Masuk postgree dengan terminal

```bash
    psql -U postgres
```


### Buat database esteh_db

```bash
  create database esteh_db
```

### jalankan migration

```bash
  php artisan migrate
```

### jalankan seeder

```bash
  php artisan migrate:fresh --seed
```

### jalankan aplikasi

```bash
  php artisan serve
```

### Buka aplikasi di port 8000    

login dengan email admin@gmail.com password rahasia

### kalau admin nya masih salah

login dengan email budi@gmail.com password 12345678
