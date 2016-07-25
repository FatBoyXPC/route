<?php

namespace League\Route\Namespaces;

interface NamespacesAwareInterface
{
    /**
     * Set the namespace.
     * 
     * @param string $namespace
     * 
     * @return $this
     */
    public function setNamespace($namespace);

    /**
     * Get the namespace.
     * 
     * @return string
     */
    public function getNamespace();
}