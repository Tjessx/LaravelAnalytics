<?php

Route::get('/analytics', 'BertBijnens\\LaravelAnalytics\\Controllers\\HomeController@index')->name('analytics.sites.details');

Route::post('/analytics/sites/{site}', 'BertBijnens\\LaravelAnalytics\\Controllers\\HomeController@update')->name('analytics.sites.update');
Route::get('/analytics/sites/{site}/stats', 'BertBijnens\\LaravelAnalytics\\Controllers\\HomeController@stats')->name('analytics.sites.details.stats');
Route::get('/analytics/sites/{site}/charts', 'BertBijnens\\LaravelAnalytics\\Controllers\\HomeController@charts')->name('analytics.sites.details.charts');