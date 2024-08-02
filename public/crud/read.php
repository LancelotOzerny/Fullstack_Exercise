<?php
require_once dirname($_SERVER['DOCUMENT_ROOT'])  . '/classes/reviewtable.php';

$data = [];

$data['reviews'] = ReviewTable::read();

die(json_encode($data));