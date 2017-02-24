#Simple CRUD in Laravel 5.4

##Short description
Simple CRUD with related models and events.

Used Laravel features for backend:
- Eloquent models with direct and inverse "one to many" relations
- Forms
- Blade Templates
- English translation
- Controller based on actions for CRUD
- Email with template
- Events & Listeners
- Logging
- Migration schemas with DB seeding

Frontend:
- Bootstrap 3

Behavior checkpoints:
- Default role is "customer"
- Validation fields: Email, Password, City
- After user creation application try to send email to user address with profile information
- After user creation application log event in laravel log 

##Installation

1. clone this repository
2. composer install
3. verify database and mail options in .env 
4. php artisan migrate:refresh --seed
5. bower install
6. php artisan serve