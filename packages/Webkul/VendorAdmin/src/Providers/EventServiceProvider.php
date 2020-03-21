<?php

namespace Webkul\VendorAdmin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('checkout.order.save.after', 'Webkul\VendorAdmin\Listeners\Order@sendNewOrderMail');

        Event::listen('sales.invoice.save.after', 'Webkul\VendorAdmin\Listeners\Order@sendNewInvoiceMail');

        Event::listen('sales.shipment.save.after', 'Webkul\VendorAdmin\Listeners\Order@sendNewShipmentMail');

        Event::listen('sales.order.cancel.after','Webkul\VendorAdmin\Listeners\Order@sendCancelOrderMail');

        Event::listen('sales.refund.save.after','Webkul\VendorAdmin\Listeners\Order@sendNewRefundMail');
    }
}