<?php

declare (strict_types = 1);

namespace App\Services;

use App\Services\EmailService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;

class InvoiceService
{
    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayService $gatewayService,
        protected EmailService $emailService
    ) {
    }

    public function process(array $customer, float $amount): bool
    {
        // 1. Tính tiền thuế
        $tax = $this->salesTaxService->calculate($amount, $customer);

        // 2. Xử lý hoá đơn
        if (!$this->gatewayService->charge($customer, $amount, $tax)) {
            return false;
        }

        // 3. Gửi email
        $this->emailService->send($customer, 'receipt');

        echo 'Hóa đơn đã được xử lý<br />';

        return true;
    }
}
