<?php

use App\App;
use App\Controllers\InvoiceController;

require_once __DIR__ . '/vendor/autoload.php';

$app = new App();
$invoiceController = new InvoiceController();
$invoiceController->store();
