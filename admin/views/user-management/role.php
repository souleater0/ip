<?php 
$modules = getModules($pdo);
$permissions = getModulePermissions($pdom ,$moduleId);
// function getModulePermissions($permissions, $moduleId) {
//   return array_filter($permissions, function($permission) use ($moduleId) {
//       return $permission['module_id'] == $moduleId;
//   });
// }
?>
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Role</h5>
          </div>
          <div class="col">
            <button class="btn btn-primary btn-sm float-end" id="addRoleBTN" data-bs-toggle="modal" data-bs-target="#passModal"><i class="fa-solid fa-plus"></i>&nbsp;Add
              Role</button>
          </div>
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
                <th><input type="checkbox" class="align-middle checkbox_middle form-check-input" name="checkall" id="checkall"></th>
                <th>Module</th>
                <th>Permissions</th>
              </tr>
            </thead>
            <tbody class="">
              <!-- <tr>
                <td><input type="checkbox" class="align-middle checkbox_middle form-check-input" name="checkall" id="checkall"></td>
                <td class="text-black">Product Management</td>
                <td>
                  <div class="row">
                    <div class="col-md-3">
                      <input class="form-check-input isscheck isscheck_User" id="permission1"  name="permissions[]" type="checkbox" value="1">
                      <label for="permission1" class="form-label font-weight-500">Manage</label>
                    </div>
                    <div class="col-md-3">
                      <input class="form-check-input isscheck isscheck_User" id="permission2" checked="checked" name="permissions[]" type="checkbox" value="1">
                      <label for="permission1" class="form-label font-weight-500">Create</label>
                    </div>
                    <div class="col-md-3">
                      <input class="form-check-input isscheck isscheck_User" id="permission3" name="permissions[]" type="checkbox" value="1">
                      <label for="permission1" class="form-label font-weight-500">Edit</label>
                    </div>
                    <div class="col-md-3">
                      <input class="form-check-input isscheck isscheck_User" id="permission4" checked="checked" name="permissions[]" type="checkbox" value="1">
                      <label for="permission1" class="form-label font-weight-500">Delete</label>
                    </div>
                  </div>
                </td> 
              </tr>-->
              <?php foreach($modules as $module):?>
                <tr>
                  <td><input type="checkbox" class="align-middle checkbox_middle form-check-input" name="checkall" id="checkall"></td>
                  <td class="text-black"><?= htmlspecialchars($module['module_name']); ?></td>
                  <td>
                    <div class="row">
                    <?php foreach ($permissions as $permission): ?>

                            <div class="col-md-4">
                                <input class="form-check-input isscheck isscheck_User" id="<?= $permission['id']; ?>" name="permissions[]" type="checkbox" value="<?= $permission['id']; ?>">
                                <label for="<?= $permission['id']; ?>" class="form-label font-weight-500"><?= htmlspecialchars($permission['permission_name']); ?></label>
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
            {data: 'role_name', title: 'Role Name'},
            {"data": null, title: 'Action', "defaultContent": "<button class='btn btn-primary btn-sm btn-edit'><i class='fa-regular fa-pen-to-square'></i></button>&nbsp;<button class='btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i></button>"}
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
});
</script>