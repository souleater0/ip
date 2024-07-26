<?php if(userHasPermission($pdo, $_SESSION["user_id"], 'manage_stockout_history')){?>
<div class="body-wrapper-inner">
    <div class="container-fluid">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent border-bottom">
              <div class="row">
                <div class="col">
                <h5 class="mt-1 mb-0">Stock Out History</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
            <table id="pendingProductTable" class="table table-hover table-cs-color">
            </table>
            </div>
    </div>
  </div>
</div>
<div class="modal fade modal-lg" id="pendingModal" tabindex="-1" aria-labelledby="pendingModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="brandForm">
      <div class="modal-header">
      <div class="row align-items-center">
              <div class="col">
                <h5 class="mt-1 mb-0">Stock Out Number</h5>
              </div>
              <div class="col">
                <input type="text" class="form-control bg-secondary-subtle" id="stockOutNumber" value="" readonly>
              </div>
            </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <table id="itemDetailsTable" class="table table-hover table-cs-color">
        </table>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" id="addInventory" update-id="">STOCK OUT TO INVENTORY</button>
        <button type="button" class="btn bg-secondary-subtle" id="stInventory" disabled>Already Stocked Out</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready( function () {
  $("#stInventory").hide();
  // let table = new DataTable('#myTable');
  var table = $('#pendingProductTable').DataTable({  
      responsive: true,
      select: true,
      autoWidth: false,
      order: [
        [1, "desc"]
      ],
      ajax:{
        url: 'admin/process/table.php?table_type=pending-stockout',
        dataSrc: 'data'
      },
      columns:[
        {data: 'id', visible: false },
        {data: 'series_number', title: 'Series Number'},
        {data: 'date', title: 'Date',className: 'text-start'},
        { 
                "data": "isAdded",
                "render": function(data, type, row, meta) {
                    var statusText;
                    var statusColor;
                    switch (data) {
                        case 0:
                            statusText = "Pending";
                            statusColor = "#FFAF61"; // Orange
                            break;
                        case 1:
                            statusText = "Released from Inventory";
                            statusColor = "#58D68D"; // Green
                            break;
                        default:
                            statusText = "Pending";
                            statusColor = "#FFAF61"; // Orange
                            break;
                    }
                    return '<span class="badge text-white" style="background-color: ' + statusColor + ';">' + statusText + '</span>';
                },
                "title": "Status",
        }
        <?php if(userHasPermission($pdo, $_SESSION["user_id"], 'show_stockout_history') || userHasPermission($pdo, $_SESSION["user_id"], 'delete_stockout_history') ){?>
        ,{ 
            "data": null, 
            "title": "Action", 
            "className":"text-center",
            "render": function(data, type, row) {
                return '<?php if(userHasPermission($pdo, $_SESSION["user_id"], 'show_stockout_history')){ ?><button class="btn btn-info btn-sm btn-show"><i class="fa-solid fa-eye"></i></button>&nbsp;<?php } ?><?php if(userHasPermission($pdo, $_SESSION["user_id"], 'delete_stockout_history')){ ?><button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button><?php } ?>';
            } 
        }
        <?php } ?>
      ]
  });
  function LoadTable(){
      $.ajax({
          url: 'admin/process/table.php?table_type=pending-stockout',
          dataType: 'json',
          success: function(data) {
            table.clear().rows.add(data.data).draw(false); // Update data without redrawing
          
            // Reload the DataTable after a delay (e.g., 1 second) to reflect any changes in the table structure or formatting
            setTimeout(function() {
                table.ajax.reload(null, false); // Reload the DataTable without resetting current page
            }, 1000); // Adjust delay as needed
          },
          error: function () {
              alert('Failed to retrieve stocks.');
          }
      });
  }
  $('#pendingProductTable').on('click', 'button.btn-show', function () {
      var data = table.row($(this).parents('tr')).data();
      if(data.isAdded == 1){
        $("#addInventory").hide();
        $("#stInventory").show();
        
      }else{
        $("#addInventory").show();
        $("#stInventory").hide();
      }
      $("#stockOutNumber").val(data.series_number);
      $("#addInventory").attr("update-id", data.series_number);
      var itemDetailsTable = $('#itemDetailsTable').DataTable({
            destroy: true,
            responsive: true,
            autoWidth: false,
            order: [
              [3, "asc"]
            ],
            ajax: {
                url: 'admin/process/table.php?table_type=item-details-stockout&series_number=' + data.series_number,
                dataSrc: 'data'
            },
            columns: [
                { data: 'product_name', title: 'Product Name' },
                { data: 'item_barcode', title: 'Item Barcode' ,className: 'text-center' },
                { data: 'quantity', title: 'item_qty',className: 'text-center'},
                { data: 'item_expiry', title: 'item_expiry' ,className: 'text-start'}
            ]
        });
      $('#pendingModal').modal('show');
  });
  $('#addInventory').click(function(){
      var update_id = $(this).attr("update-id");
      //alert(update_id);    
      $.ajax({
            url: "admin/process/admin_action.php",
            method: "POST",
            data: {
              action: "addtoInventory",
              series_number: update_id
            },
            dataType: "json",
            success: function(response) {
                if(response.success==true){
                    LoadTable();
                    $('#pendingModal').modal('hide');
                    toastr.success(response.message);
                }else{
                    toastr.error(response.message);
                }
            }
        });
    });
  // addtoInventory
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