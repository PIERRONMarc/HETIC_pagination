<!doctype html>
<html lang="en">
<head>
    <title>SAKILA - Pagination</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-5">PROJET POUR EVALUATION</h1>
            <h2 class="mb-5">SAKILA – PAGINATION</h2>
        </div>
    </div>
    <form class="row mb-3">
        <div class="col-auto d-flex align-items-center">
            <label for="limit">Nombre d'élements à afficher</label>
        </div>
        <div class="col-auto">
            <select class="form-select" name="limit" id="limit">
                <option value="10" <?= $limit == 10 ? "selected" : "" ?>>10</option>
                <option value="50" <?= $limit == 50 ? "selected" : "" ?>>50</option>
                <option value="100" <?= $limit == 100 ? "selected" : "" ?>>100</option>
            </select>
        </div>
        <?php Utilities::displayQueryParametersHiddenInputs(['direction', 'field']) ?>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Voir</button>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>
                        Film
                        <a href="?direction=asc&field=1&page=1<?= isset($_GET['limit']) ? '&limit='.$_GET['limit'] : '' ?>">asc</a>
                        <a href="?direction=desc&field=1&page=1<?= isset($_GET['limit']) ? '&limit='.$_GET['limit'] : '' ?>">desc</a>
                    </th>
                    <th>Prix location</th>
                    <th>Classification</th>
                    <th>Genre</th>
                    <th>Nombre de fois loué</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($rows as $row) {
                    ?>
                    <tr>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['rental_rate'] ?></td>
                        <td><?= $row['rating'] ?></td>
                        <td><?= $row['category'] ?></td>
                        <td><?= $row['rented_count'] ?? 0 ?></td>
                    </tr>
                    <?php
                }
                if (count($rows) == 0) {
                    ?>
                    <tr>
                        <td colspan="5">Aucune donnée</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (count($rows) > 0) :?>
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <p style="margin-bottom: 0">Affichage de l'élement <?= $offset + 1 ?> à <?= $offset  + count($rows)?> sur <?= $total ?>.</p>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <?php include "pagination.php"; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col mt-5">
            <p><a href="mailto:m_pierron1@hetic.eu">PIERRON Marc</a> @ Mastère CTO & Tech Lead P2022</p>
        </div>
    </div>
</div>
</body>
</html>