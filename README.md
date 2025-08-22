# Laravel Product CRUD App

A simple Laravel 10+ CRUD application with authentication, product management, and image upload functionality. This app allows users to register, login, create, read, update, and delete products.

## Features

1. User authentication (register, login, logout) using Laravel’s built-in auth.
2. CRUD operations for products:
   - Create new products with name, price, description, and image.
   - View all products in a DataTable with pagination and search.
   - Edit existing products.
   - Delete products.
   - View full product details, including creator’s name.
3. Image upload and storage in `storage/app/public/products`.
4. Bootstrap 5 responsive layout.
5. Validation for form inputs including custom error messages.
6. Optional slug support for nicer URLs.

## Installation

1. Clone the repository:

   git clone https://github.com/Dav-Olobo/CRUD-Products-.git
   cd your-repo

2. Install dependencies:

   composer install
   npm install
   npm run dev

3. Copy `.env` file and generate an app key:

   cp .env.example .env
   php artisan key:generate

4. Configure your database in `.env`:

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=product_crud
   DB_USERNAME=root
   DB_PASSWORD=
5. Run migrations and seeders:

   php artisan migrate --seed

6. Link storage for public access to uploaded images:

   php artisan storage:link

7. Start the development server:

   php artisan serve

- The app will be accessible at `http://127.0.0.1:8000`.

## Usage

1. Register a new user or login with an existing account.
2. Go to the Dashboard to see all products.
3. Create a new product by clicking "Add Product".
4. Edit or delete existing products using the buttons in the list.
5. View full product details by clicking the "View" button.

## File Structure

app/
├─ Http/
│  ├─ Controllers/
│  │  └─ ProductController.php
resources/
├─ views/
│  ├─ layout.blade.php
│  └─ products/
│     ├─ index.blade.php
│     ├─ create.blade.php
│     ├─ edit.blade.php
│     ├─ show.blade.php
│     └─ view.blade.php
database/
├─ migrations/
├─ seeders/

## Routes

- Auth Resources route to handle products. User must be logged in to dashboard to create and manage routs
Route::resource('dashboard/products', ProductController::class)
    ->middleware('auth')
    ->except(['index', 'show']);   

- Full product view and full product list is not fully authenticated to allow gues to use:
 - Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

## Validation Rules

- `name`: required, string, max 255
- `price`: required, numeric, min 0
- `description`: required, string, max 1000
- `image`: required for create, optional for update, must be jpeg, png, jpg, gif, webp, max 2MB

## Dependencies

- Laravel 10+
- Bootstrap 5 (via CDN)
- jQuery & DataTables (optional for table enhancements)

## Change of Product View arrangement
- Change from table view to E-commerce style 
- card view.
- Get product listing on the index page

## Notes

- Make sure `storage/app/public` is linked to `public/storage` for image access.
- The app currently does not restrict product edits/deletions by user, but this can be added via policies or middleware.
- Slug functionality can be added for nicer URLs without affecting CRUD operations.
- It can be transitioned into a full E-commerce site

## License

This project is open-source and available under the MIT License.