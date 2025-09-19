<?php

require_once "db/connection.php";
require_once "inc/header.php";

if($_SERVER['REQUEST_METHOD'] == "GET"){
  
  $id = $_GET['id'];
  $query = $mysqli->prepare("SELECT * FROM posts WHERE id = ?");
  $query->bind_param("i", $id);
  $query->execute();
  $result = $query->get_result();
  $post = $result->fetch_assoc();
}

?>
    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Our Background</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/postImage/<?= $post['image']?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4><?=$post['title']?></h4>
              <p><?=$post['body']?></p>
              
              <div class="d-flex justify-content-center">
                  <a href="editPost.php?id=<?=$post['id']?>" class="btn btn-success mr-3 "> edit post</a>
              
                  <a href="handlers/handleDelete.php?id=<?=$post['id']?>" class="btn btn-danger "> delete post</a>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

<?php require_once 'inc/footer.php' ?>
