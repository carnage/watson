<?php

namespace Carnage\Watson\Logger;

interface LoggerInterface extends \Doctrine\DBAL\Logging\SQLLogger
{
    public function nextQuery();

    public function logQuerySource($file, $line);

    public function logHydration($inputRows, $outputRows);
}