<?php

namespace Highwayns\VendorAdmin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * New Refund Mail class
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class NewRefundNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The refund instance.
     *
     * @var Refund
     */
    public $refund;

    /**
     * Create a new message instance.
     *
     * @param mixed $refund
     * @return void
     */
    public function __construct($refund)
    {
        $this->refund = $refund;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->refund->order;

        return $this->to($order->customer_email, $order->customer_full_name)
                ->from(config('mail.from'))
                ->subject(trans('shop::app.mail.refund.subject', ['order_id' => $order->increment_id]))
                ->view('shop::emails.sales.new-refund');
    }
}
