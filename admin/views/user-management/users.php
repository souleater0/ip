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
            <button class="btn btn-primary btn-sm float-end" id="addUserBTN" data-bs-toggle="modal" data-bs-target="#userModal"><i class="fa-solid fa-plus"></i>&nbsp;Add
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
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="userForm">
      <div class="modal-header">
        <h1 class="modal-title fs-5 user-select-none" id="userModalLabel">User Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <div class="row gy-2">
          <div class="col-lg-12">
            <label for="user_display" class="form-label user-select-none">Display Name</label>
            <input type="text" class="form-control" id="user_display" name="user_display" placeholder="Ex. Juan Dela Cruz">
          </div>  
          <div class="col-lg-12">
            <label for="username" class="form-label user-select-none">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Ex. Juan">
          </div>
          <div class="col-lg-12">
            <label for="user_role" class="form-label user-select-none">Roles</label>
            <select class="selectpicker form-control" id="user_role" name="user_role" data-live-search="true">
            <option value="" disabled>Select Role</option>
              <?php foreach ($roles as $role):?>
                <option value="<?php echo $role['id'];?>"><?php echo $role['role_name'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-lg-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="loginEnabled" name="loginEnabled">
                <label class="form-check-label user-select-none" for="loginEnabled">Login is enabled</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="updateUser" update-id="">UPDATE</button>
        <button type="button" class="btn btn-primary" id="addUser">ADD</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END -->

<!-- Modal -->
<div class="modal fade" id="passModal" tabindex="-1" aria-labelledby="passModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="passModalLabel">Password Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <div class="row gy-2">
          <div class="col-lg-12">
            <label for="user_password" class="form-label user-select-none">New Password</label>
            <div class="d-flex">
            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="" autocomplete="password">
            <button type="button" class="btn btn-info" id="show_Pass"><i class="fa-solid fa-eye"></i></button>
            </div>
          </div>
          <div class="col-lg-12">
            <label for="user_conpass" class="form-label user-select-none">Confirm Password</label>
            <div class="d-flex">
            <input type="password" class="form-control" id="user_conpass" name="user_conpass" placeholder="" autocomplete="new-password">
            <button type="button" class="btn btn-info" id="show_Pass2"><i class="fa-solid fa-eye"></i></button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="updatePassword" update-id="">Update Password</button>
      </div>
    </div>
  </div>
</div>
<!-- END -->
<script>
$(document).ready(function() {
  var table = $('#userTable').DataTable({
      responsive: true,
      select: true,
      autoWidth: false,
      ajax:{
        url: 'admin/process/table.php?table_type=users',
        dataSrc: 'data'
      },
      columns:[
        {data: 'id', visible: false},
        {data: 'display_name', title: 'Display Name'},
        {data: 'username', title: 'Username'},
        {data: 'role_id', visible: false},
        {data: 'role_name', title: 'Role'},
        {data: 'isEnabled', visible: false},
        {data: 'status', title: 'Status'},
        {"data": null, title: 'Action', "defaultContent": "<button class='btn btn-primary btn-sm btn-edit'><i class='fa-regular fa-pen-to-square'></i></button>&nbsp;<button class='btn btn-secondary btn-sm btn-pass'><i class='fa-solid fa-key'></i></button>&nbsp;<button class='btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i></button>"}
      ]
  });
  $('#addUserBTN').click(function(){
      $('#user_display').val('');
      $('#username').val('');
      $('#user_role').val('1');
      $('#user_role').selectpicker('refresh');
      $("#loginEnabled").prop('checked', false);

      $('#addUser').show();
      $('#updateUser').hide();
  });
  $('#addUser').click(function(){
    var formData = $('#userForm').serialize();
    //alert(formData);
    $.ajax({
        url: "admin/process/admin_action.php",
        method: "POST",
        data: formData+"&action=addUser",
        dataType: "json",
        success: function(response) {
            if(response.success==true){
                //LoadTable();
                $('#userModal').modal('hide');
                toastr.success(response.message);
            }else{
                toastr.error(response.message);
            }
        }
    });
  });
  $('#userTable').on('click', 'button.btn-pass', function () {
    var data = table.row($(this).parents('tr')).data();
    $('#passModal').modal('show');
    var update_id = $(this).attr("update-id");
    $("#updatePassword").attr("update-id", data.id);
  });
  $('#userTable').on('click', 'button.btn-edit', function () {
    var data = table.row($(this).parents('tr')).data();
    // // Populate modal with data
    $('#user_display').val(data.display_name);
    $('#username').val(data.username);
    $('#user_role').val(data.role_id);
    $('#user_role').selectpicker('refresh');

    if(data.isEnabled == "0"){
      $("#loginEnabled").prop('checked', false);
    }else{
      $("#loginEnabled").prop('checked', true);
    }
    
    $('#addUser').hide();
    $('#updateUser').show();

    $('#userModal').modal('show');
    var update_id = $(this).attr("update-id");
    $("#updateUser").attr("update-id", data.id);
  });
  //show pass
  $("#show_Pass").click(function (event) {
    event.preventDefault();
    var icon = $("#show_Pass svg");
    if($("#user_password").attr("type")=="password")
    {
      //$("#show_Pass").text('HIDE');
      $("#user_password").attr('type','text');
      icon.removeClass("fa-eye").addClass("fa-eye-slash");
    }else{
      //$("#show_Pass").text('SHOW');
      $("#user_password").attr('type','password');
      icon.removeClass("fa-eye-slash").addClass("fa-eye");
    }
  });
  $("#show_Pass2").click(function (event) {
    event.preventDefault();
    var icon = $("#show_Pass2 svg");
    if($("#user_conpass").attr("type")=="password")
    {
      //$("#show_Pass2").text('HIDE');
      $("#user_conpass").attr('type','text');
      icon.removeClass("fa-eye").addClass("fa-eye-slash");
    }else{
      //$("#show_Pass2").text('SHOW');
      $("#user_conpass").attr('type','password');
      icon.removeClass("fa-eye-slash").addClass("fa-eye");
    }
  });
  //submit password
  $('#updatePassword').click(function(){
    var password = $("#user_password").val();
    var con_password = $("#user_conpass").val();

    var update_id = $(this).attr("update-id");

    if(password == con_password){
      $.ajax({
          url: "admin/process/admin_action.php",
          method: "POST",
          data: {
            password : password,
            c_password : con_password,
            update_id : update_id,
            action : "updateUserPassword"
          },
          dataType: "json",
          success: function(response) {
              if(response.success==true){
                  //LoadTable();
                  $('#passModal').modal('hide');
                  toastr.success(response.message);
              }else{
                  toastr.error(response.message);
              }
          }
      });
    }else
    {
      toastr.error("Password Doesn't Match!");
    }

  });
});
</script>