Installation Commands
1. Install PHP Dependencies

 composer install
2. Install Frontend Dependencies
     npm install
3.   Authentication Scaffolding (Laravel UI)
    composer require laravel/ui
   php artisan ui bootstrap --auth
 npm install
 npm run build
4.   Create Environment File
 cp .env.example .env
5.   Generate Application Key
 php artisan key:generate


Configure Database
Update the following values in .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leave_management
DB_USERNAME=root
DB_PASSWORD=

Run Migrations and Seeders 

php artisan migrate:fresh --seed

Start Development Server 

php artisan serve

Compile Frontend Assets

Development:

12. npm run dev

Production:

13. npm run build

# Test User Credentials

After running:

```bash
php artisan migrate:fresh --seed
```

the following demo accounts will be available.

## Administrator Account

| Field    | Value            |
| -------- | ---------------- |
| Email    | [admin@test.com] |
| Password | password         |
| Role     | Administrator    |

Permissions:

- User Management
- Leave Configuration
- Reports
- Audit Logs
- Dashboard Monitoring

---

## Manager Account 1

| Field    | Value               |
| -------- | ------------------- |
| Email    | [manager1@test.com] |
| Password | password            |
| Role     | Manager             |

Permissions:

- Review Leave Requests
- Approve Leave Requests
- Reject Leave Requests
- Dashboard Monitoring

---

## Manager Account 2

| Field    | Value               |
| -------- | ------------------- |
| Email    | [manager2@test.com] |
| Password | password            |
| Role     | Manager             |

Permissions:

- Review Leave Requests
- Approve Leave Requests
- Reject Leave Requests
- Dashboard Monitoring

---

## Employee Account

| Field    | Value               |
| -------- | ------------------- |
| Email    | [employee@test.com] |
| Password | password            |
| Role     | Employee            |

Permissions:

- Apply for Leave
- View Leave History
- View Leave Balance
- Dashboard Access

---

## Additional Seeded Users

The database seeder also generates:

- 20 additional employee accounts using Laravel Factories
- Random departments (IT, HR, Finance)
- Random designations
- Manager assignments
- Leave balances

These accounts can be used for testing search, reporting, approval workflows, and dashboard statistics.

# Assumptions Made During Development

1. Each employee is assigned to exactly one manager.

2. A manager can supervise multiple employees.

3. Employee accounts are created and managed by the Administrator.

4. Leave balances are automatically allocated when a new employee is created.

5. Leave balances are reduced only after a leave request is approved.

6. Rejected leave requests do not affect leave balances.

7. Employees cannot submit overlapping leave requests for the same period.

8. Leave duration is calculated inclusively between the selected start date and end date.

    Example:
    - Start Date: 01-Jun-2026
    - End Date: 03-Jun-2026
    - Total Leave Days: 3

9. Public holidays and weekends are not excluded from leave calculations.

10. Manager approval is considered the final approval step.

11. Multi-level approval workflows are outside the scope of this implementation.

12. Employees can view only their own leave records.

13. Managers can view only leave requests assigned to them.

14. Administrators have access to all users, leave requests, reports, and audit logs.

15. User accounts are not permanently deleted; users can be marked as Active or Inactive.

16. Approved leave requests cannot be modified by employees.

17. Leave requests are created with a default status of "Pending".

18. Email notifications and SMS notifications are outside the scope of this assessment.

19. The application is intended for demonstration and assessment purposes and does not include enterprise features such as Single Sign-On (SSO), Multi-Factor Authentication (MFA), or external HR integrations.

20. AJAX functionality is implemented for search, filtering, leave submission, and approval workflows to improve user experience without requiring full page refreshes.

# Application Modules

## Authentication

| Route   | Description |
| ------- | ----------- |
| /login  | User Login  |
| /logout | User Logout |

---

## Employee Module

| Route                  | Description          |
| ---------------------- | -------------------- |
| /employee/leave        | View Leave History   |
| /employee/leave/create | Apply Leave          |
| POST /employee/leave   | Submit Leave Request |

Features:

- Apply Leave
- View Leave History
- View Leave Balance
- Leave Filtering

---

## Manager Module

| Route                            | Description                  |
| -------------------------------- | ---------------------------- |
| /manager/dashboard               | Manager Dashboard            |
| /manager/leave-requests          | View Assigned Leave Requests |
| POST /manager/leave/{id}/approve | Approve Leave Request        |
| POST /manager/leave/{id}/reject  | Reject Leave Request         |

Features:

- Review Leave Requests
- Approve Leave Requests
- Reject Leave Requests
- Add Manager Remarks

---

## Administrator Module

### Dashboard

| Route            | Description             |
| ---------------- | ----------------------- |
| /admin/dashboard | Administrator Dashboard |

### User Management

| Route                  | Description |
| ---------------------- | ----------- |
| /admin/users           | View Users  |
| /admin/users/create    | Create User |
| /admin/users/{id}/edit | Edit User   |
| POST /admin/users      | Store User  |
| PUT /admin/users/{id}  | Update User |

### Leave Configuration

| Route                        | Description       |
| ---------------------------- | ----------------- |
| /admin/leave-types           | View Leave Types  |
| /admin/leave-types/{id}/edit | Edit Leave Type   |
| PUT /admin/leave-types/{id}  | Update Leave Type |

### Reports

| Route          | Description        |
| -------------- | ------------------ |
| /admin/reports | View Leave Reports |

### Audit Logs

| Route             | Description            |
| ----------------- | ---------------------- |
| /admin/audit-logs | View System Audit Logs |

---

## AJAX Endpoints

The following operations are performed using AJAX:

- User Search
- Report Filtering
- Leave Application Submission
- Leave Approval
- Leave Rejection
