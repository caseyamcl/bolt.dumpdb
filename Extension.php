<?php

/**
 * Bolt Database Dumper
 *
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/caseyamcl/bolt_dumpdb
 * @version 1.0
 * @package caseyamcl/bolt_dumpdb
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * ------------------------------------------------------------------
 */

namespace Bolt\Extension\FSURCC\DumpDB;

use Bolt\Application;
use Bolt\BaseExtension;

/**
 * Bolt Extension
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
class Extension extends BaseExtension
{
    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        // Manual require (in case autoloading failed)
        if ( ! class_exists('Bolt\Extension\FSURCC\DumpDB\DumpDbNutCommand')) {
            require_once(__DIR__ . '/CmdHelper.php');
            require_once(__DIR__ . '/DumpDbNutCommand.php');
            require_once(__DIR__ . '/LoadDbNutCommand.php');
        }

        $this->addConsoleCommand(new DumpDbNutCommand($this->app['db']));
        $this->addConsoleCommand(new LoadDbNutCommand($this->app['db']));
    }

    // ---------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "dumpdb";
    }
}






