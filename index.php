<?php

use Sirprize\Scrubble\Bootstrap;

require_once 'vendor/sirprize/scrubble/lib/Sirprize/Scrubble/Bootstrap.php';
$services = Bootstrap::getServices(Bootstrap::run(__DIR__.'/config/config.php'));
$response = $services->get('kernel')->handle($services->get('request'))->send();