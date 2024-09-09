### Task Management API
## Overview
This project is an advanced API for task management that allows users to create, update, view, delete, and assign tasks with various properties such as title, description, priority, due date, status, and assigned_to. The project also includes role-based access control (Admin, Manager, User) to manage permissions and actions within the API.


### Features
- **Role-based access control:**:
- --**Admin**: Full control over tasks and users.
- --**Manager**: Can assign tasks to users and manage the tasks they created or assigned..
- --**User**: Can only update tasks assigned to them.
- - **Task CRUD operations:**:
- --Create, read, update, and delete tasks.
- - **Assigning tasks**:
- --Managers can assign tasks to users. Users can only modify tasks assigned to them.
- - **Soft Deletes:**:
- --Tasks and users can be soft-deleted and restored later.
- - **Task filtering:**:
- --Filter tasks by priority and status using custom query scopes.
- - **Date handling:**:
- --Custom formatting for due dates.

 ### 1.Requirements

Before that, make sure you have the following installed:

- PHP 7.4 or higher
- Composer (dependencies manager for PHP)
- Node.js and npm (to manage JavaScript dependencies)
- MySQL (or other supported database system)
-Postman (for testing the API) or Swagger

### Installation
1. git clone <https://github.com/Youssef2524/Task-Management-API.git>
2. composer install
3. Rename or copy .env.example file to .env
4. php artisan key:generate
5. php artisan migrate 
6. php artisan db:seed 
7. php artisan serve


