<?php
// bootstrap.php
require_once "vendor/autoload.php";


use App\Entity\Joueur;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;


$paths = [__DIR__ . '/src/Entity'];
$isDevMode = false;


// the connection configuration
$dbParams = [
    'host' => '127.0.0.1',
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'gestionmissions',
];


$config = new Configuration();
$config->setProxyDir(__DIR__ . '/proxies'); // Répertoire pour les fichiers proxy
$config->setProxyNamespace('MyApp\Proxies');
$config->setAutoGenerateProxyClasses(true);


$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);


//$joueur = $entityManager->getRepository(Joueur::class)->findOneBy(['nom' => 'Giroud']);
$schemaTool = new SchemaTool($entityManager);

// Génération des proxies (optionnel)
$metadata = $entityManager->getMetadataFactory()->getAllMetadata();
if (!empty($metadata)) {
    $entityManager->getProxyFactory()->generateProxyClasses($metadata);
    //echo "Proxies générés avec succès.\n";
} else {
    //echo "Aucune entité trouvée.\n";
}
