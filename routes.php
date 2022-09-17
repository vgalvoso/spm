<?php
use App\Controller\Home;

get('',Home::class,"index");
post('post',Home::class,"samplePost");
get('get',Home::class,"sampleGet");

notFound();