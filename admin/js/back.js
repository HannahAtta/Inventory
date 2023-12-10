$(function () {

	'use strict';

   $('.confirm').click(function () {

		return confirm('Are You Sure?');

	});

   $('.menuList li a').click(function(){

      console.log('kk');

		 $(this).addClass('active').siblings().removeClass('active');

      //  $(this).addClass('active').parent().siblings().find('a').removeClass('active').siblings().removeClass('active');

	});

   $(".contentMain botton").hover(function(){

      $(this).find('span').eq(0).animate({
         width: '100%'
       }, 500);

   })

   $("#form-cat").on("submit", function(e){

      e.preventDefault();

     if  ($("#cat-name").val() == "" ){
       
       $("#cat-name").addClass("border-danger");

       $("#cat-error").html("<span class='text-danger'>Please Enter Category Name</span>");

     }else{
       function fetch_cat(){
       $.ajax({
         url: "process.php",
         method: "POST",
         data: $("#form-cat").serialize(),
         success: function(data){
            // if(data == "CATEGORY_ADDED"){
               $("#cat-name").removeClass("border-danger");

               $("#cat-error").html("<span class='text-success'>New Category Added Successfly..</span>");

               $("#cat-name").val("");
               fetch_cat();
            // }
         }
       });   
      };
     };

   });

   $("#brand_form").on("submit", function(e){

      e.preventDefault();
      
      if  ($("#brand_name").val() == "" ){
       
         $("#brand_name").addClass("border-danger");
  
         $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
      }else{
         $.ajax({
            url: "process.php",
            method: "POST",
            data: $("#brand_form").serialize(),
            success: function(data){
               // if(data == "CATEGORY_ADDED"){
                  $("#brand-name").removeClass("border-danger");
   
                  $("#brand_error").html("<span class='text-success'>New brand Added Successfly..</span>");
   
                  $("#brand_name").val("");
               // }
            }
          });   
      }

   });

   
   $("#product_form").on("submit", function(e){

      // e.preventDefault();
      
      if  ($("#product_name").val() == "" ){
       
         $("#product_name").addClass("border-danger");
  
         // $("#product_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
      }else{
         $.ajax({
            url: "process.php",
            method: "POST",
            data: $("#product_form").serialize(),
            success: function(data){
               // if(data == "CATEGORY_ADDED"){
                  $("#product-name").removeClass("border-danger");
   
                  // $("#brand_error").html("<span class='text-success'>New brand Added Successfly..</span>");
   
                  $("#product_name").val("");
                  fetch_cat();
               // }
            }
          });   
      }

   });

   $("body").delegate(".edit_cat", "click", function(){
      var eid = $(this).attr("eid");
      $.ajax({
         url : "process.php",
         method : "POST",
         data: {updateCategory:1,id:eid},
         success : function(data){
            // alert(data);
            // alert(data["parent_cat"]);
            // console.log(data);
            $("#cid").val(data["cid"]);
            $("#category_name").val(data);
         }
      });
   });


  //new order
   addNewRow();
  $("#add").click(function(){
   addNewRow();
  })

  function addNewRow(){
   $.ajax({
      url: "process.php",
      method: "POST",
      data: {getNewOrderItem:1},
      success: function(data){
         $("#invoice_item").append(data);
         var n = 0;
         $(".number").each(function(){
            $(this).html(++n);
         })
      }
   });
  }
    $("#remove").click(function(){
    $("#invoice_item").children("tr:last").remove();
  });
  
  $("#invoice_item").delegate(".pid", "change", function(){
   var pid = $(this).val();
   var tr  = $(this).parent().parent();
   $(".overlay").fadeIn();
   $.ajax({
      url: "process.php",
      method: "POST",
      // dataType: "json",
      data: {getPriceAndQty:1,id:pid},
      success: function(data){
          alert(data);
          alert(data["pro_name"]);
         tr.find(".tqty").val(data["pro_qty"]);
         tr.find(".pro_name").val(data["pro_name"]);
         tr.find(".qty").val(1);
         tr.find(".price").val(data["pro_price"]);
         tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
      }
   });
  });

 });