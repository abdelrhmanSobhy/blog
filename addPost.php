<?php
session_start(); // Add this at the very top
require_once 'inc/header.php';

?>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4><?= $language['NewPost'] ?></h4>
              <h2><?= $language['AddNewPersonalPost'] ?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="container w-50 ">
  <div class="d-flex justify-content-center">
    <h3 class="my-5"><?= $language['AddNewPost'] ?></h3>
  </div>
  <form method="POST" action="handlers/handleAdd.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label"><?= $language['Title'] ?></label>
        <input type="text" class="form-control" id="title" name="title" value="">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label"><?= $language['Body'] ?></label>
        <textarea class="form-control" id="body" name="body" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label"><?= $language['Image'] ?></label>
        <input type="file" class="form-control-file" id="image" name="image" >
    </div>
    <button type="submit" class="btn btn-primary" name="submit"><?= $language['Submit'] ?></button>
  </form>
</div>

    <?php require_once 'inc/footer.php' ?>
