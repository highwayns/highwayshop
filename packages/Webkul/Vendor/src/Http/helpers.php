<?php
    if (! function_exists('vendorbouncer')) {
        function vendorbouncer()
        {
            return app()->make(\Webkul\Vendor\VendorBouncer::class);
        }
    }
?>