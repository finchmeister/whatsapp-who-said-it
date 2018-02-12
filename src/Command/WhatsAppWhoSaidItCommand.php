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
        $matches = $this->getChatParticipants();
        print_r(array_unique($matches));
    }




    protected function getChatParticipants()
    {
        preg_match_all('/\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2} - (.+?):/', $this->chat, $matches);
        return $matches[1];
    }


    protected function getWhatsAppExportDirectory()
    {
        return __DIR__.'/../../var/whatsapp-export';
    }
}