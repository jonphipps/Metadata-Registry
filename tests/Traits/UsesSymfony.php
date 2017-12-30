<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-12-30,  Time: 12:22 PM */

namespace Tests\Traits;

use Dotenv\Dotenv;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

trait UsesSymfony
{

    protected function setTestEnvironment(): void
    {
        if (file_exists(base_path($this->getTestFile()))) {
            if (file_get_contents(base_path('.env')) !== file_get_contents(base_path($this->getTestFile()))) {
                $this->backupEnvironment();
            }

            $this->refreshEnvironment();
        }
    }

    protected function resetEnvironment(): void
    {
        /** @noinspection NotOptimalIfConditionsInspection */
        if (file_exists(base_path($this->getTestFile())) && file_exists(base_path('.env.backup'))) {
            $this->restoreEnvironment();
        }
    }

    /**
     * Backup the current environment file.
     *
     * @return void
     */
    protected function backupEnvironment(): void
    {
        copy(base_path('.env'), base_path('.env.backup'));

        copy(base_path($this->getTestFile()), base_path('.env'));
    }

    /**
     * Restore the backed-up environment file.
     *
     * @return void
     */
    protected function restoreEnvironment(): void
    {
        copy(base_path('.env.backup'), base_path('.env'));

        unlink(base_path('.env.backup'));
    }

    /**
     * Refresh the current environment variables.
     *
     * @return void
     */
    protected function refreshEnvironment(): void
    {
        (new Dotenv(base_path()))->overload();
    }

    /**
     * Get the name of the Test file for the environment.
     *
     * @return string
     */
    protected function getTestFile(): string
    {
        if (file_exists(base_path($file = '.env.testing.'))) {
            return $file;
        }

        return '.env.testing';
    }

    protected static function clearSymfonyCache(): void
    {
        $process = new Process('php symfony cc');
        $process->run();
    }
}
