<?php

namespace App\Domain\Chat;

class ReadWhatsAppExport
{

    /**
     * @var ChatDataProviderInterface
     */
    private $chatDataProvider;

    public function __construct(
        ChatDataProviderInterface $chatDataProvider
    ) {
        $this->chatDataProvider = $chatDataProvider;
    }

    public function loadChat(string $chatIdentifier)
    {

    }

    public function getChatFile(string $fileName)
    {
        $chatFile = $this->chatDataProvider->read($fileName);
        return $this->parseWhatsAppExport($chatFile);
    }

    protected function parseWhatsAppExport(string $chatFile): array
    {
        $append = date('d/m/Y, H:i'); // A bit hacky but makes the positive look ahead work for the final message
        preg_match_all(
            '/(\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2}) - (.+?): (\X+?(?=\d{2}\/\d{2}\/\d{4}, \d{2}:\d{2}))/u',
            $chatFile.$append,
            $matches
        );
        if (\count($matches[1]) !== \count($matches[2])
            || \count($matches[2]) !== \count($matches[3])) {
            throw new \RuntimeException(
                sprintf(
                    'There was an error parsing the WhatsApp text file:
Timestamps: %s;
User strings: %s;
Messages: %s',
                    \count($matches[1]),
                    \count($matches[2]),
                    \count($matches[3])
                )
            );
        }
        return $matches;
    }

}