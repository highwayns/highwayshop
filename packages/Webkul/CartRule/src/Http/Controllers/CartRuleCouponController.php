<?php

namespace Webkul\CartRule\Http\Controllers;

use Illuminate\Http\Request;
use Webkul\CartRule\Repositories\CartRuleCouponRepository;

/**
 * Cart Rule Coupon controller
 *
 * @author Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class CartRuleCouponController extends Controller
{
    /**
     * To hold CartRuleCouponRepository repository instance
     * 
     * @var CartRuleCouponRepository
     */
    protected $cartRuleCouponRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\CartRule\Repositories\CartRuleCouponRepository $cartRuleCouponRepository
     * @return void
     */
    public function __construct(CartRuleCouponRepository $cartRuleCouponRepository)
    {
        $this->cartRuleCouponRepository = $cartRuleCouponRepository;
    }

    /**
     * Mass Delete the coupons
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function massDelete()
    {
        $couponIds = explode(',', request()->input('indexes'));

        foreach ($couponIds as $couponId) {
            $coupon = $this->cartRuleCouponRepository->find($couponId);

            if ($coupon)
                $this->cartRuleCouponRepository->delete($couponId);
        }

        session()->flash('success', trans('admin::app.promotions.cart-rules.mass-delete-success'));

        return redirect()->back();
    }
}