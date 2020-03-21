<?php
    if (! function_exists('agentbouncer')) {
        function agentbouncer()
        {
            return app()->make(\Webkul\Agent\AgentBouncer::class);
        }
    }
?>