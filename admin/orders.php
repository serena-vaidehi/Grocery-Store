<div class="col-md-12">
<div class="row">
<h1 class="page-header">
Orders
</h1>

</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>ID</th>
           <th>Name</th>
           <th>Address</th>
           <th>Phone</th>
           <th>Order Type</th>
           <th>Amount</th>
           <th>Detail</th>
           <th>Status</th>
           <th>Update Status</th>
      </tr>
    </thead>
    <tbody>
        <?php display_orders(); ?>
    </tbody>
    </table>
</div>
    <script type="text/javascript">
function update_sta(val1, val2){
  var order_status = val1
  var order_id = val2;
  console.log(order_status);
  console.log(order_id);
    $(document).ready(function(){
           $.ajax({  
                url:"functions.php",
                method:"post",  
                data:{order_id, order_id, order_status, order_status},  
                success:function(data){  
                    alert("Order status updated")  
                    window.location.reload();  
                }
           });
    });
}
</script>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Order status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <center>      
        <div class="modal-body" id="order_update">
          <form>
          <select name="order" id="order_status">
            <option value="">Update Status</option>
            <option value="Confirmed Order">Confirmed Order</option>
            <option value="Processing Order">Processing Order</option>
            <option value="Packed">Packed</option>
            <option value="Dispatched Item">Dispatched Item</option>
            <option value="Product Delivered">Product Delivered</option>
          </select>
          <button class="btn btn-success" id="update" onclick="console,log('test')">Update</button>
        </form>
        </div>
      </center>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
