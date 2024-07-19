<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Waste</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive" data-simplebar>
          <table id="wasteTable" class="table table-hover table-cs-color">
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="wasteModal" tabindex="-1" aria-labelledby="wasteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="wasteModalLabel">Waste Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <form id="wasteForm">  
          <div class="mb-3">
            <label for="waste_reason" class="form-label">Waste Reason</label>
            <textarea class="form-control" id="waste_reason" name="waste_reason" readonly></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready( function () {
  var table = $('#wasteTable').DataTable({
        order: [[4, 'asc']],
        paging: true,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 300,
        responsive: true,
        autoWidth: false,
        ajax:{
          url: 'admin/process/table.php?table_type=waste',
          dataSrc: 'data'
        },
        columns:[
          {data: 'waste_id', visible: false},
          {data: 'product_sku', title: 'Product SKU', className: 'text-start'},
          {data: 'product_name', title: 'Product Name'},
          {data: 'product_pp', title: 'Product Price', className: 'text-center'},
          {data: 'category_name', title: 'Category Name'},
          {data: 'item_barcode', title: 'Item Barcode'},
          {data: 'item_qty', title: 'QTY',className: 'text-center'},
          {data: 'item_expiry', title: 'Expiry Date',className: 'text-center'},
          {data: 'waste_reason', visible: false},
          {data: 'created_at', title: 'Waste Date',className: 'text-center'},
          { 
            "data": null, 
            "title": "Action",
            "className" : "text-center",
            "render": function(data, type, row) {
                return '<button class="btn btn-primary btn-sm btn-show"><i class="fa-solid fa-eye"></i></button>';
            } 
          }
        ]
    });
    $('#wasteTable').on('click', 'button.btn-show', function () {
      var data = table.row($(this).parents('tr')).data();
      var wasteReason = data.waste_reason;
      $('#waste_reason').val(wasteReason);
      $('#wasteModal').modal('show');
    });
});
</script>