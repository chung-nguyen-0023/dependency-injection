<?php

declare(strict_types = 1);

namespace App;

use App\Container;
use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\SalesTaxService;
use App\Services\PaymentGatewayService;

class App
{
    public static Container $container;

    public function __construct()
    {
        static::$container = new Container();

        static::$container->set(InvoiceService::class, function(Container $c) {
            return new InvoiceService(
                $c->get(SalesTaxService::class),
                $c->get(PaymentGatewayService::class),
                $c->get(EmailService::class)
            );
        });

        static::$container->set(SalesTaxService::class, fn() => new SalesTaxService());
        static::$container->set(PaymentGatewayService::class, fn() => new PaymentGatewayService());
        static::$container->set(EmailService::class, fn() => new EmailService());
    }
}
