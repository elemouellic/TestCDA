<?php
require_once(__ROOT__ . '/testcda/class/Dbconnector.php');
require_once(__ROOT__ . '/testcda/class/Tables.php');
require_once(__ROOT__ . '/testcda/class/Phone.php');
require_once(__ROOT__ . '/testcda/class/Seller.php');
require_once(__ROOT__ . '/testcda/class/Sales.php');


//Initialisation du compteur pour classe Bootstrap
$counter = 0;

/**
 * Instanciation des objets pour traitement en front
 */

//Instanciation de l'objet Seller
$seller = new Seller("sellerName");
// Appel de la méthode getSeller() pour récupérer les vendeurs de la base de données
$sellers = $seller->getSeller();


//Instanciation de l'objet Phone
$phone = new Phone("productName");
// Appel de la méthode getProduct() pour récupérer les portables de la base de données
$phones = $phone->getProduct();
// Appel de la méthode getPrice() pour récupérer les portables de la base de données
$phonePrices = $phone->getPrice();


//Instanciation de l'objet Sales
$sales = new Sales();
//Appel de la méthode getSales()
$totalSales = $sales->getSales();
//Appel de la méthode getTurnover()
$turnover = $sales->getTurnover();



/**
 * Traitement des méthodes POST
 */

// Traitement du formulaire de création de vendeur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) :
    if (!empty($_POST['name'])) :
        $names = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $seller = new Seller($names);
        $seller->createSeller();
    endif;
    header("Refresh: 0");
    exit;
endif;

// Traitement du formulaire de création de téléphone
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone_model'])) :

    if (!empty($_POST['phone_model'])) :
        $phoneModel = filter_var($_POST['phone_model'], FILTER_SANITIZE_SPECIAL_CHARS);
        $product = new Phone($phoneModel);
        $product->createProduct($phoneModel);
    endif;
    header("Refresh: 0");
    exit;
endif;


// Traitement du formulaire de la création des ventes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) :
    foreach ($_POST['quantity'] as $sellerIndex => $seller) :
        foreach ($seller as $phoneIndex => $quantity) :
            $quantity = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

            // Ajouter 1 à l'index pour correspondre à l'id dans SQL
            $sellerId = $sellerIndex + 1;
            $phoneId = $phoneIndex + 1;

            // Création des ventes
            $sales = new Sales([]);
            $sales->createSales($sellerId, $phoneId, $quantity);
        endforeach;
    endforeach;
    header("Refresh: 0");
    exit;
endif;

// Traitement du formulaire de l'initialisation des prix
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price'])) :
    foreach ($_POST['price'] as $phoneIndex => $phonePrice):
        $phonePrice = filter_var($phonePrice, FILTER_SANITIZE_NUMBER_FLOAT);

        // Ajouter 1 à l'index pour correspondre à l'id dans SQL
        $phoneId = $phoneIndex + 1;

        $phone = new Phone("productName");
        $phone->setPrice($phoneId, $phonePrice);
    endforeach;
    header("Refresh: 0");
    exit;
endif;