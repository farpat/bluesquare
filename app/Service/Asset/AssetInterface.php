<?php

namespace App\Service\Asset;

interface AssetInterface
{
    /**
     * AssetInterface constructor.
     * @param string $manifestJsonPath Path to "manifest.json"
     * @param int $assetDevServerPort Asset dev server port (useful for development mode)
     * @param string $basePath asset path prefix
     */
    public function __construct(string $manifestJsonPath, int $assetDevServerPort, string $basePath);

    /**
     * Render a HTML tag from entry (<link> or <script>)
     * @param string $entry
     * @return string
     */
    public function renderAsset(string $entry): string;
}
