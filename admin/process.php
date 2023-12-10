<?php

if(isset($_POST["cat"]) && isset($_POST["parent_cat"])){
    $name = $_POST["cat"];
    $parent = $_POST["parent_cat"];
    include("conn.php");
    $stmt = $conn->prepare("INSERT INTO category(cat_name, parent_cat) VALUES (:name, :parent)");
    $stmt->execute(array(

    'name' => $name,
    'parent' => $parent
    ));

    if($stmt){
        return "CATEGORY_ADDED";
    }else{
        return "error";
    }


}

if(isset($_POST["brand_name"])){
    $name = $_POST["brand_name"];
    include("conn.php");
    $stmt = $conn->prepare("INSERT INTO brand(brand_name) VALUES (:name)");
    $stmt->execute(array(

    'name' => $name,
    
    ));

    if($stmt){
        return "CATEGORY_ADDED";
    }else{
        return "error";
    }


}

if(isset($_POST["product_name"]) && isset($_POST["select_cat"]) && 
isset($_POST["select_brand"]) && isset($_POST["product_price"]) && isset($_POST["product_qty"])){

    $name = $_POST["product_name"];
    $select_cat = $_POST["select_cat"];
    $select_brand = $_POST["select_brand"];
    $product_price = $_POST["product_price"];
    $product_qty = $_POST["product_qty"];
    $date = $_POST["added_date"];


    include("conn.php");
    $stmt = $conn->prepare("INSERT INTO products(pro_name, pro_brand, pro_category,pro_price,pro_qty,added_date) VALUES
     (:name, :select_cat, :select_brand, :product_price, :product_qty, :added_date)");
    $stmt->execute(array(

    'name' => $name,
    'select_cat' => $select_cat,
    'select_brand' => $select_brand,
    'product_price' => $product_price,
    'product_qty' => $product_qty,
    'added_date' => $date

    
    ));

    if($stmt){
        return "CATEGORY_ADDED";
    }else{
        return "error";
    }


}

if (isset($_POST["manageCategory"])) {
    include("conn.php");

    $stmt = $conn->prepare("SELECT p.cat_name, c.cat_name, p.c_status FROM category p LEFT JOIN category c ON p.parent_cat=c.cat_id LIMIT 5");
    $stmt->execute();
    $row = $stmt->fetchAll();
    $count = $stmt->rowCount();

    echo $count;
    var_dump($row);
}

if (isset($_GET['cat_id'])){

    include("conn.php");

    $cat_id = $_GET['cat_id'];

    echo $cat_id;

    $stmt = $conn->prepare("DELETE FROM category WHERE cat_id = :zid");

					$stmt->bindParam(":zid", $cat_id);

					$stmt->execute();

                    header('Location: manage_category.php');

		            exit();
}

if (isset($_GET['pro_id'])){

    include("conn.php");

    $pro_id = $_GET['pro_id'];

    // echo $cat_id;

    $stmt = $conn->prepare("DELETE FROM products WHERE cat_id = :zid");

					$stmt->bindParam(":zid", $pro_id);

					$stmt->execute();

                    header('Location: manage_product.php');

		            exit();
}

if (isset($_GET['brand_id'])){

    include("conn.php");

    $brand_id = $_GET['brand_id'];

    // echo $cat_id;

    $stmt = $conn->prepare("DELETE FROM brand WHERE brand_id = :zid");

					$stmt->bindParam(":zid", $brand_id);

					$stmt->execute();

                    header('Location: manage_brand.php');

		            exit();
}

if (isset($_GET['approve'])){

    include("conn.php");

     $approve = $_GET['approve'];

     $stmt = $conn->prepare("SELECT * FROM category WHERE cat_id = :zid");

        $stmt->bindParam(":zid", $approve);

        $stmt->execute();

        $row = $stmt->fetchAll();

        $count = $stmt->rowCount();

            if($count > 0){

                $stmt = $conn->prepare("UPDATE category SET c_status = 1 WHERE cat_id = ?");

                $stmt->execute(array($approve));
                
                header('Location: manage_category.php');

                exit();
            }
}
if (isset($_POST['updateCategory'])){

    include("conn.php");

     $approve = $_POST['id'];

     $stmt = $conn->prepare("SELECT * FROM category WHERE cat_id = :zid");

        $stmt->bindParam(":zid", $approve);

        $stmt->execute();

        $row = $stmt->fetchAll();

        // $count = $stmt->rowCount();

        //  var_dump($row);

            echo json_encode($row);

           exit();

      }

if (isset($_POST["getNewOrderItem"])){

    include("conn.php");

    $stmt = $conn->prepare("SELECT * FROM products");

					// $stmt->bindParam(":zid", $pro_id);

					$stmt->execute();

                    $rows = $stmt->fetchAll();
                    

                    ?>
                         <tr>
                                <td><b class="number">1</b></td>
                                <td>
                                    <select name="pid[]" class="form-control form-control-sm pid" id="">
                                    <option value="" >Select Item</option>
                                        <?php 
                                            foreach($rows as $row){
                                                ?>
                                                   <option value="<?php echo $row['pro_id']; ?>"><?php echo $row['pro_name']  ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" value="" name="tqty[]" class="form-control form-control-sm tqty" readonly></td>
                                <td><input type="text" name="qty[]" class="form-control form-control-sm qty" require></td>
                                <td><input type="text" name="price[]" class="form-control form-control-sm price" readonly></td>
                                <span><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name"></span>
                                <td style="text-align:center;"> Rs.<span class="amt">0</span></td>
                            </tr>
                    <?php

		             exit();
}

if(isset($_POST["getPriceAndQty"])){

    $id = $_POST['id'];

     echo $id;

    include("conn.php");

    $stmt = $conn->prepare("SELECT * FROM products WHERE pro_id = :id");

    $stmt->bindParam(":id", $id);

    $stmt->execute();

    $rows = $stmt->fetch();

    echo json_encode($rows);

    exit();

}