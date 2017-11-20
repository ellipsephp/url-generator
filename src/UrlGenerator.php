<?php declare(strict_types=1);

namespace Ellipse\Router;

class UrlGenerator
{
    /**
     * The router adapter.
     *
     * @var \Ellipse\Router\RouterAdapterInterface
     */
    private $adapter;

    /**
     * Set up an url generator with the given router adapter.
     *
     * @param \Ellipse\Router\RouterAdapterInterface $adapter
     */
    public function __construct(RouterAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Proxy the router adapter ->generate() method. Add optional query string
     * and fragent to the generated url.
     *
     * @param string    $name
     * @param array     $data
     * @param array     $query
     * @param string    $fragment
     * @return string
     */
    public function __invoke(string $name, array $data = [], array $query = [], string $fragment = ''): string
    {
        $url = $this->adapter->generate($name, $data);

        $query_string = http_build_query($query);

        if ($query_string != '') $url.= '?' . $query_string;

        if ($fragment != '') $url.= '#' . $fragment;

        return $url;
    }
}
