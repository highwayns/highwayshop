<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\API\Http\Resources\Catalog\Product as ProductResource;

/**
 * Product controller
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class ProductController extends Controller
{
    /**
     * ProductRepository object
     *
     * @var array
     */
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection($this->productRepository->getAll(request()->input('category_id')));
    }

    /**
     * Returns a individual resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return new ProductResource(
                $this->productRepository->findOrFail($id)
            );
    }

    /**
     * Returns product's additional information.
     *
     * @return \Illuminate\Http\Response
     */
    public function additionalInformation($id)
    {
        return response()->json([
                'data' => app('Webkul\Product\Helpers\View')->getAdditionalData($this->productRepository->findOrFail($id))
            ]);
    }

    /**
     * Returns product's additional information.
     *
     * @return \Illuminate\Http\Response
     */
    public function configurableConfig($id)
    {
        return response()->json([
                'data' => app('Webkul\Product\Helpers\ConfigurableOption')->getConfigurationConfig($this->productRepository->findOrFail($id))
            ]);
    }
}
