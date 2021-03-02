<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>   ( pour obtenir une information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs.
     * 4. Récupérez l'âge maximum des utilisateurs.
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.
    try {
        $server = "localhost";
        $db = "exo_196";
        $user = "root";
        $password = "";

        $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT MIN(age) as minimum FROM exo_196.user");
        $state = $stmt->execute();
        if ($state) {
            $min = $stmt->fetch();
            echo "L'age le plus jeune ayant été trouvé est : " . $min['minimum'] . " ans." ."<br>";
        }

        $stmt2 = $pdo->prepare("SELECT MAX(age) as maximum FROM exo_196.user");
        $state2 = $stmt2->execute();
        if ($state2) {
            $max = $stmt2->fetch();
            echo "L'age le plus vieux ayant été trouvé est : " . $max['maximum'] . " ans." ."<br>";
        }

        $stmt3 = $pdo->prepare("SELECT count(*) as number FROM exo_196.user");
        $state3 = $stmt3->execute();
        if ($state3) {
            $count = $stmt3->fetch();
            echo "Il y a " . $count['number']. " utilisateurs"."<br>";
        }

        $stmt4 = $pdo->prepare("SELECT count(*) as number FROM exo_196.user WHERE numero >= 5");
        $state4 = $stmt4->execute();
        if ($state4) {
            $count = $stmt4->fetch();
            echo "Il y a " . $count['number']. " utilisateurs". " avec un numéro de rue plus grand ou égal à 5"."<br>";
        }

        $stmt5 = $pdo->prepare("SELECT AVG(age) as moyenne FROM exo_196.user");
        $state5 = $stmt5->execute();
        if ($state5) {
            $count = $stmt5->fetch();
            echo "La moyenne d'age est de : " . $count['moyenne']. " ans"."<br>";
        }

        $stmt6 = $pdo->prepare("SELECT SUM(numero) as somme FROM exo_196.user");
        $state6 = $stmt6->execute();
        if ($state6) {
            $count = $stmt6->fetch();
            echo "La somme des numeros est de : ".$count['somme']."<br>";
        }

    }
    catch (PDOException $exception) {
        echo $exception->getMessage();
    }

    ?>
</body>
</html>

