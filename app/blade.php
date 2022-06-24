<?php

use Illuminate\Support\HtmlString;

function render_asset(string $entry): HtmlString
{
    $asset = app(\App\Service\Asset\AssetInterface::class);
    $string = $asset->renderAsset($entry);
    return new HtmlString($string);
}

function get_active_class(string $routeName, string $activeClass = 'active'): string
{
    return request()->route()->getName() === $routeName ? $activeClass : '';
}
