<?php

namespace Laravel\Telescope\Composer;

class UninstallHandler
{
    public static function handle()
    {
        $providerPath = app_path('Providers/TelescopeServiceProvider.php');
        $configPath   = config_path('telescope.php');
        $bootstrapProviders = base_path('bootstrap/providers.php');

        if (file_exists($providerPath)) {
            unlink($providerPath);
        }

        if (file_exists($configPath)) {
            unlink($configPath);
        }

        if (file_exists($bootstrapProviders)) {
            $content = file_get_contents($bootstrapProviders);

            $pattern = "/\s*App\\\\Providers\\\\TelescopeServiceProvider::class,?\s*/";

            $newContent = preg_replace($pattern, '', $content);

            if ($newContent !== $content) {
                file_put_contents($bootstrapProviders, $newContent);
            }
        }
    }
}
