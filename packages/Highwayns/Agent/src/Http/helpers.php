<?php
    if (! function_exists('agentbouncer')) {
        function agentbouncer()
        {
            return app()->make(\Highwayns\Agent\AgentBouncer::class);
        }
    }
?>