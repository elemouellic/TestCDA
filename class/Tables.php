<?php


require_once 'dbconnector.php';


//Créations des tables dans mysql
class Tables extends DbConnector {
    public static function seed() {
        try {
            $bdd = self::dbConnect();

            $queries = [
                "CREATE TABLE seller (
                    Id_sellers INT AUTO_INCREMENT,
                    name VARCHAR(50) NOT NULL,
                    PRIMARY KEY(Id_sellers),
                    UNIQUE(name)
                )",
                "CREATE TABLE products (
                    Id_products INT AUTO_INCREMENT,
                    productname VARCHAR(50) NOT NULL,
                    price DECIMAL(6,2) NOT NULL,
                    PRIMARY KEY(Id_products),
                    UNIQUE(productname)
                )",
                "CREATE TABLE SELL (
                    Id_sellers INT,
                    Id_products INT,
                    quantity INT NOT NULL,
                    PRIMARY KEY(Id_sellers, Id_products),
                    FOREIGN KEY(Id_sellers) REFERENCES seller(Id_sellers),
                    FOREIGN KEY(Id_products) REFERENCES products(Id_products)
                )"
                 
            ];

            foreach ($queries as $query) {
                $bdd->exec($query);
            }

            echo "Tables créées avec succès.";
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
}
