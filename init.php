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

$app['extensions']->register(new Extension($app));
