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

//Teacher Routes
Route::middleware(['role:teacher'])->group(
    function () {
        Route::post('/classes', 'PClass\CreatePClassAction@execute')
            ->name(Actions\PClass\CreatePClassAction::ROUTE_NAME);

        Route::put('/classes/{id}', 'PClass\EditPClassAction@execute')
            ->name(Actions\PClass\EditPClassAction::ROUTE_NAME);

        Route::delete('/classes/{id}', 'PClass\DeletePClassAction@execute')
            ->name(Actions\PClass\DeletePClassAction::ROUTE_NAME);

        Route::get('/classes/{id}', 'PClass\GetPClassAction@execute')
            ->name(Actions\PClass\GetPClassAction::ROUTE_NAME);

        Route::get('/classes', 'PClass\GetPClassesAction@execute')
            ->name(Actions\PClass\GetPClassesAction::ROUTE_NAME);

        Route::post('/tasks', 'Task\CreateTaskAction@execute')
            ->name(Actions\Task\CreateTaskAction::ROUTE_NAME);

        Route::put('/tasks', 'Task\EditTaskAction@execute')
            ->name(Actions\Task\EditTaskAction::ROUTE_NAME);

        Route::get('/tasks/{id}', 'Task\GetTaskAction@execute')
            ->name(Actions\Task\GetTaskAction::ROUTE_NAME);

        Route::get('/tasks', 'Task\GetTasksAction@execute')
            ->name(Actions\Task\GetTasksAction::ROUTE_NAME);

        Route::post('/assigment', 'Assignment\CreateAssignmentAction@execute')
            ->name(Actions\Assignment\CreateAssignmentAction::ROUTE_NAME);
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
    }
);
