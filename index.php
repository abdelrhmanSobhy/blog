<?php


session_start();
require_once "db/connection.php";
require_once 'inc/header.php';

// if(!$_SESSION["successLogin"]){
//   header("Location: Login.php");
//   exit();
// }

//language 




// Pagination 
// total of posts 
$num_posts = $mysqli->prepare("SELECT COUNT(*) as total FROM posts");
if($num_posts->execute()){
  $res_query = $num_posts->get_result();
  $total_posts = $res_query->fetch_assoc()['total'];
}

// Add pagination logic
$posts_per_page = 3; 
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $posts_per_page;

$total_pages = ceil($total_posts / $posts_per_page) ; 
// validation 
if($current_page < 1){
  header("location:index.php?page=1");
  exit();
 }
else if ($current_page > $total_pages){
  header("Location:index.php?page=$total_pages");
  exit();
}

$query = "SELECT * FROM posts LIMIT ? OFFSET ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $posts_per_page, $offset);
$stmt->execute();
$posts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

?>
    Page Content
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php 
            if(isset($_SESSION['successLogin'])){
               ?>
        <div class="alert alert-success">
            <p>
                <?php
                echo $_SESSION['successLogin'];
            ?>
                </p>
        </div>
<?php
            unset($_SESSION['successLogin']);
            } 
            ?>
            <?php 
            if(isset($_SESSION['successDelete'])){
               ?>
        <div class="alert alert-danger">
            <p>
                <?php
                echo $_SESSION['successDelete'];
            ?>
                </p>
        </div>
<?php
            unset($_SESSION['successDelete']);
            } 
            ?>
            <div class="section-heading">
              <h2><?=$language['LatestPosts']?></h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>
          <?php 
          if(count($posts)){
            foreach($posts as $post){

              ?>

          <div class="col-md-4">
            <div class="product-item">
                <!-- Button trigger modal -->
                <a type="button" class="btn" data-toggle="modal" data-target="#modal<?= $post['id']?>">
                    <img src="assets/images/postImage/<?= $post['image']?>" alt="Post Image">
                </a>

                <!-- Modal -->
                <div class="modal fade" id="modal<?= $post['id']?>" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?= $post['id']?>"><?= htmlspecialchars($post['title']) ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="assets/images/postImage/<?= $post['image']?>" alt="Post Image" style="width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="down-content">
                  <a href="#"><h4>
                   <?= $post["title"]?>
                  </h4></a>
                  <h6 style="font-size: 14px;"><?= $post["created_at"]?></h6>
                  <p> <?= $post["body"] ?></p>
                  <div class="d-flex justify-content-end">
                    <a href="viewPost.php?id=<?=$post['id']?>" class="btn btn-info "><?=$language["view"]?></a>
                  </div>
                 </div>
              </div>
            </div>
                <?php 
                }
                  } else {
                       echo "<div class='col-md-12'><p>No posts to display.</p></div>";
      }
      ?>
      
          <nav aria-label="Page navigation example" class="mx-auto">
        <ul class="pagination" >
          <li class="page-item  <?php if($current_page == 1){echo 'disabled';} ?>"><a class="page-link" href="index.php?page=<?= $current_page - 1 ?>"><?=$language['Previous']?></a></li>
          <?php if($total_pages > 1){
            for($i = 1 ; $i <= $total_pages ; ++$i){
              ?>
              <li class="page-item"><a class="page-link" href="index.php?page=<?=$i?>"><?= $i ?></a></li>
            <?php
            }
          }
          ?>
          <li class="page-item <?php if($current_page == $total_pages) {echo 'disabled';}?>"><a class="page-link" href="index.php?page=<?= $current_page + 1 ?>"><?=$language['Next']?></a></li>
        </ul>
      </nav>
       
        </div>
      </div>
    </div>
    
<?php require_once 'inc/footer.php' ?>
