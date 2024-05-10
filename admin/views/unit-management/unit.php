<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Unit</h5>
          </div>
          <div class="col">
            <button class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-plus"></i>&nbsp;Add Unit</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table id="unitTable" class="table table-hover table-cs-color">
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready( function () {
    var table = $('#unitTable').DataTable({
        responsive: true,
        select: true,
        autoWidth: false,
        ajax:{
          url: 'admin/process/table.php?table_type=unit',
          dataSrc: 'data'
        },
        columns:[
          {data: 'unit_id', visible: false},
          {data: 'unit_type', title: 'Unit Name'},
          {data: 'short_name', title: 'Prefix'},
          {"data": null, title: 'Action', "defaultContent": "<button class='btn btn-primary btn-sm btn-edit'><i class='fa-regular fa-pen-to-square'></i></button>&nbsp;<button class='btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i></button>"}
        ]
    });
  });
</script>