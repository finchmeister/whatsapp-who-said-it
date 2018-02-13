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
            $this->filename = $helper->ask($input, $output, $question);
            $output->writeln('You have just selected: '.$this->filename);
        } else {
            $this->filename = $options[0];
        }

        $this->chat = file_get_contents($this->getWhatsAppExportDirectory().'/'.$this->filename);
        $parsedExport = $this->parseWhatsAppExport();
        //$users = array_unique(array_column($parsedExport, 'user'));

        // TODO, create chat alias if does not exist
        $this->userAlias = $this->getChatAlias();

        $noOfMessages = count($parsedExport);
        $io->text(sprintf("%s messages", $noOfMessages));


        $random = mt_rand(0, $noOfMessages-1);
        $message = $parsedExport[$random];
        $io->text($message['message']);

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Who said it?:',
            array_keys($this->userAlias[$this->filename]),
            0
        );

        $guess = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: '.$guess);

        $trueUser = $this->getTrueUser($message['user']);
        if ($guess === $trueUser) {
            $io->success("Correct!");
        } else {
            $io->error("You suck, it was ".$trueUser);
        }

    }

    protected function getTrueUser($user)
    {
        foreach ($this->userAlias[$this->filename] as $trueUser => $aliases) {
            if ($user === $trueUser) {
                return $user;
            }
            if (in_array(trim($user), array_map('trim', $aliases))) {
                return $trueUser;
            }
        }
        throw new \RuntimeException("No user found '$user'");
    }

    protected function putChatAlias(array $chatAlias = null)
    {
        file_put_contents($this->getWhatsAppAliasFilename(), json_encode(
            $chatAlias
        ));
    }

    protected function getChatAlias()
    {
        return json_decode(file_get_contents($this->getWhatsAppAliasFilename()), true);
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

    /**
     * @return array
     */
    protected function parseWhatsAppExport(): array
    {
        $append = date('d/m/Y, H:i'); // A bit hacky but makes the positive look ahead work for the final message
        preg_match_all(
            '/(\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2}) - (.+?): (\X+?(?=\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2}))/',
            $this->chat.$append,
            $matches
        );
        if (count($matches[1]) !== count($matches[2]) || count($matches[2]) !== count($matches[3])) {
            throw new \RuntimeException(
                sprintf(
                    "There was an error parsing the WhatsApp text file:
Timestamps: %s;
User strings: %s;
Messages: %s",
                    count($matches[1]),
                    count($matches[2]),
                    count($matches[1]))
            );
        }
        return $this->transformParsedExport($matches);
    }

    /**
     * Transform the preg_match_all return
     * @param $matches
     * @return array
     */
    protected function transformParsedExport(array $matches)
    {
        $parsedExport = [];
        foreach ($matches[1] as $i => $timestamp) {
            $parsedExport[$i] = [
                'timestamp' => $timestamp,
                'user' => $matches[2][$i],
                'message' => $matches[3][$i],
            ];
        }
        return $parsedExport;
    }

    protected function getChatParticipants($allParticipants)
    {
        return array_unique($allParticipants);
    }

    protected function getWhatsAppExportDirectory()
    {
        return __DIR__.'/../../var/whatsapp-export';
    }
    protected function getWhatsAppAliasFilename()
    {
        return __DIR__.'/../../var/alias/aliases.json';
    }
}