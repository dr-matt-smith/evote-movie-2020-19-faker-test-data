<?php
require_once __DIR__ . '/../config/dbConstants.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Tudublin\Movie;
use Tudublin\MovieRepository;

$movieRespository = new MovieRepository();
$faker = Faker\Factory::create();

// (1) drop then create table
$movieRespository->dropTable();
$movieRespository->createTable();

// (2) delete any existing objects
$movieRespository->deleteAll();

// (3) create objects & insert into DB
$m1 = new Movie();
$m1->setId(1);
$m1->setTitle('Jaws');
$m1->setCategory('thriller');
$m1->setPrice(10.00);
$m1->setVoteTotal(5);
$m1->setNumVotes(1);

$movieRespository->create($m1);

for($id=2; $id < 10; $id++){
    $title = $faker->sentence(2);
    $category = $faker->randomElement(['horror', 'scifi', 'family', 'comedy', 'entertainment']);
    $price = $faker->randomFloat(2, 1.00, 25.00);
    $voteTotal = $faker->numberBetween(50, 100);
    $numVotes = $faker->numberBetween(0, 25);

    $m = new Movie();
    $m->setId($id);
    $m->setTitle($title);
    $m->setCategory($category);
    $m->setPrice($price);
    $m->setNumVotes($numVotes);
    $m->setVoteTotal($voteTotal);

    $movieRespository->create($m);
}




// (4) test objects are there
$movies = $movieRespository->findAll();
print '<pre>';
var_dump($movies);
