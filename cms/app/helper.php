<?php

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Str;

if (!function_exists('stub_route')) {
    UrlGenerator::macro('stub_route', function ($name, $absolute = true) {
        /** @var UrlGenerator $this */
        if (!is_null($route = $this->routes->getByName($name))) {
            $uri = $route->uri;
            $parameters = [];
            $parts = explode('/', $uri);
            foreach ($parts as $part) {
                if (Str::startsWith($part, '{')) {
                    $token = Str::substr($part, 1, -1);
                    $tokenName = Str::replaceLast('?', '', $token);
                    $parameters[$tokenName] = "@{$token}@";
                }
            }

            return $this->toRoute($route, $parameters, $absolute);
        }

        throw new InvalidArgumentException("Route [{$name}] not defined.");
    });

    /**
     * Function to build routes with the parameters still templated http://example.com/foo/{bar}/
     * Use together with the javascript build_routes function in utils.js.
     *
     * @param string $name
     * @param bool   $absolute
     *
     * @return string
     */
    function stub_route($name, $absolute = true)
    {
        return app('url')->stub_route($name, $absolute);
    }
}
