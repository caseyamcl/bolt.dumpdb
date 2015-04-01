<?php

namespace Bolt\Extension\FSURCC\DumpDB;

use Bolt\Application;
use Bolt\BaseExtension;

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






