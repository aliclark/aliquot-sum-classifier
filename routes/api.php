<?php

Route::get('aliquot-sum-classifications/{n}', 'Api\AliquotSumClassificationController@show')->where('n', '[1-9][0-9]*');
