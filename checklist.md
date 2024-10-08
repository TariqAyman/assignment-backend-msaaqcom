Assignment Blueprint for backend
===============================

This is a Laravel blueprint for backend development, for creating a multi-tenant application **(single database)** to manage quizzes

## Installation
- [x] clone this repository `git clone git@github.com:TariqAyman/assignment-backend-msaaqcom.git`
- [x] edit origin to make new one for your custom repository in Github `git remote set-url origin` and add your repository url
- [x] cd into the project directory `cd quiz`
- [x] run `composer install`
- [x] run `cp .env.example .env`
- [x] run migration `php artisan migrate`
- [x] serve the application `php artisan serve` or use laravel valet, or any other server
- [x] visit the application in your browser `http://quiz.test` if you are using valet

## Multi-tenancy
This application is multi-tenant, meaning that it can serve multiple clients with a single codebase. To achieve this, we use the [tenancyforlaravel](https://tenancyforlaravel.com/) package. The package is already installed and configured.

## Available models
- [x] Tenant
- [x] User
- [x] Quiz
- [x] Question
- [x] Choice

>Note: you should create missing models, and migrations if needed, or any needed changes to the existing models.

## Your Tasks

### Main Tasks
- [x] Ability to register a new tenant.
- [x] Ability to create a new quiz with two types for (in-time quiz, and out-of-time quiz).
    - [x] >Note: in-time quiz is a quiz that has a start time, and end time, and the user can take the quiz only between these times. out-of-time quiz is a quiz that has no start time, and end time, and the user can take the quiz anytime.
- [x] Ability to manage questions.
- [x] Ability to manage choices.
- [x] Ability to register new accounts for a tenant members
   - [x] >Note: members should be in separated table from the tenant owner(users).
- [x] Ability to login/logout for a tenant member.
- [x] Ability to subscribe to a quiz for a member.
- [ ] Ability to integrate with Google calendar, and add a quiz (starts/ends time) to the calendar for a member.
- [x] Ability to remind a member to take a quiz before the quiz starts time.
- [x] Ability to add attempts for a quiz for a member.
- [x] Ability to take a quiz using a unique link for every member by only email, and send the link to email.
- [x] Ability to view the result of a quiz after taking it.
- [x] Ability to email the member after taking the quiz with the result of the quiz, and the correct answers.
- [ ] Ability to email the owner of the tenant after a client takes a quiz.
- [x] Ability to view quiz results for all members by tenant owner, you can use [filament](https://filamentphp.com/) for this [bonus point].
- [x] Ability to export quiz results for all members by tenant owner to csv with filters by using queues.
    >Note: use seeders to create dummy data for exporting. minimum 20000 records.
- [x] Ability to view dashboards for:
  - [x] Number of members
  - [x] Attempts
  - [x] Pass rate
  - [x] Fail rate
  - [x] Average score
  - [x] Average time (for in-time quiz)
- [x] Create a REST API for the application, and document it using [Postman](https://www.postman.com/).
- [ ] Write tests for the application using [pest](https://pestphp.com/), already installed.
- [ ] write stress testing for the application using [pest](https://pestphp.com/) [bonus point].
- [ ] Write a `README.md` file for the application, explaining how to setup and run the application, and how to use the REST API with example for every endpoint.
- [ ] Write a `CHANGELOG.md` file for the application, explaining the changes you made to the application, and the new features you added.

### Devops Tasks
- [ ] Dockerize the application
- [ ] Setup a CI/CD pipeline for the application using GitHub actions
- [ ] Deploy the application to a server of your choice [bonus point]

## Points to consider
- [ ] Use queues for sending emails, and other heavy tasks you may have [show your knowledge/skills of queues].
- [ ] Use queues priority for organizing queues jobs/tasks [bonus point].
- [x] Make sure to use the correct relationships between models, and use the correct database structure.
- [ ] Write a clean code, and follow the best practices.
- [ ] Write a clean commit messages.

## Notes
- [x] You can use [tailwindcss](https://tailwindcss.com/) for the frontend, with its free UI kit [tailwindui](https://tailwindui.com/).
