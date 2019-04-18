<?php

Route::group(['prefix' => 'api', 'middleware' => 'api'], function()
{
    Route::get("/inventory/items", "Techlify\SimpleInventory\Controllers\InventoryItemController@index");
    Route::post("/inventory/items", "Techlify\SimpleInventory\Controllers\InventoryItemController@store");
    Route::patch("/inventory/items/{id}", "Techlify\SimpleInventory\Controllers\InventoryItemController@update");
    Route::get("/inventory/items/{id}", "Techlify\SimpleInventory\Controllers\InventoryItemController@show");

    Route::post("/inventory/ins", "Techlify\SimpleInventory\Controllers\InventoryInController@store");
    Route::get("/inventory/ins", "Techlify\SimpleInventory\Controllers\InventoryInController@index");
    Route::delete("/inventory/ins/{id}", "Techlify\SimpleInventory\Controllers\InventoryInController@destroy");
    Route::put("/inventory/ins/{id}", "Techlify\SimpleInventory\Controllers\InventoryInController@update");

    Route::post("/inventory/outs", "Techlify\SimpleInventory\Controllers\InventoryOutController@store");
    Route::get("/inventory/outs", "Techlify\SimpleInventory\Controllers\InventoryOutController@index");
    Route::delete("/inventory/outs/{id}", "Techlify\SimpleInventory\Controllers\InventoryOutController@destroy");
    Route::put("/inventory/outs/{id}", "Techlify\SimpleInventory\Controllers\InventoryOutController@update");
});