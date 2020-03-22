<?php
    if (! function_exists('merchantbouncer')) {
        function merchantbouncer()
        {
            return app()->make(\Highwayns\Merchant\MerchantBouncer::class);
        }
    }
?>