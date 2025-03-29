<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="csss/bootstrap.min.css">
    <link rel="stylesheet" href="csss/style.css">
</head>

<body>
    <?php
    if (!isset($_POST['id'])) {
        header('location: index.php');
    }
    require_once 'database.php';
    include_once 'includes/nav.php';
    $id = $_POST['id'];
    $sqlState = $pdo->prepare('SELECT * FROM items WHERE id=?');
    $sqlState->execute([$id]);
    $item = $sqlState->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['modifier2'])) {
        $title = $_POST['title'];
        $id = $_POST['id'];
        if (!empty($id) && !empty($title)) {
            $sqlState = $pdo->prepare('UPDATE items  SET title=? WHERE id=?');
            $result = $sqlState->execute([$title, $id]);
            if ($result == true) {
                header('location:index.php');
            }
        } else {
    ?>
            <div class="alert alert-danger" role="alert">
                The <span class='fw-bolder'>title </span> mandatory (required).
            </div>
    <?php
        }
    }
    ?>
    <div class="row g-3 align-items-center my-10 mt-5">
        <div class="border border-primary p-2  mx-auto w-75">

            <h3>Modifier une tache : </h3>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $item->id ?>">
                <div class="col-auto">
                    <label for="title" class="col-form-label">Title <span class="required">*</span></label>
                </div>
                <div class="col-auto">
                    <input type="text" id="title" class="form-control w-100" value="<?php echo $item->title ?>" aria-describedby="titleHelpInline" name="title">
                </div>
                <div class="col-auto">
                    <span id="titleHelpInline" class="form-text">
                        Le titre de la tache.
                    </span>
                </div>
                <div class="con-auto">
                    <input class="btn btn-primary rounded-3 my-2" type="submit" value="Modifer" name="modifier2">
                </div>
            </form>
        </div>
    </div>
</body>

</html