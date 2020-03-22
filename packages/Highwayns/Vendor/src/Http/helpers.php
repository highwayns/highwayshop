<?php
    if (! function_exists('vendorbouncer')) {
        function vendorbouncer()
        {
            return app()->make(\Highwayns\Vendor\VendorBouncer::class);
        }
    }
?>