<?php

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Service\Utils\DirectoryUtils as DirectoryUtils;
use Symfony\Component\Console\Output\OutputInterface;


class SendMailCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:mail:send')
            ->setDescription('check wich xml files to read and send mails accordingly')
            ->setHelp('this command allow you to read xml files and send mails to users accordingly')
            ->addArgument('directory', InputArgument::OPTIONAL,'directory where the xml files are put',null);
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xmlPath = $input->getArgument('directory');
        $xmlPath = is_null($xmlPath) ?  $this->getContainer()->get('kernel')->getRootDir().'/../'.$this->getContainer()->getParameter('xmlPath') : $xmlPath;

        $errors = array();
        try{
            /** @var DirectoryUtils $directoryUtils
             */
            $directoryUtils = $this->getContainer()->get('app.services.utils.directory');
            $directoryUtils->ProcessDirectory($xmlPath,"xml");

        }catch (Exception $exception){
            $errors[] = $exception->getMessage();
        }
        if(count($errors)){
            $message = "An error occured => ";
            foreach($errors as  $err){
                $message .= "\n\r $err";
            }
        }else{
            $message = "Mails were sent !";
        }
        $output->writeln($message);
        /*
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getManager();
        $rc = $doctrine->getRepository('AppBundle:Movie');
        $count = $rc->deleteMoviesByYear($year,!$earlier);
        $output->writeln("You have removed all movies ".($earlier ? "earlier" : "older" )." than $year wich is exactly $count movies" );
        */
    }


}
