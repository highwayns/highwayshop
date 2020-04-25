<?php

namespace Highwayns\JaPayment\Http\Controllers;

use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Repositories\OrderRepository;
use Highwayns\JaPayment\Helpers\Ipn;

class SoftbankPaymentController extends Controller
{
    /**
     * OrderRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;
    
    /**
     * Ipn object
     *
     * @var Highwayns\JaPayment\Helpers\Ipn
     */
    protected $ipnHelper;


    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Attribute\Repositories\OrderRepository  $orderRepository
     * @param  Highwayns\JaPayment\Helpers\Ipn  $ipnHelper
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        Ipn $ipnHelper
    )
    {
        $this->orderRepository = $orderRepository;

        $this->ipnHelper = $ipnHelper;

    }

    /**
     * Redirects to the SoftbankPayment.
     *
     * @return \Illuminate\View\View
     */
    public function redirect()
    {
        return view('JaPayment::softbankPayment-redirect');
    }

    /**
     * Cancel Japayment from SoftbankPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session()->flash('error', 'SoftbankPayment has been canceled.');

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Success payment
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        Cart::deActivateCart();

        session()->flash('order', $order);

        return redirect()->route('shop.checkout.success');
    }
        /**
     * SoftbankPayment Ipn listener
     *
     * @return \Illuminate\Http\Response
     */
    public function ipn()
    {
        $this->ipnHelper->processIpn(request()->all());
    }

}