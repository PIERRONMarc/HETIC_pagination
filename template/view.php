<!doctype html>
<html lang="en">
<head>
    <title>SAKILA - Pagination</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontawesome/css/all.min.css">
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
                    <?php
                        switch ($direction) {
                            case 'desc':
                                $otherDirection = 'asc';
                                $directionIcon = 'fa-sort-up';
                                break;
                            case 'asc':
                                $otherDirection = 'desc';
                                $directionIcon = 'fa-sort-down';
                                break;
                            default:
                                $otherDirection = 'asc';
                                $directionIcon = 'fa-sort';
                                break;
                        }
                    ?>
                    <th>
                        <a href="?direction=<?= $otherDirection ?>&field=1&page=1&<?= Request::generateQueryParameters(['limit'])?>">Film</a>
                        <i class="fa-solid <?= $field == 1 ? $directionIcon : 'fa-sort' ?>"></i>
                    </th>
                    <th>Prix location</th>
                    <th>Classification</th>
                    <th>
                        <a href="?direction=<?= $otherDirection ?>&field=4&page=1&<?= Request::generateQueryParameters(['limit'])?>">Genre</a>
                        <i class="fa-solid <?= $field == 4 ? $directionIcon : 'fa-sort' ?>"></i>
                    </th>
                    <th>

                        <a href="?direction=<?= $otherDirection ?>&field=5&page=1&<?= Request::generateQueryParameters(['limit'])?>">Nombre de fois loué</a>
                        <i class="fa-solid <?= $field == 5 ? $directionIcon : 'fa-sort' ?>"></i>
                    </th>
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
            <p><a href="mailto:m_pierron1@hetic.eu">PIERRON Marc</a> @ HETIC MT5P2022</p>
        </div>
    </div>
</div>
</body>
</html>