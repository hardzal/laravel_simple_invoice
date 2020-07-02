# Langkah 1
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
