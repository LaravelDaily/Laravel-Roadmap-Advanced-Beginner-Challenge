# Laravel Roadmap: Advanced Beginner Level Challenge

This is a task for the [Advanced Beginner Level of the Laravel Roadmap](https://github.com/LaravelDaily/Laravel-Roadmap-Learning-Path#advanced-beginner-level), with the goal to implement as many of its topics as possible.

This repository is intentionally empty, with only a Readme file. Your task if to submit a Pull Request with your version of implementing the task, and your PR may be reviewed by someone on our team, or other volunteers.

## The Task: Simple CRM System for Managing Clients

You should create an adminpanel-like system to manage Clients, Projects, Tasks with CRUD operations.

A few screenshots from the example solution:

<img width="1370" alt="Screenshot 2021-08-12 at 10 56 42" src="https://user-images.githubusercontent.com/1510147/129160013-d5c895d3-92aa-4a32-9a62-d09807f623f9.png">
<img width="1371" alt="Screenshot 2021-08-12 at 10 57 15" src="https://user-images.githubusercontent.com/1510147/129160023-8095c1b5-d6ce-4813-b708-af1b16605160.png">

You can come up with whatever structure of the database tables you want, but please try to use all the Laravel features listed below.



-----

## Features to implement

Here's the [list of Roadmap features](https://github.com/LaravelDaily/Laravel-Roadmap-Learning-Path#beginner-level) you need to try to implement in your code:


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

If you need help, or you want to compare your version with our simple version, here's [the public repository](https://github.com/LaravelDaily/Laravel-Roadmap-Advanced-Beginner-Roadmap) with a _possible_ solution.

**Notice**: please look at that repository only AFTER you've accomplished the task yourself, or if you're confident about your Laravel Advanced Beginner skills and you think you don't need to practice this task.
