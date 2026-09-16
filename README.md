# InnerEcho

A mental health counseling web application built with PHP 8.2, MySQL, and Docker. InnerEcho provides a platform for users to connect with professional counselors, track their mental wellness journey, and access therapeutic resources.

## Features

- **User Dashboard** — Journal entries, mood tracking, self-assessments, and appointment booking
- **Consultant Dashboard** — View and manage appointment requests, accept/reject bookings
- **Admin Panel** — Manage users and consultants with full CRUD operations
- **Authentication** — Secure bcrypt password hashing, session-based auth, role-based access control
- **Responsive Design** — Mobile-friendly interface with modern CSS styling

## Tech Stack

- **Backend:** PHP 8.2 (Apache)
- **Database:** MySQL 8.0
- **Frontend:** HTML5, CSS3, Vanilla JavaScript
- **Infrastructure:** Docker, Docker Compose

## Project Structure

```
innerecho/
├── app/
│   ├── Config/          # Database configuration
│   ├── Controllers/     # Request handlers (Auth, Admin, User, Consultant)
│   ├── Core/            # Framework core (Router, Database, Model)
│   ├── Models/          # Database models (User, Appointment, Journal, etc.)
│   └── Views/           # PHP templates organized by domain
│       ├── layouts/     # Main HTML layout
│       ├── partials/    # Reusable nav/footer components
│       ├── auth/        # Login/signup pages
│       ├── admin/       # Admin dashboard views
│       ├── consultant/  # Consultant dashboard views
│       └── user/        # User dashboard views
├── routes/
│   └── web.php          # All route definitions
├── public/
│   ├── index.php        # Front controller (entry point)
│   ├── css/             # Stylesheets
│   └── images/          # Static assets
├── composer.json        # PSR-4 autoloading config
├── Dockerfile           # PHP 8.2 Apache image
├── docker-compose.yml   # App + MySQL services
└── init.sql             # Database schema and seed data
```

## Getting Started

### Prerequisites

- Docker and Docker Compose installed

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/HedaetShahriar/Webtech-project.git
   cd Webtech-project
   ```

2. Start the containers:
   ```bash
   docker compose up -d
   ```

3. Access the application at `http://localhost:8000`

### Default Credentials

| Role        | Username    | Password |
|-------------|-------------|----------|
| Admin       | admin       | 123      |
| Consultant  | JohnDoe     | 123      |
| User        | John        | 123      |

## Architecture

### MVC Pattern

The application follows the Model-View-Controller architecture:

- **Models** handle database operations via PDO prepared statements
- **Views** are PHP templates rendered inside a shared layout
- **Controllers** process requests, interact with models, and return responses

### Routing

Routes are defined in `routes/web.php` and dispatched through `public/index.php`. The Router class supports GET and POST methods with controller-action pairings.

### Database

Uses MySQL 8.0 with PDO for secure database access. Passwords are hashed with bcrypt and rehashed automatically when needed.

## Development

### Adding New Routes

Edit `routes/web.php`:

```php
$router->get('/your-route', [YourController::class, 'methodName']);
$router->post('/your-route', [YourController::class, 'methodName']);
```

### Adding New Models

Create a class in `app/Models/` extending `App\Core\Model`:

```php
namespace App\Models;

use App\Core\Model;

class YourModel extends Model
{
    protected string $table = 'your_table';
}
```

### Regenerating Autoloader

```bash
docker compose exec app composer dump-autoload
```

## License

This project is for educational purposes.
