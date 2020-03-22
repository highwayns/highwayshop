<?php

namespace Webkul\Product\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\Product\Repositories\ProductRepository;
use Illuminate\Support\Str;

/**
 * Product Grouped Product Repository
 *
 * @author Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class ProductGroupedProductRepository extends Repository
{
    public function model()
    {
        return 'Webkul\Product\Contracts\ProductGroupedProduct';
    }

    /**
     * @param array   $data
     * @param Product $product
     * @return void
     */
    public function saveGroupedProducts($data, $product)
    {
        $previousGroupedProductIds = $product->grouped_products()->pluck('id');

        if (isset($data['links'])) {
            foreach ($data['links'] as $linkId => $linkInputs) {
                if (Str::contains($linkId, 'link_')) {
                    $this->create(array_merge([
                            'product_id' => $product->id,
                        ], $linkInputs));
                } else {
                    if (is_numeric($index = $previousGroupedProductIds->search($linkId)))
                        $previousGroupedProductIds->forget($index);

                    $this->update($linkInputs, $linkId);
                }
            }
        }

        foreach ($previousGroupedProductIds as $previousGroupedProductId) {
            $this->delete($previousGroupedProductId);
        }
    }
}