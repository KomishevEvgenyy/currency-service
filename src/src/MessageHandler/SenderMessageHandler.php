<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Entity\Member;
use App\Infrastructure\Doctrine\Repository\MemberRepository;
use App\Message\AbstractMessage;
use App\Trait\LoggerTrait;
use Psr\Log\LoggerAwareInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class SenderMessageHandler implements LoggerAwareInterface
{
    use LoggerTrait;

    public function __construct(
        private readonly MemberRepository $memberRepository,
        private readonly MailerInterface  $mailer
    )
    {
    }

    public function __invoke(AbstractMessage $message): void
    {
        $members = $this->memberRepository->getActiveSubscriptions();
        $messages = $message->getMessages();

        /** @var Member $member */
        foreach ($members as $member) {
            $text = implode(';' . PHP_EOL, $messages);
            $email = (new Email())
                ->from('test@gmail.com')
                ->to($member->getEmail())
                ->subject('Change currency')
                ->text($text);

            $this->mailer->send($email);

            $this->info('Send message to {email} with text: {text}',
                [
                    'email' => $member->getEmail(),
                    'text' => $text
                ]);
        }

    }
}