## Features

* **RESTful API:** Full CRUD operations for Posts, Pages, and Categories.
* **API Authentication:** API access using Laravel Sanctum (token-based).
* **Livewire Admin Panel:** Dynamic and reactive forms for content management.
* **Image Picker Integration:** Integration with Laravel File Manager for media selection.
* **Role-Based Permissions:** Utilizes Spatie Laravel Permissions for granular access control.
* **Database Seeding:** Easy generation of dummy data for development.
* **Eloquent Relationships:** Many-to-many relationship between Posts and Categories.

## Requirements

* PHP >= 8.2
* Composer
* Node.js & npm (or Yarn)
* Database (MySQL, PostgreSQL, SQLite, etc.)
* (Optional for local development) Laragon, XAMPP, Valet, or `php artisan serve`

## Installation

Follow these steps to get the project up and running on your local machine.

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/agungrobbi/pc_code_challenge.git
    cd pc_code_challenge
    ```

2.  **Install Composer Dependencies:**
    ```bash
    composer install
    ```

3.  **Create `.env` File:**
    Duplicate the `.env.example` file and rename it to `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure Database:**
    Open your `.env` file and update the database connection details:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_db_username
    DB_PASSWORD=your_db_password
    ```

6.  **Set `APP_URL` (Crucial for `php artisan serve`):**
    If you're using `php artisan serve`, ensure your `APP_URL` in `.env` includes the port:
    ```dotenv
    APP_URL=http://127.0.0.1:8000
    ```
    If using Laragon/Valet, use your local domain:
    ```dotenv
    APP_URL=http://local-domain.test
    ```

7.  **Run Migrations and Seeders:**
    This will create the database tables and populate them with initial data (including an admin user, categories, posts, and pages).
    ```bash
    php artisan migrate:fresh --seed
    ```
    (This also runs `php artisan db:seed`)

8.  **Setup Storage Link:**
    This command creates a symbolic link from `public/storage` to `storage/app/public` so uploaded files (like images from Laravel File Manager) are publicly accessible.
    ```bash
    php artisan storage:link
    ```

9.  **Install Frontend Dependencies & Compile Assets:**
    ```bash
    npm install
    npm run dev # Or npm run build for production
    ```

10. **Start the Development Server:**
    ```bash
    php artisan serve
    ```
    Your application will be accessible at `http://127.0.0.1:8000`.

## Admin Panel Access

Once the project is running:

1.  **Navigate to:** `http://127.0.0.1:8000/login` (or your local domain).
2.  **Credentials:**
    -  Admin: Can see all menu
        **Email:** `admin@gmail.com`
        **Password:** `password`
    -  Page Editor: Allowed to do CRUD for page and media
        **Email:** `posteditor@gmail.com`
        **Password:** `password`
    -  Post Editor: Allowed to do CRUD for post and media
        **Email:** `pageeditor@gmail.com`
        **Password:** `password`

## API Endpoints

All API endpoints are prefixed with `/api`. Access requires a Bearer Token (Sanctum).

### Authentication

* **Login (POST):** `{{site_url}}/api/login`
    * Body (JSON): `{"email": "admin@gmail.com", "password": "password", "device_name": "Postman"}`
    * **Response provides the `token` for authenticated requests.**
* **Logout (POST):** `{{site_url}}/api/logout` (Requires Bearer Token)

### Categories (`/api/category`)

* **GET /api/category:** List all categories.
* **GET /api/category/{id}:** Get a single category.
* **POST /api/category:** Create a new category.
    * Body (JSON): `{"title": "New Category", "slug": "new-category"}`
* **PUT /api/category/{id}:** Update an existing category.
    * Body (JSON): `{"title": "Updated Category", "slug": "updated-category"}`
* **DELETE /api/category/{id}:** Delete a category.

### Posts (`/api/posts`)

* **GET /api/posts:** List all posts.
* **GET /api/posts/{id}:** Get a single post.
* **POST /api/posts:** Create a new post.
    * Body (JSON): `{"title": "Post Title", "slug": "post-title", "status": "draft", "image": "URL", "excerpt": "Excerpt", "content": "Full HTML Content", "category_ids": [1, 2]}`
* **PUT /api/posts/{id}:** Update an existing post.
    * Body (JSON): `{"title": "Updated Title", ..., "category_ids": [3]}`
* **DELETE /api/posts/{id}:** Delete a post.

### Pages (`/api/pages`)

* **GET /api/pages:** List all pages.
* **GET /api/pages/{id}:** Get a single page.
* **POST /api/pages:** Create a new page.
    * Body (JSON): `{"title": "Page Title", "slug": "page-title", "status": "published", "body": "Page HTML Content"}`
* **PUT /api/pages/{id}:** Update an existing page.
    * Body (JSON): `{"title": "Updated Title", ...}`
* **DELETE /api/pages/{id}:** Delete a page.
