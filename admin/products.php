<div class="row">

<h1 class="page-header">All Products</h1>
<h3 class="bg-success"><?php display_message(); ?>  </h3>
<label>Select Category</label>&nbsp;&nbsp;
<select id="get_value" onchange="fetch_cat_wise(this.value);">
  <option value="All">All</option>
  <?php show_categories_add_product_page(); ?>
</select>
<table class="table table-hover">
              <thead>

      <tr>
           <th>Sr. No.</th>
           <th>Title</th>
           <th>Category</th>
           <th>Price</th>
           <th>Quantity</th>
      </tr>
    </thead>
    <tbody id="show_cat_wise"></tbody>
</table>
</div>
<script type="text/javascript">
  //Filter search
  window.onload=function(){
    var default_filter_value = document.getElementById("get_value").value;
    $.ajax({
     url:"functions.php",
     method:"POST",
     data:{filter_value:default_filter_value},
     success:function(data)
     {
      $('#show_cat_wise').html(data);
     }  
    });
  }
 function fetch_cat_wise(filter_value)
 {
  $.ajax({
   url:"functions.php",
   method:"POST",
   data:{filter_value:filter_value},
   success:function(data)
   {
    $('#show_cat_wise').html(data);
   }
  });
 };
</script>