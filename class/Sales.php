<?php


require_once 'dbconnector.php';

/**
 * Class Sells
 * Représente un tableau des ventes.
 */
class Sales extends DbConnector
{


    /**
     * Crée le tableau dans la base de données.
     */
    public function createSales($sellerId, $productId, $quantity)
    {
        $db = self::dbConnect();
    
        $req = $db->prepare(
            "INSERT INTO SELL (Id_sellers, Id_products, quantity) VALUES (?, ?, ?)");
        $req->execute([$sellerId, $productId, $quantity]);
    }

    public function getSales()
    {
        $db = self::dbConnect();

        $req = $db->prepare(
            "SELECT seller.name, products.productname, sell.quantity
            FROM seller
            JOIN sell ON seller.Id_sellers = sell.Id_sellers
            JOIN products ON products.Id_products = sell.Id_products"
        );

        $req->execute();

        $sales = $req->fetchAll();

        return $sales;
    }

    public function getTurnover()
    {
        $db = self::dbConnect();

        $req = $db->prepare(
            "SELECT seller.name, products.productname, products.price, sell.quantity
            FROM seller
            JOIN sell ON seller.Id_sellers = sell.Id_sellers
            JOIN products ON products.Id_products = sell.Id_products;"
        );

        $req->execute();

        $turnover = $req->fetchAll();

        return $turnover;

    }
    
    
}

