<?php

namespace AppBundle\DataFixtures\ORM; 

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\News;

class LoadNews implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer
		$listNews = array(
		  array(
		    'title'   => 'La mort de Mufasa',
			'id'      => 1,
			'author'  => 'Alexandre',
			'content' => "En direct du roi Lion, Mufasa a chuté d'une falaise",
			'date'    => new \Datetime()),
		  array(
		    'title'   => 'Scar prend le pouvoir',
			'id'      => 2,
			'author'  => 'Hugo',
			'content' => "Après l'assassinat de Mufasa, Scar est le nouveau roi de la jungle", 
			'date'    => new \Datetime()),
		  array(
		    'title'   => 'Le triomphe de Simba',
			'id'      => 3,
			'author'  => 'Mathieu',
			'content' => 'Simba a vengé son perd en vainquant Scar avec le concours de Timon et Pumba',
			'date'    => new \Datetime())
		);
        
        foreach($listNews as $news){
            // On crée l'utilisateur
            $new = new News;
            
            $new->setAuthor($news['author']);
            $new->setTitle($news['title']);
            $new->setContent($news['content']);
            $new->setDate($news['date']);
            
            $manager->persist($new); 
        }
        
        $manager->flush($new); 
    }
}
