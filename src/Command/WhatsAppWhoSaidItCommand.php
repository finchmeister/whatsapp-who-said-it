<?php


namespace WhatsAppWhoSaidIt\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class WhatsAppWhoSaidItCommand extends Command
{

    protected function configure()
    {
        $this->setName('app:who-said-it');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("WhatsApp Who Said It");

        $finder = new Finder();
        $finder->files()->in($this->getWhatsAppExportDirectory())->name('*.txt');

        // Error when no files
        $options = [];
        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $options[] = $file->getFileName();
        }
        if ($options === []) {
            $io->error("No text file export found in /var/whatsapp-export");
            return;
        }

        if (count($options) > 1) {
            $helper = $this->getHelper('question');
            $question = new ChoiceQuestion(
                'Select a chat:',
                $options,
                0
            );
            $question->setErrorMessage('Option %s is invalid.');
            $filename = $helper->ask($input, $output, $question);
            $output->writeln('You have just selected: '.$filename);
        } else {
            $filename = $options[0];
        }

        $this->chat = file_get_contents($this->getWhatsAppExportDirectory().'/'.$filename);
        $matches = $this->parseWhatsAppExport();
        $io->text(sprintf("%s messages", count($matches[1])));
        $io->text($this->getMessageString(count($matches[1])-1, $matches));
        print_r($this->getChatParticipants($matches[2]));
    }

    protected function getMessageString($key, $matches)
    {
        return sprintf(
            "%s - %s: %s \n",
            $matches[1][$key],
            $matches[2][$key],
            $matches[3][$key]
        );
    }

    protected function parseWhatsAppExport()
    {
        $append = date('d/m/Y, H:i'); // A bit hacky but makes the positive look ahead work for the final message
        preg_match_all(
            '/(\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2}) - (.+?): (\X+?(?=\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2}))/',
            $this->chat.$append,
            $matches
        );
        return $matches;
    }

    protected function getChatParticipants($matches)
    {
        return array_unique($matches);
    }


    protected function getWhatsAppExportDirectory()
    {
        return __DIR__.'/../../var/whatsapp-export';
    }
}