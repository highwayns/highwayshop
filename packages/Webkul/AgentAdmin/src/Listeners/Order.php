<?php

namespace Webkul\AgentAdmin\Listeners;

use Illuminate\Support\Facades\Mail;
use Webkul\AgentAdmin\Mail\NewOrderNotification;
use Webkul\AgentAdmin\Mail\NewAdminNotification;
use Webkul\AgentAdmin\Mail\NewInvoiceNotification;
use Webkul\AgentAdmin\Mail\NewShipmentNotification;
use Webkul\AgentAdmin\Mail\NewInventorySourceNotification;
use Webkul\AgentAdmin\Mail\CancelOrderNotification;
use Webkul\AgentAdmin\Mail\NewRefundNotification;
/**
 * Order event handler
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
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