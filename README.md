# Laravel Task List

A simple task management web application built with Laravel, Tailwind CSS, and Alpine.js.

## Features

- View a paginated list of tasks
- Create, edit, and delete tasks
- Mark tasks as complete or incomplete
- Flash success notifications with dismissable alerts
- Form validation with inline error messages

## Tech Stack

- **Backend:** Laravel
- **Frontend:** Blade templates, Tailwind CSS, Alpine.js
- **Database:** Compatible with any Laravel-supported database

## Docker Setup (Optional)

A `docker-compose.yaml` is included to spin up a MariaDB database and Adminer.

### Starting the containers

```bash
docker compose up -d
```

Once running, Adminer is accessible at [http://localhost:8080](http://localhost:8080). Log in with:

- **Server:** `mysql`
- **Username:** `root`
- **Password:** `root`

## Getting Started

### Prerequisites

- PHP
- Composer
- Node.js & npm
- A configured database (local or via Docker above)

### Installation

1. **Clone the repository**

```bash
git clone https://github.com/n1n5/task-list.git
cd task-list
```

2. **Install dependencies**

```bash
composer install
npm install
```

3. **Set up your environment**

```bash
cp .env.example .env
php artisan key:generate
```

Then update your `.env` file with the following:

```env
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_list
DB_USERNAME=root
DB_PASSWORD=root
```

4. **Run migrations and seed the database**

```bash
php artisan migrate
php artisan db:seed
```

5. **Start the development server**

```bash
composer run dev
```

Visit [http://localhost:8000](http://localhost:8000) in your browser.
