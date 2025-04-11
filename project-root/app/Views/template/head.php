<!-- head.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bibliothèque</title>
    <?php if (isset($loggedIn) && $loggedIn == true) : ?>
        <span>Bonjour, <?= esc($name) ?></span>
    <?php endif ?>

    
    <!-- Styles CSS -->
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <style>
        /* Style global */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        /* Style du conteneur principal */
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style du titre */
        h1 {
            font-size: 28px;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Style des labels */
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            text-align: center;
        }

        /* Style des champs */
        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Style du bouton */
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    
    <?= $this->rendersection('content') ?>
    <?= $this->include('template/footer') ?>
</head>

