<?php

namespace App\DataTable;

use Illuminate\Support\Facades\Route;

class DTHelper
{
    /**
     * @param string $prefix
     * @param string $controllerName
     * @param string $permission
     * @param string $basePrefix
     */
    public static function BuildRoutes(string $prefix, string $controllerName, string $permission, string $basePrefix = ''): void
    {
        Route::group(['prefix' => $prefix, 'middleware' => $permission], function () use ($prefix, $controllerName) {
            Route::get('/', "{$controllerName}@index")->name($prefix);
            Route::get('datatable', "{$controllerName}@datatable")->name("{$prefix}_datatable");
            Route::get('create', "{$controllerName}@create")->name("{$prefix}_create");
            Route::post('store', "{$controllerName}@store")->name("{$prefix}_store");
            Route::get('edit/{id?}', "{$controllerName}@edit")->name("{$prefix}_edit");
            Route::post('update/{id?}', "{$controllerName}@update")->name("{$prefix}_update");
            Route::post('status', "{$controllerName}@change_status")->name("{$prefix}_status");
            Route::post('delete/{id?}', "{$controllerName}@delete")->name("{$prefix}_delete");
            Route::post('reorder', "{$controllerName}@reorder")->name("{$prefix}_reorder");
        });
    }
}
