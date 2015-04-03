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
     * @param string $command     The command to test
     * @param string $cmdAlias    Used in the error message to refer to the command
     * @throws \RuntimeException  If command doesn't exist
     */
    protected function chkCommand($command, $cmdAlias = '')
    {
        if (!`$command`) {
            throw new \RuntimeException(sprintf(
                "Could not find '%s' command in the PATH.  Is it installed?",
                $cmdAlias ?: $command
            ));
        }
    }
}
