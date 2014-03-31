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

namespace TechDivision\LemCacheContainer\Workers;

use TechDivision\WebServer\Interfaces\ServerContextInterface;

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
     * Holds the server context instance.
     *
     * @var \TechDivision\WebServer\Interfaces\ServerContextInterface The server context instance
     */
    protected $serverContext;

    /**
     * Constructs the garbage collector instance.
     *
     * @param \TechDivision\WebServer\Interfaces\ServerContextInterface $serverContext The server context instance
     * 
     * @return void
     */
    public function __construct(ServerContextInterface $serverContext)
    {
        
        // set the server context
        $this->serverContext = $serverContext;
        
        // start server thread
        $this->start();
    }

    /**
     * Returns the context instance.
     *
     * @return \TechDivision\WebServer\Interfaces\ServerContextInterface
     */
    public function getServerContext()
    {
        return $this->serverContext;
    }

    /**
     * This method is called when the thread is started.
     *
     * @return void
     */
    public function run()
    {
        while (true) {
            $this->getServerContext()->getCache()->gc();
        }
    }
}
