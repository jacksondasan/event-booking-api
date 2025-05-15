# Event Booking API

A RESTful API for managing events and bookings built with Laravel.

## Features

- Event Management (CRUD operations)
- Attendee Registration
- Event Booking System with capacity management
- Country-based event locations
- Protection against overbooking and duplicate bookings
- API Authentication using Laravel Sanctum

## Requirements

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Laravel 10.x

## Setup Instructions

1. Clone the repository
```bash
git clone <repository-url>
cd event-booking-api
```

2. Install dependencies
```bash
composer install
```

3. Copy environment file and configure database
```bash
cp .env.example .env
```
Update the database configuration in .env file with your credentials.

4. Generate application key
```bash
php artisan key:generate
```

5. Run migrations
```bash
php artisan migrate
```

6. Start the development server
```bash
php artisan serve
```

## Docker Support

To run the application using Docker:

1. Build and start the containers:
```bash
docker-compose up -d
```

2. Install dependencies:
```bash
docker-compose exec app composer install
```

3. Generate application key:
```bash
docker-compose exec app php artisan key:generate
```

4. Run migrations:
```bash
docker-compose exec app php artisan migrate
```

The application will be available at http://localhost:8000

## API Documentation

### Public Endpoints

#### Events
- `GET /api/events` - List all events
  - Query Parameters:
    - country: Filter by country
    - date: Filter by date
    - per_page: Number of items per page
- `GET /api/events/{id}` - Get event details

#### Attendees
- `POST /api/attendees` - Register a new attendee
  - Required fields: name, email
  - Optional fields: phone

### Protected Endpoints
Authentication token required in Authorization header: `Bearer <token>`

#### Events Management
- `POST /api/events` - Create a new event
  - Required fields: title, description, start_date, end_date, country, venue, capacity
- `PUT/PATCH /api/events/{id}` - Update event details
- `DELETE /api/events/{id}` - Delete an event

#### Bookings
- `POST /api/bookings` - Book an event
  - Required fields: event_id, attendee_id
- `DELETE /api/bookings/{id}` - Cancel a booking

#### Attendees Management
- `GET /api/attendees` - List all attendees
  - Query Parameters:
    - search: Search by name or email
    - per_page: Number of items per page
- `GET /api/attendees/{id}` - Get attendee details
- `DELETE /api/attendees/{id}` - Delete a attendee

### Swagger Documentation
The API is documented using OpenAPI/Swagger specification. To access the documentation:

1. Generate the documentation:
```bash
php artisan l5-swagger:generate
```

2. View the documentation at: http://127.0.0.1:8000/api/documentation

The Swagger UI provides:
- Interactive API documentation
- Request/response examples
- Try-it-out feature to test endpoints directly
- Authentication setup using Bearer token
- Schema definitions for all models
- Detailed parameter descriptions
- Response codes and examples

Available API Sections:
- Authentication (Login/Register)
- Events Management (CRUD operations)
- Attendee Management
- Booking Operations
- Error Responses

Testing Endpoints via Swagger UI:
1. Click on the "Authorize" button
2. Enter your Bearer token: `Bearer your-token-here`
3. Select any endpoint
4. Click "Try it out"
5. Fill in the required parameters
6. Execute the request

### Postman Collection
Import the Postman collection file: `Event_Booking_API.postman_collection.json`

The collection includes:
- Authentication endpoints
- Event management
- Booking management
- Environment variables setup

### Environment Variables
Set up the following variables in your Postman environment:
- `baseUrl`: Your API base URL (e.g., http://localhost:8000)
- `token`: Your authentication token (obtained after login)

## Error Handling

The API returns appropriate HTTP status codes and error messages:

- 200: Success
- 201: Created
- 204: No Content
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 422: Validation Error
- 500: Server Error

## Testing

Run the test suite:
```bash
php artisan test
```
