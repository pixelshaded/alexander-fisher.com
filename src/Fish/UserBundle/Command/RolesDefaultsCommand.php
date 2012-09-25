<?php

namespace Fish\UserBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Fish\UserBundle\Entity\Role;

class RolesDefaultsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:roles:defaults')
            ->setDescription('Insert ROLE_ADMIN and ROLE_USER into to database.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        
        $sql = 'INSERT IGNORE INTO roles (name, role) VALUES ("user", "ROLE_USER"), ("admin", "ROLE_ADMIN")';
        
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        
        $output->writeln('ROLE_ADMIN and ROLE_USER added to database.');
    }
}