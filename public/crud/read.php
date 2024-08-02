<?php
require_once dirname($_SERVER['DOCUMENT_ROOT'])  . '/classes/reviewtable.php';

$data = [];

$sort = $_POST['sort'] ?? [];
$limit = $_POST['limit'] ?? -1;
$offset = $_POST['offset'] ?? 0;

$data['reviews'] = ReviewTable::read($sort, $limit, $offset);
$data['count'] = ReviewTable::count();

die(json_encode($data));