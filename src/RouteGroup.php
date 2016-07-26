<?php

namespace League\Route;

use League\Route\Strategy\StrategyAwareInterface;
use League\Route\Strategy\StrategyAwareTrait;
use League\Route\Namespaces\NamespacesAwareInterface;
use League\Route\Namespaces\NamespacesAwareTrait;

class RouteGroup implements RouteCollectionInterface, StrategyAwareInterface, NamespacesAwareInterface
{
    use RouteCollectionMapTrait;
    use RouteConditionTrait;
    use StrategyAwareTrait;
    use NamespacesAwareTrait;

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var \League\Route\RouteCollectionInterface
     */
    protected $collection;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var StrategyInterface
     */
    protected $strategy;

    /**
     * Constructor.
     *
     * @param string                        $prefix
     * @param callable                      $callback
     * @param \League\Route\RouteCollection $collection
     */
    public function __construct($prefix, callable $callback, RouteCollectionInterface $collection)
    {
        $this->callback   = $callback;
        $this->collection = $collection;
        $this->prefix     = sprintf('/%s', ltrim($prefix, '/'));
    }

    /**
     * Process the group and ensure routes are added to the collection.
     *
     * @return void
     */
    public function __invoke()
    {
        call_user_func_array($this->callback, [$this]);
    }

    /**
     * {@inheritdoc}
     */
    public function map($method, $path, $handler)
    {
        $path  = ($path === '/') ? $this->prefix : $this->prefix . sprintf('/%s', ltrim($path, '/'));
        $route = $this->collection->map($method, $path, $handler);

        $route->setParentGroup($this);

        if ($host = $this->getHost()) {
            $route->setHost($host);
        }

        if ($scheme = $this->getScheme()) {
            $route->setScheme($scheme);
        }

        if ($namespace = $this->getNamespace()) {
            $route->setNamespace($namespace);

        if ($strategy = $this->getStrategy()) {
            $route->setStrategy($strategy);
        }

        return $route;
    }
}
