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
use Symfony\Component\Process\Process;

/**
 * Dump Database Command
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
class DumpDbNutCommand extends Command
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

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('database:dump');
        $this->setDescription('Dump database to STDOUT using CLI `mysqldump` command');
        $this->addArgument('file', InputArgument::OPTIONAL, 'File to dump database to; else it writes to STDOUT');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($this->db->getDriver()->getName()) {
            case 'pdo_mysql':
            case 'mysqli':
            case 'drizzle_pdo_mysql':
                $this->chkCommand('mysqldump');
                $command = sprintf(
                    'MYSQL_PWD=%s mysqldump -n -h %s -P %s -u %s %s',
                    $this->db->getPassword(),
                    $this->db->getHost(),
                    $this->db->getPort(),
                    $this->db->getUsername(),
                    $this->db->getDatabase()
                );
                break;
            case 'pdo_sqlite':
                $this->chkCommand('sqlite3 --version', 'sqlite3');
                $command = sprintf(
                    "sqlite3 %s .dump",
                    $this->db->getParams()['path']
                );
                break;
            case 'pdo_pgsql':
                $this->chkCommand('pg_dump');
                $command = sprintf(
                    "pg_dump -U %s -P %s -p %s %s",
                    $this->db->getUsername(),
                    $this->db->getPassword(),
                    $this->db->getPort(),
                    $this->db->getDatabase()
                );
                break;
            default:
                throw new \RuntimeException("Database platform not supported (%s).  Use MySQL, SQLite, or Postgres");
        }

        if ($input->getArgument('file')) {
            $command .= ' > ' . $input->getArgument('file');
            $output->writeln("Writing database to: <info>" . $input->getArgument('file') . "</info>");
        }

        // Run the output
        $proc = new Process($command);
        $proc->run(function($type, $buffer) use ($output) {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                $output->write($buffer);
            }
        });
    }
}
