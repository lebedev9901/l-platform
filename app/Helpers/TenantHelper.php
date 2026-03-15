<?php

if (!function_exists('tenant_url')) {
    function tenant_url(string $path = '', bool $useSubdomain = false): string
    {
        $company = app('company');
        if (!$company) {
            throw new \Exception('Компания не определена для tenant_url()');
        }

        if ($useSubdomain) {
            $base = rtrim("http://{$company->subdomain}.l-platform.test", '/');
        } else {
            // dev вариант
            $base = rtrim("http://l-platform.test", '/')."?company={$company->subdomain}";
        }

        $path = ltrim($path, '/');

        return $path ? $base.'/'.$path : $base;
    }
}