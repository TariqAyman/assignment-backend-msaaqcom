Assignment Blueprint for backend
===============================

This is a Laravel blueprint for backend development, for creating a multi-tenant application **(single database)** to manage quizzes

## Installation
- clone this repository `git clone git@github.com:TariqAyman/assignment-backend-msaaqcom.git`
- cd into the project directory `cd quiz`
- run `composer install`
- run `npm install`
- run `cp .env.example .env`
- run migration and seeders `php artisan migrate --seed`
- serve the application `php artisan serve` or use laravel valet, or any other server
- run `npm run dev`
- visit the application in your browser `http://localhost:8000`
- visit postman document https://documenter.getpostman.com/view/2573933/2sA3XLDiGy

## APIs

| Method         | URI                                                                                                      | Action                                                                                                                                                     |
|----------------|----------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| GET|HEAD       | quizzes.test/                                                                                           |                                                                                                                                                            |
| GET|HEAD       | /                                                                                                        |                                                                                                                                                            |
| GET|HEAD       | admin                                                                                                    | filament.admin.tenant › Filament\Http › RedirectToTenantController                                                                                          |
| GET|HEAD       | admin/email-verification/prompt                                                                         | filament.admin.auth.email-verification.prompt › Filament\Pages › EmailVerificationPrompt                                                                    |
| GET|HEAD       | admin/email-verification/verify/{id}/{hash}                                                             | filament.admin.auth.email-verification.verify › Filament\Http › EmailVerificationController                                                                 |
| GET|HEAD       | admin/login                                                                                             | filament.admin.auth.login › Filament\Pages › Login                                                                                                          |
| POST           | admin/logout                                                                                            | filament.admin.auth.logout › Filament\Http › LogoutController                                                                                               |
| GET|HEAD       | admin/password-reset/request                                                                            | filament.admin.auth.password-reset.request › Filament\Pages › RequestPasswordReset                                                                          |
| GET|HEAD       | admin/password-reset/reset                                                                              | filament.admin.auth.password-reset.reset › Filament\Pages › ResetPassword                                                                                   |
| GET|HEAD       | admin/register                                                                                          | filament.admin.auth.register › App\Filament\Pages\Register                                                                                                  |
| GET|HEAD       | admin/{tenant}                                                                                          | filament.admin.pages.dashboard › Filament\Pages › Dashboard                                                                                                |
| GET|HEAD       | admin/{tenant}/admin/answers                                                                            | filament.admin.resources.admin.answers.index › App\Filament\Resources\Admin\AnswerResource\Pages\ListAnswers                                                |
| GET|HEAD       | admin/{tenant}/admin/answers/create                                                                     | filament.admin.resources.admin.answers.create › App\Filament\Resources\Admin\AnswerResource\Pages\CreateAnswer                                              |
| GET|HEAD       | admin/{tenant}/admin/answers/{record}/edit                                                              | filament.admin.resources.admin.answers.edit › App\Filament\Resources\Admin\AnswerResource\Pages\EditAnswer                                                  |
| GET|HEAD       | admin/{tenant}/admin/attempts                                                                           | filament.admin.resources.admin.attempts.index › App\Filament\Resources\Admin\AttemptResource\Pages\ListAttempts                                             |
| GET|HEAD       | admin/{tenant}/admin/attempts/create                                                                    | filament.admin.resources.admin.attempts.create › App\Filament\Resources\Admin\AttemptResource\Pages\CreateAttempt                                           |
| GET|HEAD       | admin/{tenant}/admin/attempts/{record}/edit                                                             | filament.admin.resources.admin.attempts.edit › App\Filament\Resources\Admin\AttemptResource\Pages\EditAttempt                                               |
| GET|HEAD       | admin/{tenant}/admin/members                                                                            | filament.admin.resources.admin.members.index › App\Filament\Resources\Admin\MemberResource\Pages\ListMembers                                                |
| GET|HEAD       | admin/{tenant}/admin/members/create                                                                     | filament.admin.resources.admin.members.create › App\Filament\Resources\Admin\MemberResource\Pages\CreateMember                                              |
| GET|HEAD       | admin/{tenant}/admin/members/{record}/edit                                                              | filament.admin.resources.admin.members.edit › App\Filament\Resources\Admin\MemberResource\Pages\EditMember                                                  |
| GET|HEAD       | admin/{tenant}/admin/quizzes                                                                            | filament.admin.resources.admin.quizzes.index › App\Filament\Resources\Admin\QuizResource\Pages\ListQuizzes                                                  |
| GET|HEAD       | admin/{tenant}/admin/quizzes/create                                                                     | filament.admin.resources.admin.quizzes.create › App\Filament\Resources\Admin\QuizResource\Pages\CreateQuiz                                                  |
| GET|HEAD       | admin/{tenant}/admin/quizzes/{record}/edit                                                              | filament.admin.resources.admin.quizzes.edit › App\Filament\Resources\Admin\QuizResource\Pages\EditQuiz                                                      |
| GET|HEAD       | quizzes.test/api/user                                                                                   |                                                                                                                                                            |
| GET|HEAD       | quizzes.test/api/v1/member/auth/list-tenants                                                            | api.v1. › API\V1\Member\Auth\ListTenantsController                                                                                                          |
| POST           | quizzes.test/api/v1/member/auth/login                                                                   | api.v1. › API\V1\Member\Auth\LoginController@authenticate                                                                                                   |
| POST           | quizzes.test/api/v1/member/auth/logout                                                                  | api.v1. › API\V1\Member\Auth\LoginController@logout                                                                                                          |
| POST           | quizzes.test/api/v1/member/auth/register                                                                | api.v1. › API\V1\Member\Auth\RegisterController                                                                                                             |
| GET|HEAD       | quizzes.test/api/v1/member/dashboard                                                                    | api.v1. › API\V1\Member\DashboardController                                                                                                                 |
| POST           | quizzes.test/api/v1/member/quiz/subscribe                                                               | api.v1. › API\V1\Member\QuizSubscribeController                                                                                                             |
| POST           | quizzes.test/api/v1/member/quiz/{id}/answer                                                             | api.v1. › API\V1\Member\AnswerQuestionController                                                                                                            |
| GET|HEAD       | quizzes.test/api/v1/member/quizzes                                                                      | api.v1.quizzes.index › API\V1\Member\QuizController@index                                                                                                   |
| GET|HEAD       | quizzes.test/api/v1/member/quizzes/{quiz}                                                               | api.v1.quizzes.show › API\V1\Member\QuizController@show                                                                                                      |
| POST           | quizzes.test/api/v1/tenant/auth/login                                                                   | api.v1. › API\V1\Tenant\Auth\LoginController@authenticate                                                                                                   |
| POST           | quizzes.test/api/v1/tenant/auth/logout                                                                  | api.v1. › API\V1\Tenant\Auth\LoginController@logout                                                                                                          |
| POST           | quizzes.test/api/v1/tenant/auth/register                                                                | api.v1. › API\V1\Tenant\Auth\RegisterController                                                                                                             |
| GET|HEAD       | quizzes.test/api/v1/tenant/dashboard                                                                    | api.v1. › API\V1\Tenant\DashboardController                                                                                                                 |
| GET|HEAD       | quizzes.test/api/v1/tenant/quizzes                                                                      | api.v1.quizzes.index › API\V1\Tenant\QuizController@index                                                                                                   |
| POST           | quizzes.test/api/v1/tenant/quizzes                                                                      | api.v1.quizzes.store › API\V1\Tenant\QuizController@store                                                                                                    |
| GET|HEAD       | quizzes.test/api/v1/tenant/quizzes/{quiz}                                                               | api.v1.quizzes.show › API\V1\Tenant\QuizController@show                                                                                                      |
| PUT|PATCH      | quizzes.test/api/v1/tenant/quizzes/{quiz}                                                               | api.v1.quizzes.update › API\V1\Tenant\QuizController@update                                                                                                  |
| DELETE         | quizzes.test/api/v1/tenant/quizzes/{quiz}                                                               | api.v1.quizzes.destroy › API\V1\Tenant\QuizController@destroy                                                                                               |
| GET|HEAD       | quizzes.test/confirm-password                                                                           | password.confirm › Auth\ConfirmablePasswordController@show                                                                                                   |
| POST           | quizzes.test/confirm-password                                                                           | Auth\ConfirmablePasswordController@store                                                                                                                    |
| GET|HEAD       | quizzes.test/dashboard                                                                                  | dashboard                                                                                                                                                  |
| POST           | quizzes.test/email/verification-notification                                                            | verification.send › Auth\EmailVerificationNotificationController@store                                                                                      |
| GET|HEAD       | filament/exports/{export}/download                                                                      | filament.exports.download › Filament\Actions › DownloadExport                                                                                               |
| GET|HEAD       | filament/imports/{import}/failed-rows/download                                                          | filament.imports.failed-rows.download › Filament\Actions › DownloadImportFailureCsv                                                                          |
| GET|HEAD       | quizzes.test/forgot-password                                                                            | password.request › Auth\PasswordResetLinkController@create                                                                                                   |
| POST           | quizzes.test/forgot-password                                                                            | password.email › Auth\PasswordResetLinkController@store                                                                                                      |
| GET|HEAD       | livewire/livewire.js                                                                                    | Livewire\Mechanisms › FrontendAssets@returnJavaScriptAsFile                                                                                                  |
| GET|HEAD       | livewire/livewire.min.js.map                                                                            | Livewire\Mechanisms › FrontendAssets@maps                                                                                                                   |
| GET|HEAD       | livewire/preview-file/{filename}                                                                        | livewire.preview-file › Livewire\Features › FilePreviewController@handle                                                                                    |
| POST           | livewire/update                                                                                         | livewire.update › Livewire\Mechanisms › HandleRequests@handleUpdate                                                                                         |
| POST           | livewire/upload-file                                                                                    | livewire.upload-file › Livewire\Features › FileUploadController@handle                                                                                       |
| GET|HEAD       | quizzes.test/login                                                                                      | login › Auth\AuthenticatedSessionController@create                                                                                                           |
| POST           | quizzes.test/login                                                                                      | Auth\AuthenticatedSessionController@store                                                                                                                   |
| POST           | quizzes.test/logout                                                                                     | logout › Auth\AuthenticatedSessionController@destroy                                                                                                         |
| GET|HEAD       | member                                                                                                  | filament.member.tenant › Filament\Http › RedirectToTenantController                                                                                          |
| GET|HEAD       | member/email-verification/prompt                                                                       | filament.member.auth.email-verification.prompt › Filament\Pages › EmailVerificationPrompt                                                                    |
| GET|HEAD       | member/email-verification/verify/{id}/{hash}                                                           | filament.member.auth.email-verification.verify › Filament\Http › EmailVerificationController                                                                 |
| GET|HEAD       | member/login                                                                                           | filament.member.auth.login › Filament\Pages › Login                                                                                                          |
| POST           | member/logout                                                                                          | filament.member.auth.logout › Filament\Http › LogoutController                                                                                               |
| GET|HEAD       | member/password-reset/request                                                                          | filament.member.auth.password-reset.request › Filament\Pages › RequestPasswordReset                                                                          |
| GET|HEAD       | member/password-reset/reset                                                                            | filament.member.auth.password-reset.reset › Filament\Pages › ResetPassword                                                                                   |
| GET|HEAD       | member/register                                                                                        | filament.member.auth.register › App\Filament\Pages\Register                                                                                                  |
| GET|HEAD       | member/{tenant}                                                                                        | filament.member.pages.dashboard › Filament\Pages › Dashboard                                                                                                |
| GET|HEAD       | member/{tenant}/member/answers                                                                         | filament.member.resources.member.answers.index › App\Filament\Resources\Member\AnswerResource\Pages\ListAnswers                                              |
| GET|HEAD       | member/{tenant}/member/answers/create                                                                  | filament.member.resources.member.answers.create › App\Filament\Resources\Member\AnswerResource\Pages\CreateAnswer                                            |
| GET|HEAD       | member/{tenant}/member/answers/{record}/edit                                                           | filament.member.resources.member.answers.edit › App\Filament\Resources\Member\AnswerResource\Pages\EditAnswer                                               |
| GET|HEAD       | member/{tenant}/member/attempts                                                                        | filament.member.resources.member.attempts.index › App\Filament\Resources\Member\AttemptResource\Pages\ListAttempts                                           |
| GET|HEAD       | member/{tenant}/member/attempts/create                                                                 | filament.member.resources.member.attempts.create › App\Filament\Resources\Member\AttemptResource\Pages\CreateAttempt                                         |
| GET|HEAD       | member/{tenant}/member/attempts/{record}/edit                                                          | filament.member.resources.member.attempts.edit › App\Filament\Resources\Member\AttemptResource\Pages\EditAttempt                                             |
| GET|HEAD       | member/{tenant}/member/members                                                                         | filament.member.resources.member.members.index › App\Filament\Resources\Member\MemberResource\Pages\ListMembers                                              |
| GET|HEAD       | member/{tenant}/member/members/create                                                                  | filament.member.resources.member.members.create › App\Filament\Resources\Member\MemberResource\Pages\CreateMember                                            |
| GET|HEAD       | member/{tenant}/member/members/{record}/edit                                                           | filament.member.resources.member.members.edit › App\Filament\Resources\Member\MemberResource\Pages\EditMember                                                |
| GET|HEAD       | member/{tenant}/member/quizzes                                                                         | filament.member.resources.member.quizzes.index › App\Filament\Resources\Member\QuizResource\Pages\ListQuizzes                                                |
| GET|HEAD       | member/{tenant}/member/quizzes/create                                                                  | filament.member.resources.member.quizzes.create › App\Filament\Resources\Member\QuizResource\Pages\CreateQuiz                                                |
| GET|HEAD       | member/{tenant}/member/quizzes/{record}/edit                                                           | filament.member.resources.member.quizzes.edit › App\Filament\Resources\Member\QuizResource\Pages\EditQuiz                                                    |
| GET|HEAD       | quizzes.test/register                                                                                  | register › Auth\RegisteredUserController@create                                                                                                              |
| POST           | quizzes.test/register                                                                                  | Auth\RegisteredUserController@store                                                                                                                         |
| GET|HEAD       | quizzes.test/reset-password/{token}                                                                    | password.reset › Auth\NewPasswordController@create                                                                                                           |
| POST           | quizzes.test/reset-password                                                                            | password.update › Auth\NewPasswordController@store                                                                                                           |
| GET|HEAD       | sanctum/csrf-cookie                                                                                    | sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController                                                                                                 |


## Multi-tenancy
This application is multi-tenant, meaning that it can serve multiple clients with a single codebase. To achieve this, we use the [tenancyforlaravel](https://tenancyforlaravel.com/) package. The package is already installed and configured.

## Available models
- Tenant
- User
- Quiz
- Question
- Choice

>Note: you should create missing models, and migrations if needed, or any needed changes to the existing models.

## Your Tasks

### Main Tasks
- Ability to register a new tenant.
- Ability to create a new quiz with two types for (in-time quiz, and out-of-time quiz).
    >Note: in-time quiz is a quiz that has a start time, and end time, and the user can take the quiz only between these times. out-of-time quiz is a quiz that has no start time, and end time, and the user can take the quiz anytime.
- Ability to manage questions.
- Ability to manage choices.
- Ability to register new accounts for a tenant members
  >Note: members should be in separated table from the tenant owner(users).
- Ability to login/logout for a tenant member.
- Ability to subscribe to a quiz for a member.
- Ability to integrate with Google calendar, and add a quiz (starts/ends time) to the calendar for a member.
- Ability to remind a member to take a quiz before the quiz starts time.
- Ability to add attempts for a quiz for a member.
- Ability to take a quiz using a unique link for every member by only email, and send the link to email.
- Ability to view the result of a quiz after taking it.
- Ability to email the member after taking the quiz with the result of the quiz, and the correct answers.
- Ability to email the owner of the tenant after a client takes a quiz.
- Ability to view quiz results for all members by tenant owner, you can use [filament](https://filamentphp.com/) for this [bonus point].
- Ability to export quiz results for all members by tenant owner to csv with filters by using queues.
    >Note: use seeders to create dummy data for exporting. minimum 20000 records.
- Ability to view dashboards for:
  - Number of members
  - Attempts
  - Pass rate
  - Fail rate
  - Average score
  - Average time (for in-time quiz)
- Create a REST API for the application, and document it using [Postman](https://www.postman.com/).
- Write tests for the application using [pest](https://pestphp.com/), already installed.
- write stress testing for the application using [pest](https://pestphp.com/) [bonus point].
- Write a `README.md` file for the application, explaining how to setup and run the application, and how to use the REST API with example for every endpoint.
- Write a `CHANGELOG.md` file for the application, explaining the changes you made to the application, and the new features you added.

### Devops Tasks
- Dockerize the application
- Setup a CI/CD pipeline for the application using GitHub actions
- Deploy the application to a server of your choice [bonus point]

## Points to consider
- Use queues for sending emails, and other heavy tasks you may have [show your knowledge/skills of queues].
- Use queues priority for organizing queues jobs/tasks [bonus point].
- Make sure to use the correct relationships between models, and use the correct database structure.
- Write a clean code, and follow the best practices.
- Write a clean commit messages.

## Notes
- You can use [tailwindcss](https://tailwindcss.com/) for the frontend, with its free UI kit [tailwindui](https://tailwindui.com/).
