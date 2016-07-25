<?php

namespace League\Route\Namespaces;

trait NamespacesAwareTrait
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * Set the namespace.
     * 
     * @param string $namespace
     * 
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get the namespace.
     * 
     * @return string
     */
    public function getNamespace()
    {
        return (string) $this->namespace;
    }
}