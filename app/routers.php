<?php

Router::get('/home', 'HomeController@index');
Router::get('/home/details/{name}', 'HomeController@details');
