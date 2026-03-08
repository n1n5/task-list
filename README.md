# Task List

A simple task management web application built with Laravel, Tailwind CSS, and Alpine.js.

## Features

- View a paginated list of tasks
- Create, edit, and delete tasks
- Mark tasks as complete or incomplete
- Flash success notifications with dismissable alerts
- Form validation with inline error messages

## Tech Stack

- **Backend:** Laravel 12 using [Nuno Maduro's starter kit](https://github.com/nunomaduro/laravel-starter-kit)
- **Frontend:** Blade templates, Tailwind CSS v4, Alpine.js
- **Database:** SQLite

## Getting Started

### Prerequisites

- PHP 8.5
- Composer
- Bun

### Installation

1. **Clone the repository**

```bash
git clone https://github.com/n1n5/task-list.git
cd task-list
```

2. **Setup project**

```bash
composer setup
```

3. **Seed the database**

```bash
php artisan db:seed
```

4. **Start the development server**

```bash
composer dev
```
