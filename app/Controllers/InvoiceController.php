<?php

declare (strict_types = 1);

namespace App\Controllers;

use App\App;
use App\Services\InvoiceService;

class InvoiceController
{
    public function store()
    {
        App::$container->get(InvoiceService::class)->process([], 25);
    }
}
