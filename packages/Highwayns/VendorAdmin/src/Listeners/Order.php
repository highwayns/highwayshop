<?php

namespace Highwayns\VendorAdmin\Listeners;

use Illuminate\Support\Facades\Mail;
use Highwayns\VendorAdmin\Mail\NewOrderNotification;
use Highwayns\VendorAdmin\Mail\NewAdminNotification;
use Highwayns\VendorAdmin\Mail\NewInvoiceNotification;
use Highwayns\VendorAdmin\Mail\NewShipmentNotification;
use Highwayns\VendorAdmin\Mail\NewInventorySourceNotification;
use Highwayns\VendorAdmin\Mail\CancelOrderNotification;
use Highwayns\VendorAdmin\Mail\NewRefundNotification;
/**
 * Order event handler
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class Order {

    /**
     * @param mixed $order
     *
     * Send new order Mail to the customer and admin
     */
    public function sendNewOrderMail($order)
    {
        try {
            Mail::queue(new NewOrderNotification($order));

            Mail::queue(new NewAdminNotification($order));
        } catch (\Exception $e) {

        }
    }

    /**
     * @param mixed $invoice
     *
     * Send new invoice mail to the customer
     */
    public function sendNewInvoiceMail($invoice)
    {
        try {
            if ($invoice->email_sent)
                return;

            Mail::queue(new NewInvoiceNotification($invoice));
        } catch (\Exception $e) {

        }
    }

    /**
     * @param mixed $refund
     *
     * Send new refund mail to the customer
     */
    public function sendNewRefundMail($refund)
    {
        try {
            Mail::queue(new NewRefundNotification($refund));
        } catch (\Exception $e) {

        }
    }

    /**
     * @param mixed $shipment
     *
     * Send new shipment mail to the customer
     */
    public function sendNewShipmentMail($shipment)
    {
        try {
            if ($shipment->email_sent)
                return;

            Mail::queue(new NewShipmentNotification($shipment));

            Mail::queue(new NewInventorySourceNotification($shipment));
        } catch (\Exception $e) {

        }
    }

     /*
     * @param mixed $order
     * */
    public function sendCancelOrderMail($order){
        try{
            Mail::queue(new CancelOrderNotification($order));
        }catch (\Exception $e){
            \Log::error('Error occured when sending email '.$e->getMessage());
        }
    }
}