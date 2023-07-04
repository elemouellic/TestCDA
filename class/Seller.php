<?php


require_once 'dbconnector.php';

/**
 * Class Seller
 * Représente un vendeur avec son nom .
 */
class Seller extends DbConnector
{

    /**
     * @var string $name Le nom du vendeur.
     */
    private string $name;


    /**
     * Constructeur de la classe Seller.
     * @param string $name Le nom du vendeur.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Obtient le nom du vendeur.
     * @return string Le nom du vendeur.
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Crée le vendeur dans la base de données.
     */
    public function createSeller()
    {
        $db = self::dbConnect();

        $req = $db->prepare(
            "INSERT INTO seller (name) VALUES (?)");

        $req->execute([$this->name]);

    }

    /**
     * Récupère (fetch) les vendeurs de la base de données.
     */
    public function getSeller()
    {
        $db = self::dbConnect();

        $req = $db->prepare(
            "SELECT name FROM seller ORDER BY Id_sellers"
        );
        $req->execute();

        $sellers = $req->fetchAll();

        return $sellers;

    }
    
}