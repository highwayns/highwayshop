<?php

namespace Highwayns\AgentAdmin\Providers;

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
        Event::listen('checkout.order.save.after', 'Highwayns\AgentAdmin\Listeners\Order@sendNewOrderMail');

        Event::listen('sales.invoice.save.after', 'Highwayns\AgentAdmin\Listeners\Order@sendNewInvoiceMail');

        Event::listen('sales.shipment.save.after', 'Highwayns\AgentAdmin\Listeners\Order@sendNewShipmentMail');

        Event::listen('sales.order.cancel.after','Highwayns\AgentAdmin\Listeners\Order@sendCancelOrderMail');

        Event::listen('sales.refund.save.after','Highwayns\AgentAdmin\Listeners\Order@sendNewRefundMail');
    }
}