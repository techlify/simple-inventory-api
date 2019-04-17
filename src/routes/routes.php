<?php

Route::group(['prefix' => 'api', 'middleware' => 'api'], function()
{
    Route::get("/inventory/items", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryItemController@index");
    Route::post("/inventory/items", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryItemController@store");
    Route::patch("/inventory/items/{id}", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryItemController@update");
    Route::get("/inventory/items/{id}", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryItemController@show");

    Route::post("/inventory/ins", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryInController@store");
    Route::get("/inventory/ins", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryInController@index");
    Route::delete("/inventory/ins/{id}", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryInController@destroy");
    Route::put("/inventory/ins/{id}", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryInController@update");

    Route::post("/inventory/outs", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryOutController@store");
    Route::get("/inventory/outs", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryOutController@index");
    Route::delete("/inventory/outs/{id}", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryOutController@destroy");
    Route::put("/inventory/outs/{id}", "TechlifyInc\TechlifySimpleInventory\Controllers\InventoryOutController@update");
});