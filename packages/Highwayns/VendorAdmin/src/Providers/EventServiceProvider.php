<?php

namespace Highwayns\VendorAdmin\Providers;

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
        Event::listen('checkout.order.save.after', 'Highwayns\VendorAdmin\Listeners\Order@sendNewOrderMail');

        Event::listen('sales.invoice.save.after', 'Highwayns\VendorAdmin\Listeners\Order@sendNewInvoiceMail');

        Event::listen('sales.shipment.save.after', 'Highwayns\VendorAdmin\Listeners\Order@sendNewShipmentMail');

        Event::listen('sales.order.cancel.after','Highwayns\VendorAdmin\Listeners\Order@sendCancelOrderMail');

        Event::listen('sales.refund.save.after','Highwayns\VendorAdmin\Listeners\Order@sendNewRefundMail');
    }
}