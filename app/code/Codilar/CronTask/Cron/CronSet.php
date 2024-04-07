<?php
namespace Codilar\CronTask\Cron;

use Psr\Log\LoggerInterface;

class CronSet {
    protected $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    /**
     * Write to system.log
     *
     * @return void
     */
    public function execute() {
        $this->logger->info('Cron Works');
    }
}
