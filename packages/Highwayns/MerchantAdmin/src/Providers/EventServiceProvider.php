<?php

namespace Highwayns\MerchantAdmin\Providers;

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
        Event::listen('checkout.order.save.after', 'Highwayns\MerchantAdmin\Listeners\Order@sendNewOrderMail');

        Event::listen('sales.invoice.save.after', 'Highwayns\MerchantAdmin\Listeners\Order@sendNewInvoiceMail');

        Event::listen('sales.shipment.save.after', 'Highwayns\MerchantAdmin\Listeners\Order@sendNewShipmentMail');

        Event::listen('sales.order.cancel.after','Highwayns\MerchantAdmin\Listeners\Order@sendCancelOrderMail');

        Event::listen('sales.refund.save.after','Highwayns\MerchantAdmin\Listeners\Order@sendNewRefundMail');
    }
}