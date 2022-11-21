<?php
global $conn;
$cat_res = mysqli_query($conn, "select * from category where status=1 order by name asc");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
}
?>
<section id="appliances">
    <div class="container">
      <nav id="navbar" class="navbar d-flex justify-content-center">
        <ul>
          <?php
          foreach($cat_arr as $list){
          ?>
            <!-- <a href="Category.php?category_id=<?php echo $list['category_id']?>"> -->
            <li class="dropdown"><a href="#"><?php echo $list['name']?></a>
              <?php 
              $c_id=$list['category_id'];
              $subcat = mysqli_query($conn,"select * from sub_category where status=1 and category_id='$c_id'");
              if(mysqli_num_rows($subcat)>0){
              ?> 
              <ul>
                <?php 
                  while($subcatrow=mysqli_fetch_assoc($subcat)){
                    echo '<li><a href="Category.php?subcat_id='.$subcatrow['subcategory_id'].'">'.$subcatrow['sname'].'</a></li>';
                    // echo '<li><a href="categories.php?id='.$list['category_id'].'&subcat_id='.$subcatrow['subcategory_id'].'">'.$subcatrow['name'].'</a></li>';
                  }
                ?>
              </ul>
              <?php } ?>
            </li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </section>