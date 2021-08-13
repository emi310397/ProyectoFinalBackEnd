<?php

declare(strict_types=1);

use Presentation\Http\Actions;

//Teacher Routes
Route::middleware(['role:teacher'])->group(
    function () {
        Route::post('/classes', 'PClass\CreatePClassAction@execute')
            ->name(Actions\PClass\CreatePClassAction::ROUTE_NAME);

        Route::delete('/classes/{id}', 'PClass\DeletePClassAction@execute')
            ->name(Actions\PClass\DeletePClassAction::ROUTE_NAME);

        Route::get('/classes/{id}', 'PClass\GetPClassAction@execute')
            ->name(Actions\PClass\GetPClassAction::ROUTE_NAME);

        Route::get('/classes', 'PClass\GetPClassesAction@execute')
            ->name(Actions\PClass\GetPClassesAction::ROUTE_NAME);
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
