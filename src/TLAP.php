<?php

namespace the42coders\TLAP;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use the42coders\TLAP\Fields\CheckboxField;
use the42coders\TLAP\Fields\NumberField;
use the42coders\TLAP\Fields\TextField;
use the42coders\TLAP\Fields\TimeStampField;
use the42coders\TLAP\Fields\PasswordField;
use the42coders\TLAP\Http\Controllers\TLAPController;

class TLAP
{

    public static $fields;

    public static function routes()
    {
        Route::group(['prefix' => config('tlap.path'), 'namespace' => __NAMESPACE__.'\Http\Controllers'], function () {
            Route::get('/', 'TLAPController@start')->name('tlap.start');
            Route::get('/{models}/', [TLAPController::class, 'index'])->name('tlap.index');
            Route::post('/{models}/', [TLAPController::class, 'store'])->name('tlap.store');
            Route::get('/{models}/create', [TLAPController::class, 'create'])->name('tlap.create');
            Route::get('/{models}/{id}/show', [TLAPController::class, 'show'])->name('tlap.show');
            Route::get('/{models}/{id}/edit', [TLAPController::class, 'edit'])->name('tlap.edit');
            Route::post('/{models}/{id}/', [TLAPController::class, 'update'])->name('tlap.update');
            Route::get('/{models}/{id}/delete', [TLAPController::class, 'delete'])->name('tlap.delete');
            Route::get('/{models}/datatable', [TLAPController::class, 'datatable'])->name('tlap.datatable');
        });
    }

    public static function getForm($columnName, $columnInfo, $model = null)
    {

        if($columnInfo['type'] == 'timestamp'){
            $field = new TimeStampField($columnName);
            return $field->render($model);
        }

        if($columnName == 'pw' || $columnName == 'password'){
            $field = new PasswordField($columnName);
            return $field->render($model);
        }
        if($columnInfo['type'] === 'tinyint(1)'){
            $field = new CheckboxField($columnName);
            return $field->render($model);
        }

        if(strpos($columnInfo['type'], 'int') !== false){
            $field = new NumberField($columnName);
            return $field->render($model);
        }



        $field = new TextField($columnName);

        return $field->render($model);
    }
}