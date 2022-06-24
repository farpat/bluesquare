<?php

namespace App\Service\Asset;

class ViteAsset implements AssetInterface
{
    private string $manifestJsonPath;
    private int    $assetDevServerPort;
    /** @var array<string, mixed>|null */
    private ?array $manifestJson;
    private string $basePath;

    public function __construct(string $manifestJsonPath, int $assetDevServerPort, string $basePath)
    {
        $this->assetDevServerPort = $assetDevServerPort;
        $this->manifestJson = null;
        $this->manifestJsonPath = $manifestJsonPath;
        $this->basePath = $basePath;
    }

    /**
     * @throws AssetException
     */
    public function renderAsset(string $entry): string
    {
        if (file_exists($this->manifestJsonPath)) {
            if ($this->manifestJson === null) {
                $this->manifestJson = json_decode(file_get_contents($this->manifestJsonPath), true);
            }

            [
                'script'      => $script,
                'cssFiles'    => $cssFiles,
                'importFiles' => $importFiles
            ] = $this->getData($entry);

            $html = $this->renderProductionImports($importFiles);
            $html .= $this->renderProductionScript($script);
            $html .= $this->renderProductionStyles($cssFiles);

            return $html;
        }

        return $this->renderDevScript($entry);
    }

    /**
     * @return array{script: string, cssFiles: string[], importFiles: string[]}
     * @throws AssetException
     */
    private function getData(string $asset): array
    {
        $key = 'js/' . $asset;

        $data = $this->manifestJson[$key] ?? null;
        if ($data === null) {
            throw new AssetException("L'entrée << $key >> n'existe pas !");
        }

        $imports = [];
        foreach ($data['imports'] ?? [] as $importKey) {
            $imports[] = $this->manifestJson[$importKey]['file'];
        }

        return [
            'script'      => $data['file'],
            'cssFiles'    => $data['css'] ?? [],
            'importFiles' => $imports,
        ];
    }

    /**
     * @param string[] $files
     * @return string
     */
    private function renderProductionImports(array $files): string
    {
        $html = '';
        foreach ($files as $file) {
            $html .= "<link rel=\"modulepreload\" href=\"{$this->basePath}/{$file}\"/>";
        }
        return $html;
    }

    private function renderProductionScript(string $file): string
    {
        return "<script src=\"{$this->basePath}/{$file}\" type=\"module\" defer></script>";
    }

    /**
     * @param string[] $files
     * @return string
     */
    private function renderProductionStyles(array $files): string
    {
        $html = '';
        foreach ($files as $file) {
            $html .= "<link rel=\"stylesheet\" href=\"{$this->basePath}/{$file}\" media=\"screen\"/>";
        }
        return $html;
    }

    private function renderDevScript(string $file): string
    {
        $base = "http://localhost:{$this->assetDevServerPort}{$this->basePath}";

        return <<<HTML
<script type="module" src="{$base}/@vite/client"></script>

<script type="module">
import RefreshRuntime from "{$base}/@react-refresh"
RefreshRuntime.injectIntoGlobalHook(window)
window.\$RefreshReg\$ = () => {}
window.\$RefreshSig\$ = () => (type) => type
window.__vite_plugin_react_preamble_installed__ = true
</script>

<script src="{$base}/js/{$file}" type="module" defer></script>
HTML;
    }
}
