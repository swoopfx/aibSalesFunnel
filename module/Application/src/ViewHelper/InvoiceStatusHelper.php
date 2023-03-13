<?php

namespace Application\ViewHelper;

use Application\Service\TransactionService;
use Laminas\Form\View\Helper\AbstractHelper;

class InvoiceStatusHelper extends AbstractHelper{


    public function __invoke($data)
    {
        if($data == TransactionService::INVOICE_STATUS_SETTLED){
            return "<span class='badge badge-light-success me-2'>Settled</span>";
        }elseif($data == TransactionService::INVOICE_STATUS_CANCELLED){
            return "<span class='badge badge-light-danger me-2'>Cancelled</span>";
        }elseif($data == TransactionService::INVOICE_STATUS_INITIATED){
            return "<span class='badge badge-warning me-2'>INITIATED</span>";
        }
    }

}