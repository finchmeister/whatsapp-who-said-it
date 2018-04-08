<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application('WhatsApp Who Said It', '1.0.0');
$command = new \WhatsAppWhoSaidIt\Command\WhatsAppWhoSaidItCommand();

$application->add($command);

$application->setDefaultCommand($command->getName(), true);
$application->run();