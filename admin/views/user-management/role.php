<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Role</h5>
          </div>
          <div class="col">
            <button class="btn btn-primary btn-sm float-end" id="addRoleBTN" data-bs-toggle="modal" data-bs-target="#roleModal"><i class="fa-solid fa-plus"></i>&nbsp;Add
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