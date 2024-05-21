<?php 
$roles = getRole($pdo);
?>

<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Users</h5>
          </div>
          <div class="col">
            <button class="btn btn-primary btn-sm float-end" id="addBrandBTN" data-bs-toggle="modal" data-bs-target="#brandModal"><i class="fa-solid fa-plus"></i>&nbsp;Add
              User</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table id="userTable" class="table table-hover table-cs-color">
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="brandForm">
      <div class="modal-header">
        <h1 class="modal-title fs-5 user-select-none" id="brandModalLabel">User Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <div class="row gy-2">
          <div class="col-lg-12">
            <label for="brand_name" class="form-label user-select-none">Display Name</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Ex. Juan Dela Cruz">
          </div>  
          <div class="col-lg-12">
            <label for="brand_name" class="form-label user-select-none">Username</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Ex. Juan">
          </div>
          <div class="col-lg-12">
            <label for="subCategory" class="form-label user-select-none">Roles</label>
            <select class="selectpicker form-control" id="subCategory" name="p_category_id" data-live-search="true">
            <option value="" disabled>Select Role</option>
              <?php foreach ($roles as $role):?>
                <option value="<?php echo $role['id'];?>"><?php echo $role['role_name'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-lg-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="loginEnabled">
                <label class="form-check-label user-select-none" for="loginEnabled">Login is enabled</label>
            </div>
          </div>
          <div class="col-lg-12">
            <label for="brand_name" class="form-label user-select-none">Password</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="******">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" id="updateBrand" update-id="">UPDATE</button>
        <button type="button" class="btn btn-primary" id="addBrand">ADD</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END -->
<script>
$(document).ready(function() {
    $('#loginEnabled').change(function() {
        if ($(this).is(':checked')) {
            // $('#toggleInput').removeClass('hidden-input');
        } else {
            //$('#toggleInput').addClass('hidden-input');
        }
    });
});
</script>