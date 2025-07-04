# Laravel Roadmap: Junior Level Challenge

This is a task for the **Junior Level** of the [Laravel Roadmap](https://laraveldaily.com/roadmap-learning-path), with the goal to implement as many of its topics as possible.

This repository is intentionally empty, with only a Readme file. Your task if to submit a Pull Request with your version of implementing the task, and your PR may be reviewed by someone on our team, or other volunteers.

## The Task: Simple CRM System for Managing Clients

You should create an adminpanel-like system to manage Clients, Projects, Tasks with CRUD operations.

A few screenshots from the example solution:

Login Page

![](https://laraveldaily.com/uploads/2025/06/roadmap-crm-login.png)

Users List

![](https://laraveldaily.com/uploads/2025/06/roadmap-crm-users-list.png)

Project View

![](https://laraveldaily.com/uploads/2025/06/roadmap-crm-project-view.png)


You can come up with whatever structure of the database tables you want, but please try to use all the Laravel features listed below.



-----

## Features to implement

Here's the [list of Roadmap features](https://laraveldaily.com/roadmap-learning-path) you need to try to implement in your code:


**Routing Advanced**	

- Route Model Binding	in Resource Controllers
- Route Redirect - homepage should automatically redirect to the login form


**Database Advanced**

- Database Seeders and Factories - to automatically create first clients/projects/tasks and default users
- Eloquent Query Scopes - show only active clients, for example
- Polymorphic relationships	with [Spatie Media Library package](https://github.com/spatie/laravel-medialibrary)
- Eloquent Accessors and Mutators	- view all date values in `m/d/Y` format
- Soft Deletes on any Eloquent models


**Auth Advanced**	

- Authorization: Roles/Permissions (admin and simple users), Gates, Policies with [Spatie Permissions package](https://github.com/spatie/laravel-permission)
- Authentication: Email Verification	


**API Basics**	

- API Routes and Controllers	
- API Eloquent Resources	
- API Auth with Sanctum	
- Override API Error Handling and Status Codes	


**Debugging Errors**	

- Try-Catch and Laravel Exceptions	
- Customizing Error Pages


**Sending Email**

- Mailables and Mail Facade	
- Notifications System: Email


**Extra**

- Automated Tests for CRUD Operations


----- 

## Example Solution

If you need help, or you want to compare your version with our simple version, here's [the public repository](https://github.com/LaravelDaily/Laravel-Roadmap-Junior-CRM) with a _possible_ solution.

**Notice**: please look at that repository only AFTER you've accomplished the task yourself, or if you're confident about your Laravel Junior skills and you think you don't need to practice this task.
