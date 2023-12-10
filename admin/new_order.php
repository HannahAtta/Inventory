<?php
  $pageTitle = 'dashboard';
  session_start();
  if(!isset($_SESSION['row'])) header('location: login.php');
  $user = $_SESSION['row'];

  include("conn.php");

 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/back.css">
    <title>Dashboard</title>
</head>
<body>
<div class="overlay"><div class="loader"></div></div>
<div class="dashaPage">
    <?php include('sidebar.php') ?>
    <div class="content" id="content">
        <div class="contentNav">
                <a href="#" id="toggle"><i class="fa fa-navicon"></i></a>
                <a href="logout.php" id="logout"><i class="fa fa-power-off"></i>Logout</a>
        </div>
    <div class="contentBody">
        <div class="contentMain">
          <div class="container">
          <div class="row">
            <div class="offset-1 col-md-10">
            <div class="card mt-5" style="box-shadow: 0 0 25px 0 lightgrey;">
             <div class="card-header">
                <h4>New Orders</h4>
             </div>
             <div class="card-body">
               <form action="" onsubmit="return false">
                 <div class="form-group row">
                    <label for="" class="col-sm-3 text-center" align="right">Order Date</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" value="<?php echo date("y-d-m"); ?>" readonly >
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="" class="col-sm-3 text-center" align="right">Customer Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" value="" placeholder="Enter Customer Name" >
                    </div>
                </div>
                <br>
                 <div class="card" style="box-shadow: 0 0 25px 0 lightgrey;">
                    <div class="card-body">
                        <h3>Make Order List</h3>
                        <table class="table table-hover table-bordered" align="center">
                          <thead>
                            <tr>
                                <th style="text-align:center;">#</th>
                                <th style="text-align:center;">Item Name</th>
                                <th style="text-align:center;">Total Quantity</th>
                                <th style="text-align:center;">Quantity</th>
                                <th style="text-align:center;">Price</th>
                                <th>Total</th>
                            </tr>
                          </thead>
                          <tbody id="invoice_item">
                            <!-- <tr>
                                <td><b id="number">1</b></td>
                                <td>
                                    <select name="pid[]" class="form-control form-control-sm" id="">
                                        <option value="" >Washing Machine</option>
                                    </select>
                                </td>
                                <td><input type="text" name="tqty[]" class="form-control form-control-sm" readonly></td>
                                <td><input type="text" name="qty[]" class="form-control form-control-sm" require></td>
                                <td><input type="text" name="price[]" class="form-control form-control-sm" readonly></td>
                                <td style="text-align:center;"> Rs.1540</td>
                            </tr> -->
                          </tbody>
                        </table>
                        <br>
                        <center>
                            <button class="btn btn-success" style="width:150px" id="add">Add</button>
                            <button class="btn btn-danger" style="width:150px" id="remove">Remove</button>
                        </center>
                    </div>
                 </div>

                 <p></p>
                 <div class="form-group row">
                    <label for="sub_total" class="col-sm-3 col-form-label text-center" align="right">Sub Total</label>
                    <div class="col-sm-6">
                        <input type="text" name="sub_total" id="sub_total" class="form-control form-control-sm" value="" placeholder="" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gst" class="col-sm-3 text-center col-form-label" align="right">GST (18%)</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" value="" name="gst" id="gst" placeholder=""required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount" class="col-sm-3 col-form-label text-center" align="right">Discount</label>
                    <div class="col-sm-6">
                        <input type="text" name="discount" id="discount" class="form-control form-control-sm" value="" placeholder="" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="net_total" class="col-sm-3 col-form-label text-center" align="right">Net Total</label>
                    <div class="col-sm-6">
                        <input type="text" name="not_total" id="not_total" class="form-control form-control-sm" value="" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="paid" class="col-sm-3 col-form-label text-center" align="right">Paid</label>
                    <div class="col-sm-6">
                        <input type="text" name="paid" id="paid" class="form-control form-control-sm" value="" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="due" class="col-sm-3 col-form-label text-center" align="right">Due</label>
                    <div class="col-sm-6">
                        <input type="text" name="due" id="due" class="form-control form-control-sm" value="" placeholder="" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="payment_type" class="col-sm-3 col-form-label text-center" align="right">Payment Method</label>
                    <div class="col-sm-6">
                        <select name="payment_type" id="payment_type" class="form-control form-control-sm" required>
                            <option value="">Cash</option>
                            <option value="">Card</option>
                            <option value="">Draft</option>
                            <option value="">Cheque</option>
                        </select>
                    </div>
                </div>
                <center>
                  <input type="submit" id="order-form" style="width:150px;" class="btn btn-info" value="order">
                  <input type="submit" id="print-invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                </center>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
  </div>
 </div>
</div>

    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/back.js"></script> 
    <script>
    var sidebarOpen = true;

      toggle.addEventListener('click', (e)=>{
        // alert('hi');
        e.preventDefault();

      if(sidebarOpen){
        sidebar.style.width = '10%';
        sidebar.style.transition = '0.3s all';
        content.style.width = '90%';
        logo.style.fontSize = '40px';
        logo.style.marginTop = '10px';

        menuIcon = document.getElementsByClassName('menuIcon');
        for(var i=0; i < menuIcon.length; i++){
          menuIcon[i].style.display = 'none';
        }
        sidebarOpen = false;
      }else{
        sidebar.style.width = '20%';
        content.style.width = '80%';
        logo.style.fontSize = '60px';

        menuIcon = document.getElementsByClassName('menuIcon');
        for(var i=0; i < menuIcon.length; i++){
          menuIcon[i].style.display = 'inline-block';
        }
        sidebarOpen = true;
      }
        
      });
    </script> 
  
 
</body>
</html>