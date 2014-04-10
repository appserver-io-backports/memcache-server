<?php

/**
 * TechDivision\MemcacheServer\GarbageCollector
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  Library
 * @package   TechDivision_MemcacheServer
 * @author    Philipp Dittert <pd@techdivision.com>
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MemcacheServer
 * @link      http://www.appserver.io
 * @link      https://github.com/memcached/memcached/blob/master/doc/protocol.txt
 */

namespace TechDivision\MemcacheServer;

/**
 * This thread is responsible for handling the garbage collection.
 *
 * @category  Library
 * @package   TechDivision_MemcacheServer
 * @author    Philipp Dittert <pd@techdivision.com>
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MemcacheServer
 * @link      http://www.appserver.io
 * @link      https://github.com/memcached/memcached/blob/master/doc/protocol.txt
 */
class GarbageCollector extends \Thread
{

    /**
     * Holds the cache API.
     *
     * @var \TechDivision\MemcacheServer\Cache
     */
    protected $cache;

    /**
     * Constructs the garbage collector instance.
     *
     * @param \TechDivision\MemcacheServer\Cache $cache The cache API
     * 
     * @return void
     */
    public function __construct(Cache $cache)
    {
        
        // set the cache API
        $this->cache = $cache;
        
        // start server thread
        $this->start();
    }

    /**
     * Returns the context instance.
     *
     * @return \TechDivision\MemcacheServer\Cache The cache API
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * This method is called when the thread is started.
     *
     * @return void
     */
    public function run()
    {
        while (true) {
            $this->getCache()->gc();
        }
    }
}
