<?php


require_once 'dbconnector.php';


/**
 * Class Phone
 * Représente un téléphone avec son nom de modèle et son prix.
 */
class Phone extends DbConnector
{

    /**
     * @var string $model Le nom du modèle.
     */
    private $model;


    /**
     * Constructeur de la classe Phone.
     * @param string $model Le nom du modèle.
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Obtient le nom du modèle.
     * @return string Le nom du modèle.
     */
    public function getModel()
    {
        return $this->model;
    }


    /**
     * Crée le modèle de téléphone dans la base de données.
     */
    public function createProduct($model)
    {
        $db = self::dbConnect();
    
        $req = $db->prepare(
            "INSERT INTO products (productname) VALUES (?)");
    
        $req->execute([$model]);
    }

    /**
     * Initialise le prix du téléphone dans la base de données.
     */

     public function setPrice($modelId, $price)
     {
         $db = self::dbConnect();
     
         $req = $db->prepare(
             "UPDATE products SET price = ? WHERE Id_products = ?"
         );
     
         $req->execute([$price, $modelId]);
     }

     /**
     * Récupère (fetch) le prix du téléphone dans la base de données.
     */

     public function getPrice()
     {
         $db = self::dbConnect();
     
         $req = $db->prepare(
             "SELECT price FROM products ORDER BY Id_products"
         );
     
         $req->execute();

         $prices = $req->fetchAll();
 
         return $prices;
     }
     

    /**
     * Récupère (fetch) les modèles de téléphone de la base de données.
     */
    public function getProduct()
    {
        $db = self::dbConnect();

        $req = $db->prepare(
            "SELECT productname FROM products ORDER BY Id_products"
        );
        $req->execute();

        $products = $req->fetchAll();

        return $products;

    }

}