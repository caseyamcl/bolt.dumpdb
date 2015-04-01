<?php
/**
 * bolt.dumpdb
 *
 * @license ${LICENSE_LINK}
 * @link ${PROJECT_URL_LINK}
 * @version ${VERSION}
 * @package ${PACKAGE_NAME}
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * ------------------------------------------------------------------
 */

namespace Bolt\Extension\FSURCC\DumpDB;

/**
 * Helper library for Db Commands
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
trait CmdHelper
{
    /**
     * Check if a command is runnable
     *
     * @param string $command
     */
    protected function chkCommand($command)
    {
        if (!`$command`) {
            throw new \RuntimeException("Could not find '$command' command in the PATH.  Is it installed?");
        }
    }
}
