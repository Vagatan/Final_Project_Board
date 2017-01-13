<?php

namespace BoardBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;


class sendEmailCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('app:sendemail')
                ->setDescription('Wyślij email')
                ->setHelp('Komenda pozwalająca na wysyłanie wiadomości email')
                ->addArgument('emailto', InputArgument::REQUIRED, "Podaj adres odbiorcy")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {        
        $emailto = $input->getArgument('emailto');

        if ($emailto) {

            $message = \Swift_Message::newInstance()
                    ->setSubject("Nowy komentarz")
                    ->setFrom("admin@admin.com")
                    ->setTo($emailto)
                    ->setBody("Dodano nowy komentarz pod Twoim ogłoszeniem")
            ;
            $this->getContainer()->get('mailer')->send($message);

            $text = "Wiadomość wysłana!";
        } else {
            $text = "Wiadomość nie wysłana";
        }


        $output->writeln($text);
    }

}
