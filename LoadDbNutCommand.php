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

use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Load Database Command
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
class LoadDbNutCommand extends Command
{
    use CmdHelper;

    // ---------------------------------------------------------------

    /**
     * @var Connection
     */
    private $db;

    // ---------------------------------------------------------------

    /**
     * Constructor
     *
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        parent::__construct();
        $this->db = $db;
    }

    // ---------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('database:load');
        $this->setDescription('Load database from STDIN or from a file');
        $this->addArgument('file', InputArgument::OPTIONAL, 'File containing SQL; else read from STDIN');
    }

    // ---------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ( ! $this->db->isConnected()) {
            throw new \RuntimeException("Not connected to database.  Cannot load");
        }

        $output->writeln(sprintf("Reading input from %s", $input->getArgument('file') ?: "STDIN"));
        $sqlInput = file_get_contents($input->getArgument('file') ?: "php://stdin");

        $output->writeln(sprintf("Running SQL in schema: <info>%s</info>", $this->db->getDatabase()));
        $this->db->query($sqlInput);

        $output->writeln("<info>Success</info>.  Loaded data");
    }
}
