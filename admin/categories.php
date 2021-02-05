<?php add_category(); ?>
<h1 class="page-header">
  Product Categories
</h1>
<div class="col-md-4">
    <h4 class="bg-success"><?php echo display_message(); ?></h4>
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input name="cat_title" type="text" class="form-control">
        </div>
        <div class="form-group">
            
            <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
        </div>      


    </form>
 

</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>ID</th>
            <th>Title</th>
        </tr>
            </thead>


    <tbody>
       <?php show_categories_in_admin(); ?>
    </tbody>

        </table>

</div>