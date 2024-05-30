<div class="body-wrapper-inner">
        <div class="container-fluid">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                  <div class="row">
                    <div class="col">
                    <h5 class="mt-1 mb-0">Pending Inventory</h5>
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
<div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="brandForm">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="pendingModal">Item Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <div class="row gy-2">
          <div class="col-lg-12">
          <label for="brand_name" class="form-label">Brand Name</label>
          <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Ex. Nescafe">
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
<script>
$(document).ready( function () {
  // let table = new DataTable('#myTable');
  var table = $('#pendingProductTable').DataTable({  
      responsive: true,
      select: true,
      autoWidth: false,
      ajax:{
        url: 'admin/process/table.php?table_type=stock-history',
        dataSrc: 'data'
      },
      columns:[
        {data: 'id', visible: false },
        {data: 'series_number', title: 'Series Number'},
        {data: 'date', title: 'Date',className: 'text-start'},
        { 
            "data": null, 
            "title": "Action", 
            "render": function(data, type, row) {
                return '<button class="btn btn-info btn-sm btn-show"><i class="fa-solid fa-eye"></i></button>&nbsp;<button class="btn btn-primary btn-sm btn-edit"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>';
            } 
          }
      ]
  });
  function LoadTable(){
      $.ajax({
          url: 'admin/process/table.php?table_type=brand',
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
  $('#pendingProductTable').on('click', 'button.btn-show', function () {
      var data = table.row($(this).parents('tr')).data();
      var itemDetailsTable = $('#itemDetailsTable').DataTable({
            destroy: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: 'admin/process/table.php?table_type=item-details&series_number=' + data.series_number,
                dataSrc: 'data'
            },
            columns: [
                { data: 'item_id', title: 'Item ID' },
                { data: 'item_name', title: 'Item Name' },
                { data: 'quantity', title: 'Quantity' },
                { data: 'price', title: 'Price' }
            ]
        });
      $('#pendingModal').modal('show');
      // var update_id = $(this).attr("update-id");
      // $("#updateBrand").attr("update-id", data.brand_id);
  });
});
</script>