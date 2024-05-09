<?php
  $categorys = getCategory($pdo);
?>
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Category</h5>
          </div>
          <div class="col">
            <button class="btn btn-primary btn-sm float-end" id="addCategoryBTN" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i>&nbsp;Add Category</button>
          </div>

        </div>

      </div>
      <div class="card-body">
        <table id="myTable" class="table table-hover table-cs-color">
          <thead>
            <tr>
              <th>Category Name</th>
              <th>Parent Category Name</th>
              <th class="exclude">Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="categoryForm">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <div class="row gy-2">
          <div class="col-lg-12">
          <label for="mainCategory" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="mainCategory" name="category_name" placeholder="Ex. Food">
          </div>
          <div class="col-lg-12">
            <label for="subCategory" class="form-label">Parent Category</label>
            <select class="selectpicker form-control" id="subCategory" name="p_category_id" data-live-search="true">
            <option value="">None</option>
              <?php foreach ($categorys as $category):?>
                <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" id="addCategory">ADD</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    var table = $('#myTable').DataTable({
        responsive: true,
        select: true,
        autoWidth: false,
        ajax:{
          url: 'admin/process/table.php',
          dataSrc: 'data'
        },
        columns:[
          {data: 'category_id', visible: false},
          {data: 'category_name'},
          {data: 'parent_category_id', visible: false},
          {data: 'parent_category_name'},
          {"data": null, "defaultContent": "<button class='btn btn-primary btn-sm btn-edit'>Edit</button>&nbsp;<button class='btn btn-danger btn-sm'>Delete</button>"}
        ]
    });
    function LoadTable(){
        $.ajax({
            url: 'admin/process/table.php',
            dataType: 'json',
            success: function(data) {
              table.clear().rows.add(data.data).draw(false); // Update data without redrawing
            
              // Reload the DataTable after a delay (e.g., 1 second) to reflect any changes in the table structure or formatting
              setTimeout(function() {
                  table.ajax.reload(null, false); // Reload the DataTable without resetting current page
              }, 1000); // Adjust delay as needed
            },
            error: function () {
                alert('Failed to retrieve categories.');
            }
        });
    }
    setInterval(LoadTable, 15000);
    $('.selectpicker').selectpicker();

    $('#addCategoryBTN').click(function(){
      $('#mainCategory').val('');
      $('#subCategory').val('');
      $('#subCategory').selectpicker('refresh');
    });
    

    $('#addCategory').click(function(){
        var formData = $('#categoryForm').serialize();
        //alert(formData);
        $.ajax({
            url: "admin/process/admin_action.php",
            method: "POST",
            data: formData+"&action=addCategory",
            dataType: "json",
            success: function(response) {
                if(response.success==true){
                    LoadTable();
                    toastr.success(response.message);
                }else{
                    toastr.error(response.message);
                }
            }
        });
    });
    $('#myTable').on('click', 'button.btn-edit', function () {
      var data = table.row($(this).parents('tr')).data();
      // // Populate modal with data
      $('#mainCategory').val(data.category_name);
      $('#subCategory').val(data.parent_category_id);
      $('#subCategory').selectpicker('refresh');
      $('#exampleModal').modal('show');
      // alert(data.parent_category_id);
    });
  });
</script>