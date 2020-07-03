# Langkah 
- Mempersiapkan Database
  - Membuat Model dan Migrasi
        ```
        php artisan make:model Customer -m
        php artisan make:model Product -m
        php artisan make:model Invoice -m
        php artisan make:model InvoiceDetail -m
        ```
  - Melakukan Migrasi database
    ```
        php artisan migrate
    ```
  - Membuat Relasi Antar Table
    ```
    php artisan make:migration add_relationships_to_invoices_table
    php artisan make:migration add_relationships_to_invoice_details_table
    ```
 - Membuat Controller
 - Menambahkan route 
 - Membuat Observer Event: trigger untuk invoices jika terjadi perubahan pada invoice_details
```
    php artisan make:observer InvoiceDetailObserver --model=InvoiceDetail
```
- Membuat seeder
```
    php artisan make:seeder UsersTableSeeder
```
- Menjalankan seeder 
```
    php artisan db:seed --class=UsersTableSeeder
```
