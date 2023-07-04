<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/testcda/variables.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <main class="container">
        <h1 class="text-center mb-3">Tableau des ventes</h1>

        <div class="row">
            <div class="col-12">

                <!-- Formulaire ajout vendeur -->
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Prénom</span>
                        <input type="text" name="name" class="form-control" placeholder="Vendeur" aria-label="Vendeur" aria-describedby="basic-addon1">
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary mb-3" type="submit">Ajouter vendeur</button>
                    </div>
                </form>

            </div>
            <div class="col-12">
                <!-- Formulaire ajout téléphone -->
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Modèle</span>
                        <input type="text" name="phone_model" class="form-control" placeholder="Téléphone" aria-label="Téléphone" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary mb-3" type="submit">Ajouter téléphone</button>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <h2>Liste des vendeurs</h2>
                <div class="col-12">

                    <?php 
                    //Tableau pour stocker les noms de vendeurs
                    $arraySellers = [];
                    ?>

                    <?php foreach ($sellers as $index => $seller) : ?>
                        <?php
                        // Assigner la valeur à l'index correspondant
                        $arraySellers[$index] = $seller[0];
                        // Bootstrap
                        $counter++;
                        $class = ($counter % 2 == 0) ? '' : 'bg-light';
                        ?>
                        <div class="col-12 p-2 <?php echo $class; ?>">Vendeur numéro <?php echo $index . " : " .  $arraySellers[$index]; ?></div>
                    <?php endforeach; ?>

                </div>

                <h2>Liste des portables</h2>
                <div class="col-12">

                    <?php
                    // Tableau pour stocker les noms des téléphones
                    $arrayPhones = [];
                    ?>

                    <?php foreach ($phones as $index => $phone) : ?>
                        <?php
                        // Assigner la valeur à l'index corrrspondant
                        $arrayPhones[$index] = $phone[0];
                        // Bootstrap
                        $counter++;
                        $class = ($counter % 2 == 0) ? '' : 'bg-light';
                        ?>
                        <div class="col-12 p-2 <?php echo $class; ?>">Portable numéro <?php echo $index . " : " .  $arrayPhones[$index]; ?></div>
                    <?php endforeach; ?>
                </div>

                <h2 class="mb-3">Enregistrement des ventes</h2>
                <div class="col-12">

                    <!-- Formulaire enregistrement des ventes -->
                    <form action="" method="POST">

                        <?php foreach ($sellers as $sellerIndex => $seller) : ?>

                            <div class="col-12">
                                <h3><?php echo "Vendeur numéro " . $sellerIndex . ": " . $seller[0]; ?></h3>

                                <?php foreach ($phones as $phoneIndex => $phone) : ?>

                                    <div class="input-group mb-3 flex-column">
                                        <span class="input-group-text w-75" id="basic-addon1"><?php echo "Portable numéro " . $phoneIndex . ": " . $phone[0]; ?></span>
                                        <input class="form-control w-25" type="number" name="quantity[<?php echo $sellerIndex; ?>][<?php echo $phoneIndex; ?>]" placeholder="Quantité vendue" aria-label="Quantité vendue" aria-describedby="basic-addon1" required>
                                    </div>

                                <?php endforeach; ?>

                            </div>

                        <?php endforeach; ?>

                        <div class="col-12">
                            <button class="btn btn-primary mb-3" type="submit">Enregistrer les ventes</button>
                        </div>
                    </form>

                </div>
                <h2 class="mb-3">Tableau associatif des ventes</h2>
                <div class="col-12">

                    <?php
                    $finalArray = array(
                        $arrayPhones,
                        $totalSales
                    );

                    // Obtention de tous les noms des vendeurs, des quantités et des produits
                    $sellerNames  = array_unique(array_column($finalArray[1], 'name'));
                    $phoneSales   = array_column($finalArray[1], 'quantity');
                    $productNames = array_column($finalArray[1], 'productname');
                    ?>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="row">#</th>

                                <?php foreach ($finalArray[0] as $phoneModel) : ?>

                                    <th scope="row"><?php echo $phoneModel; ?></th>

                                <?php endforeach; ?>

                                <th scope="row">Total ventes</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($sellerNames as $sellerName) : ?>

                                <tr>
                                    <th scope="row"><?php echo $sellerName; ?></th>

                                    <?php foreach ($finalArray[1] as $sale) : ?>

                                        <?php if ($sale['name'] === $sellerName) : ?>
                                            <td><?php echo $sale['quantity']; ?></td>
                                        <?php endif; ?>

                                    <?php endforeach; ?>


                                    <?php
                                    // Initialisation d'un tableau vide
                                    $newArray = array(); ?>

                                    <?php foreach ($finalArray[1] as $sale) : ?>

                                        <?php if ($sale['name'] === $sellerName) : ?>

                                            <?php
                                            $toInteger = intval($sale['quantity']);
                                            array_push($newArray, $toInteger);
                                            $total = array_sum($newArray);
                                            ?>

                                        <?php endif; ?>

                                    <?php endforeach; ?>

                                    <td><?php echo $total; ?></td>
                                </tr>

                            <?php endforeach; ?>

                            <th scope="row">Total</th>

                            <?php

                            $totals = array();

                            foreach ($productNames as $productName) :
                                $totals[$productName] = 0;

                                foreach ($finalArray[1] as $sale) :

                                    if ($sale['productname'] === $productName) :
                                        $quantity = intval($sale['quantity']);
                                        $totals[$productName] += $quantity;
                                    endif;

                                endforeach;

                            endforeach;

                            // Afficher les totaux par modèle de téléphone
                            foreach ($totals as $productName => $total) : ?>

                                <td><?php echo $total; ?></td>

                            <?php endforeach; ?>

                            <td class="fw-bold"><?php echo array_sum($phoneSales); ?></td>

                        </tbody>

                    </table>

                </div>

                <h2 class="mb-3">Initialisation du prix</h2>
                <div class="col-12">

                    <form action="" method="POST">

                        <?php foreach ($phones as $model => $phone) : ?>

                            <?php
                            $arrayPhones[$model] = $phone["productname"];
                            ?>

                            <div class="input-group mb-3 flex-column">
                                <span class="input-group-text w-75" id="basic-addon1"><?php echo $arrayPhones[$model]; ?></span>
                                <input type="number" class="form-control w-25" name="price[<?php echo $model; ?>]" placeholder="Prix du modèle:" aria-label="Prix du modèle" aria-describedby="basic-addon1" required>
                            </div>

                        <?php endforeach; ?>

                        <div class="col-12">
                            <button class="btn btn-primary mb-3" type="submit">Enregistrer les prix de ventes</button>
                        </div>
                    </form>

                    <ul class="list-group mb-3">

                        <?php foreach ($arrayPhones as $index => $phone) :

                            $price = $phonePrices[$index]['price']; ?>
                            <li class="list-group-item"><?php echo $phone . " : " . $price . "€"; ?></li>

                        <?php endforeach; ?>
                    </ul>

                </div>
                <h2 class="mb-3">Chiffre d'affaires par vendeur</h2>
                <div class="col-12">


                    <?php

                    // Tableau pour stocker les valeurs du chiffre d'affaires final
                    $salesBySeller = array();

                    // Parcours du tableau de chiffre d'affaires
                    foreach ($turnover as $item) :
                        $sellerName    = $item['name'];
                        $price         = $item['price'];
                        $quantity      = $item['quantity'];
                        $totalRevenue  = $price * $quantity;


                        // Vérifie si le vendeur existe déjà dans le tableau
                        if (isset($salesBySeller[$sellerName])) :
                            // Ajoute le chiffre d'affaires au vendeur existant
                            $salesBySeller[$sellerName] += $totalRevenue;
                        else :
                            // Ajoute une nouvelle entrée pour le vendeur avec le chiffre d'affaires
                            $salesBySeller[$sellerName] = $totalRevenue;
                        endif;

                    endforeach; ?>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nom du vendeur</th>
                                <th scope="col">Chifre d'affaires total</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($salesBySeller as $sellerName => $totalRevenue) : ?>

                                <tr>
                                    <th scope="row"><?php echo $sellerName; ?></th>
                                    <td><?php echo $totalRevenue . " €"; ?></td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>