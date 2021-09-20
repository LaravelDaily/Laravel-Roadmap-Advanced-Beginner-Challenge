<h1>Installation</h1>

- composer install
- php artisan key:generate
- php artisan migrate --seed
- php artisan storage:link
- npm install
- npm run dev
- php artisan serve / your deployment method

<i>Remember to set .env APP_URL to make images path work properly</i>

Login as admin: admin@mail.com / admin<br>
Login as user: user1@mail.com / user<br>
For more data see database/seeders/UserSeeder

Full seeding of data can take more than one minute, because of adding images and conversion.

<h3>Implemented features</h3>

<h4>Routing Advanced</h4>

- Route Model Binding in Resource Controllers
  - All controllers use model binding
- Route Redirect - homepage should automatically redirect to the login form 
  - routes/web.php:48

<h4>Database Advanced</h4>

- Database Seeders and Factories - to automatically create first clients/projects/tasks and default users
  - Done
- Eloquent Query Scopes - show only active clients, for example
  - app/Models/Project.php:60-87
  - app/Models/Task.php:51-77
- Polymorphic relationships with Spatie Media Library package
  - Project, Task & Response models implement Spatie Medialibrary
- Eloquent Accessors and Mutators - view all date values in m/d/Y format
  - Datatime accessors defined in all models
- Soft Deletes on any Eloquent models
  - All models implement softdelete

<h4>Auth Advanced</h4>

- Authorization: Roles/Permissions (admin and simple users), Gates, Policies with Spatie Permissions package
  - app/database/seeders/PermissionSeeder
  - app/database/seeders/RoleSeeder
  - All actions are controlled by Policies for all models
- Authentication: Email Verification
  - User implements MustVerifyEmail
  - routes uses verified middleware
  - app/Services/UserService.pgp dispatch Registered event and send verify email

<h4>API Basics</h4>

- API Routes and Controllers
  - routes/api.php
  - app/Http/Controllers/Api/V1/
- API Eloquent Resources
  - app/Http/Resources/V1/
- API Auth with Sanctum
  - routes/api.php:25
- Override API Error Handling and Status Codes
  - app/Exceptions/Handler.php:43-53 

<h5>Test with Postman:</h5>

<i>(APP_URL depends on how you deploy on your system)</i>

Login to app: POST APP_URL/login

Pre-request script:

    pm.sendRequest({
      url: 'APP_URL/sanctum/csrf-cookie',
      method: 'GET'
    }, function(error, response, {cookies}){
      if(!error){
        pm.globals.set('xsrf-cookie', cookies.get('XSRF-TOKEN'))
      }
    })

Body / form-data:<br>
- email: admin@mail.com
- password: admin

Expected response: 204

GET projects: APP_URL/api/v1/project<br>
Expected response: 200

<h4>Debugging Errors</h4>

- Try-Catch and Laravel Exceptions
  - app/Rules/CheckEncryptedInput.php:29-33
- Customizing Error Pages
  - Customized layout: resources/views/errors/layout.blade.php
  - all error pages use system styling

<h4>Sending Email</h4>

- Mailables and Mail Facade
- Notifications System: Email
  - app/Services/ProjectService.php notify user using ProjectAssignedNotification when it assigned on store & when user is changed on update

<h4>Extra</h4>

- Automated Tests for CRUD Operations
  - Test implemented for all CRUD operations