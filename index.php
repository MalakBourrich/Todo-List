<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="csss/bootstrap.min.css">
    <link rel="stylesheet" href="csss/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <?php require_once 'database.php' ?>
    <?php include_once 'includes/nav.php'; ?>
    <?php require_once 'supprimer.php'?>
    <div class="container mt-5">
        <div class="row g-3 align-items-center my-10">
            <div class="border border-primary p-2  mx-auto w-75">
                <?php
                $title = '';
                if (isset($_POST['ajouter'])) {
                    $title = htmlspecialchars($_POST['title']);
                    if (!empty($title)) {
                        $sqlState = $pdo->prepare("INSERT INTO items Values(null,?) ");
                        $result = $sqlState->execute([$title]);
                        if ($result == true) {
                ?>
                            <div class="alert alert-success" role="alert">
                                The title submited : <span class="fw-bolder"> <?= $title ?></span>
                            </div>
                        <?php
                        } else {
                        ?>
                            \<div class="alert alert-danger" role="alert">
                                The <span class="fw-bolder"> title</span> is mandatory (required)!
                            </div>
                <?php
                        }
                    }
                }

                ?>
                <h3>Ajouter une tache : </h3>
                <form method="post">
                    <div class="col-auto">
                        <label for="title" class="col-form-label">Title <span class="required">*</span></label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="title" class="form-control w-100" value="<?php $title ?>" aria-describedby="titleHelpInline" name="title">
                    </div>
                    <div class="col-auto">
                        <span id="titleHelpInline" class="form-text">
                            Le titre de la tache.
                        </span>
                    </div>
                    <div class="con-auto">
                        <input class="btn btn-primary rounded-3 my-2" type="submit" value="Ajouter" name="ajouter">
                    </div>
                </form>
            </div>
        </div>
        <table class="table mt-5">
            <?php
            $sqlState = $pdo->query("SELECT * FROM todo.items");
            $items = $sqlState->fetchAll(PDO::FETCH_OBJ);
            ?>

            <tbody>
                <?php
                foreach ($items as $key => $item) {
                ?>
                    <tr>
                        <th scope="row"><span class="badge rounded-pill text-bg-primary">#</span></th>
                        <td><?php echo $item->title ?></td>
                        <td>
                            <form method="post" >
                                <input type="hidden" value="<?php echo $item->id ?>" name="id">
                                <button class="button  rounded-circle" type="submit" name="modifier" formaction="modifier.php">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="button rounded-circle" type="submit" name="supprimer" formaction="supprimer.php" onclick="return confirm('Voulez vous vraiment supprimer <?php echo $item->title ?> ???')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>