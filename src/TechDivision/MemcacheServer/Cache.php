<?php

/**
 * TechDivision\MemcacheServer\Cache
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  Appserver
 * @package   TechDivision_MemcacheServer
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MemcacheServer
 * @link      http://www.appserver.io
 * @link      https://github.com/memcached/memcached/blob/master/doc/protocol.txt
 */

namespace TechDivision\MemcacheServer;

use TechDivision\MemcacheProtocol\CacheRequest;

/**
 * Interface for all cache server implementations. 
 *
 * @category  Appserver
 * @package   TechDivision_MemcacheServer
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MemcacheServer
 * @link      http://www.appserver.io
 * @link      https://github.com/memcached/memcached/blob/master/doc/protocol.txt
 */
interface Cache
{

    /**
     * Handle the the passed request instance.
     *
     * @param \TechDivision\MemacheProtocol\CacheRequest $cacheRequest The request instance with the data to handle
     *
     * @return void
     */
    public function request(CacheRequest $cacheRequest);

    /**
     * Returns following state of the connection, one of resume, 
     * reset or close.
     *
     * @return string The state itself
     */
    public function getState();

    /**
     * Reset all attributes for reusing the object.
     *
     * @return void
     */
    public function reset();

    /**
     * Returns the response that will be sent back to the client.
     *
     * @return string The response that will be sent back
     */
    public function getResponse();
    
    /**
     * Collections the garbage by removing the cache entries from
     * the storage that has been expired.
     * 
     * @return void
     */
    public function gc();
}
