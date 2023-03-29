<?php

namespace Admin\ViewHelper;

use Application\Service\TransactionService;
use Laminas\View\Helper\AbstractHelper;

class InvoiceStatus extends AbstractHelper
{


    public function __invoke($data)
    {
        if ($data == TransactionService::INVOICE_STATUS_SETTLED) {
            return "<span class='badge rounded-pill bg-success'>PAID</span>";
        } elseif ($data == TransactionService::INVOICE_STATUS_CANCELLED) {
            return "<span class='badge rounded-pill bg-danger'>Cancelled</span>";
        } elseif ($data == TransactionService::INVOICE_STATUS_INITIATED) {
            return "<span class='badge rounded-pill bg-warning'>INITIATED</span>";
        }else{
            return "<span class='badge rounded-pill bg-info'>INITIATED</span>";
        }
    }
}
