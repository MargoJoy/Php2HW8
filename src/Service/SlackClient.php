<?php

namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;

class SlackClient
{
    use LoggerTrait;

    private $slack;
    /**
     * @var LoggerInterface|null
     */
    private $logger;

    public function __construct(Client $slack)
    {

        $this->slack = $slack;
    }

    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
         $this->logger = $logger;
    }

    public function sendMessage(string $from, string $message )
    {

        $this->logInfo('Hi Khan',[
            'message' => $message,
        ]);

            $message = $this->slack->createMessage()
                ->from($from)
                ->withIcon(':ghost:')
                ->setText($message);
            $this->slack->sendMessage($message);
    }
}