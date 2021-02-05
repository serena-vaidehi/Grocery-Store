<div class="row">

<h1 class="page-header">
   Order Item List

</h1>
<h3 class="bg-success"><?php display_message(); ?>  </h3>
<table class="table table-hover">
    <thead>
      <tr>
           <th>Sr. No</th>
           <th>Order ID</th>
           <th>Product Title</th>
           <th>Price</th>
           <th>Product Quantity</th>
      </tr>
    </thead>
    <tbody>
      <?php get_reports(); ?>
  </tbody>
</table>
</div>