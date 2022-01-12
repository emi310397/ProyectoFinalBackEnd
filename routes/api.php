<?php

declare(strict_types=1);

use Presentation\Http\Actions;
use Presentation\Http\Middleware\AuthenticateMiddleware;

Route::get('/ping', 'PingAction@execute')
    ->name(Actions\PingAction::ROUTE_NAME)
    ->withoutMiddleware([AuthenticateMiddleware::class])
    ->middleware('local');

Route::post('/login', 'Auth\LoginUserAction@execute')
    ->name(Actions\Auth\LoginUserAction::ROUTE_NAME)
    ->withoutMiddleware([AuthenticateMiddleware::class]);

Route::post('/signup', 'Teacher\CreateTeacherAction@execute')
    ->name(Actions\Teacher\CreateTeacherAction::ROUTE_NAME)
    ->withoutMiddleware([AuthenticateMiddleware::class]);

Route::post('/confirm', 'Auth\ConfirmUserAction@execute')
    ->name(Actions\Auth\ConfirmUserAction::ROUTE_NAME)
    ->withoutMiddleware([AuthenticateMiddleware::class]);

Route::post('/logout', 'Auth\LogoutUserAction@execute')
    ->name(Actions\Auth\LogoutUserAction::ROUTE_NAME);

//Teacher Routes
Route::middleware(['role:teacher'])->group(
    function () {
//--------------------Course--------------------
        Route::post('/courses', 'Course\CreateCourseAction@execute')
            ->name(Actions\Course\CreateCourseAction::ROUTE_NAME);

        Route::put('/courses/{id}', 'Course\EditCourseAction@execute')
            ->name(Actions\Course\EditCourseAction::ROUTE_NAME);

        Route::delete('/courses/{id}', 'Course\DeleteCourseAction@execute')
            ->name(Actions\Course\DeleteCourseAction::ROUTE_NAME);

        Route::get('/courses/{id}', 'Course\GetCourseAction@execute')
            ->name(Actions\Course\GetCourseAction::ROUTE_NAME);

//--------------------Student Group--------------------
        Route::post('/student-groups', 'StudentGroup\CreateStudentGroupAction@execute')
            ->name(Actions\StudentGroup\CreateStudentGroupAction::ROUTE_NAME);

        Route::put('/student-groups/{id}', 'StudentGroup\EditStudentGroupAction@execute')
            ->name(Actions\StudentGroup\EditStudentGroupAction::ROUTE_NAME);

        Route::delete('/student-groups/{id}', 'StudentGroup\DeleteStudentGroupAction@execute')
            ->name(Actions\StudentGroup\DeleteStudentGroupAction::ROUTE_NAME);

        Route::get('/student-groups/{id}', 'StudentGroup\GetStudentGroupAction@execute')
            ->name(Actions\StudentGroup\GetStudentGroupAction::ROUTE_NAME);

//--------------------Task--------------------
        Route::post('courses/{id}/tasks', 'Task\CreateTaskAction@execute')
            ->name(Actions\Task\CreateTaskAction::ROUTE_NAME);

        Route::put('/tasks/{id}', 'Task\EditTaskAction@execute')
            ->name(Actions\Task\EditTaskAction::ROUTE_NAME);

        Route::delete('/tasks/{id}', 'Task\DeleteTaskAction@execute')
            ->name(Actions\Task\DeleteTaskAction::ROUTE_NAME);

        Route::get('/tasks/{id}', 'Task\GetTaskAction@execute')
            ->name(Actions\Task\GetTaskAction::ROUTE_NAME);

//--------------------Assigment--------------------
        Route::post('/assigments', 'Assignment\CreateAssignmentAction@execute')
            ->name(Actions\Assignment\CreateAssignmentAction::ROUTE_NAME);

//--------------------Activity--------------------
        Route::post('/activities', 'Activity\CreateActivityAction@execute')
            ->name(Actions\Activity\CreateActivityAction::ROUTE_NAME);

//--------------------Other--------------------
        Route::post('/student', 'Student\CreateStudentAction@execute')
            ->name(Actions\Student\CreateStudentAction::ROUTE_NAME);
    }
);

//Student Routes
Route::middleware(['role:student'])->group(
    function () {
    }
);

//Teacher and Student Shared Routes
Route::middleware('role:teacher,student')->group(
    function () {
        Route::get('/current-user', 'User\GetCurrentUserAction@execute')
            ->name(Actions\User\GetCurrentUserAction::ROUTE_NAME);

        Route::get('/courses', 'Course\GetCoursesAction@execute')
            ->name(Actions\Course\GetCoursesAction::ROUTE_NAME);

        Route::get('courses/{id}/student-groups', 'StudentGroup\GetStudentGroupsAction@execute')
            ->name(Actions\StudentGroup\GetStudentGroupsAction::ROUTE_NAME);

        Route::get('courses/{id}/tasks', 'Task\GetTasksAction@execute')
            ->name(Actions\Task\GetTasksAction::ROUTE_NAME);
    }
);
