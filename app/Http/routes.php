<?php

Route::get("/", "PageController@index");
Route::get("dashboard", "PageController@dashboard");

Route::get("auth/youtube", "Auth\AuthController@redirectToProvider");
Route::get("auth/youtube/callback", "Auth\AuthController@handleProviderCallback");

Route::get("sync/all", "SyncController@all");
