<?php

namespace UtilisateurBundle\DataFixtures\ORM; 

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UtilisateurBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer
        $listNames = array('Catherine', 'Gabrielle', 'Morgane');
        
        foreach($listNames as $name){
            // On crée l'utilisateur
            $user = new User;
            
            $user->setUsername($name);
            $user->setPassword($name);
            
            $manager->persist($user); 
        }
        
        $manager->persist($user); 
    }
}
