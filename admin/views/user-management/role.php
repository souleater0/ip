<?php 
$modules = getModules($pdo);
//$permissions = getModulePermissions($pdom ,$moduleId);
// function getModulePermissions($permissions, $moduleId) {
//   return array_filter($permissions, function($permission) use ($moduleId) {
//       return $permission['module_id'] == $moduleId;
//   });
// }
?>
<?php if(userHasPermission($pdo, $_SESSION["user_id"], 'manage_role')){?>
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Role</h5>
          </div>
          <?php if(userHasPermission($pdo, $_SESSION["user_id"], 'create_role')){?>
          <div class="col">
            <button class="btn btn-primary btn-sm float-end" id="addRoleBTN" data-bs-toggle="modal" data-bs-target="#passModal"><i class="fa-solid fa-plus"></i>&nbsp;Add
              Role</button>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="card-body">
        <table id="roleTable" class="table table-hover table-cs-color">
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade modal-lg" id="passModal" tabindex="-1" aria-labelledby="passModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="passModalLabel">User Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <div class="row gy-2">
          <div class="col-lg-12">
            <label for=role_name" class="form-label">Role Name</label>
            <input type="text" class="form-control" id=role_name" name=role_name" placeholder="Ex. Admin">
          </div>
          <span class="text-black fw-bold">Assign Permissions to Role</span>
          <div class="col-lg-12">
          <table class="table">
            <thead>
              <tr>
              <th><input type="checkbox" class="align-middle checkbox_middle form-check-input" id="checkall_global" onclick="checkAllGlobal(this)"></th>
                <th>Module</th>
                <th>Permissions</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($modules as $module):?>
        <tr>
          <td><input type="checkbox" class="form-check-input module-checkbox" data-module-id="<?= $module['id']; ?>"></td>
          <td class="text-dark fw-semibold"><?= htmlspecialchars($module['module_name']); ?></td>
          <td>
            <div class="row permissions-container" data-module-id="<?= $module['id']; ?>">
              <?php
              // Fetch permissions for the current module from your database
              $permissions = getModulePermissions($pdo, $module['id']);
              ?>
              <?php foreach ($permissions as $permission): ?>
                  <div class="col-md-3">
                      <div class="form-check form-check-inline">
                          <input class="form-check-input permission-checkbox" id="permission<?= $permission['id']; ?>" name="permissions[]" type="checkbox" value="<?= $permission['id']; ?>" data-module-id="<?= $module['id']; ?>">
                          <label for="permission<?= $permission['id']; ?>" class="form-check-label text-dark fw-semibold user-select-none cursor-pointer"><?= htmlspecialchars($permission['description']); ?></label>
                      </div>
                  </div>
              <?php endforeach; ?>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="updateBrand" update-id="">UPDATE</button>
        <button type="button" class="btn btn-primary" id="addBrand">ADD</button>
      </div>
    </div>
  </div>
</div>
<!-- END -->
<script>
$(document).ready( function () {
    var table = $('#roleTable').DataTable({
        responsive: true,
        select: true,
        autoWidth: false,
        ajax:{
            url: 'admin/process/table.php?table_type=roles',
            dataSrc: 'data'
        },
        columns:[
            {data: 'id', visible: false},
            {data: 'role_name', title: 'Role Name'}
            <?php if(userHasPermission($pdo, $_SESSION["user_id"], 'update_role') || userHasPermission($pdo, $_SESSION["user_id"], 'delete_role') ){?>
            ,{"data": null,"className": "text-center", title: 'Action', "defaultContent": "<?php if(userHasPermission($pdo, $_SESSION["user_id"], 'update_role')){ ?><button class='btn btn-primary btn-sm btn-edit'><i class='fa-regular fa-pen-to-square'></i></button>&nbsp;<?php } ?><?php if(userHasPermission($pdo, $_SESSION["user_id"], 'delete_role')){ ?><button class='btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i></button><?php } ?>"}
            <?php } ?>
        ]
    });
    function LoadTable(){
        $.ajax({
            url: 'admin/process/table.php?table_type=roles',
            dataType: 'json',
            success: function(data) {
              table.clear().rows.add(data.data).draw(false); // Update data without redrawing
            
              // Reload the DataTable after a delay (e.g., 1 second) to reflect any changes in the table structure or formatting
              setTimeout(function() {
                  table.ajax.reload(null, false); // Reload the DataTable without resetting current page
              }, 1000); // Adjust delay as needed
            },
            error: function () {
                alert('Failed to retrieve brands.');
            }
        });
    }
    // Handle checking/unchecking all permissions when a module checkbox is clicked
    $('.module-checkbox').on('change', function() {
        var moduleId = $(this).data('module-id');
        var isChecked = $(this).is(':checked');
        
        // Check/uncheck all permissions associated with the module
        $(`.permissions-container[data-module-id="${moduleId}"] .permission-checkbox`).prop('checked', isChecked);
    });

    // Handle checking/unchecking all checkboxes globally
    function checkAllGlobal(source) {
        var isChecked = $(source).is(':checked');
        $('input[type="checkbox"]').prop('checked', isChecked);
    }
    
    $('#checkall_global').on('change', function() {
        checkAllGlobal(this);
    });

    // Function to check/uncheck module checkboxes based on permissions
    function updateModuleCheckbox(moduleId) {
        var allPermissionsChecked = $(`.permissions-container[data-module-id="${moduleId}"] .permission-checkbox`).length === $(`.permissions-container[data-module-id="${moduleId}"] .permission-checkbox:checked`).length;
        $(`.module-checkbox[data-module-id="${moduleId}"]`).prop('checked', allPermissionsChecked);
    }

    // Event handler for when any permission checkbox is changed
    $(document).on('change', '.permission-checkbox', function() {
        var moduleId = $(this).data('module-id');
        updateModuleCheckbox(moduleId);
    });

    // Initial check to ensure modules reflect the state of permissions on page load
    $('.module-checkbox').each(function() {
        var moduleId = $(this).data('module-id');
        updateModuleCheckbox(moduleId);
    });
});
</script>
<?php }else{
  echo '
  <div class="d-flex justify-content-center align-items-center vh-100">
  <div class="container">
      <div class="row">
          <div class="col text-center">
              <iconify-icon icon="maki:caution" width="50" height="50"></iconify-icon>
              <h2 class="fw-bolder">User does not have permission!</h2>
              <p>We are sorry, your account does not have permission to access this page.</p>
          </div>
      </div>
  </div>
</div>
  ';
}?>