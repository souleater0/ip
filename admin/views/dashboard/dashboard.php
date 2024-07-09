<?php if(userHasPermission($pdo, $_SESSION["user_id"], 'Manage Dashboard')){?>
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <!-- card -->
                <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                        <span
                          class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                          <iconify-icon icon="mdi:cart" class="fs-6 text-primary"> </iconify-icon>
                        </span>
                        <h6 class="mb-0 fs-4 text-uppercase">total products</h6>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h4>225</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- card-end -->
            </div>
            <div class="col-lg-4">
                <!-- card -->
                <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                        <span
                          class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                          <iconify-icon icon="vaadin:stock" class="fs-6 text-primary"> </iconify-icon>
                        </span>
                        <h6 class="mb-0 fs-4 text-uppercase">low on stock</h6>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h4>5</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- card-end -->
            </div>
            <div class="col-lg-4">
                <!-- card -->
                <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                        <span
                          class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                          <iconify-icon icon="healthicons:rdt-result-out-stock" class="fs-6 text-primary"> </iconify-icon>
                        </span>
                        <h6 class="mb-0 fs-4 text-uppercase">out of stock</h6>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h4>10</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- card-end -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Expiring Soon</h5>
                  <div class="table-responsive" data-simplebar>
                  <table id="productExpiringTable" class="table table-hover table-cs-color">
                  </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Low on Stocks</h5>
                  <div class="table-responsive" data-simplebar>
                    <table class="table text-nowrap align-middle table-custom mb-0">
                      <thead>
                        <tr>
                          <th scope="col" class="text-dark fw-normal ps-0">Product Name
                          </th>
                          <th scope="col" class="text-dark fw-normal">Status</th>
                          <th scope="col" class="text-dark fw-normal">Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center gap-6">
                              <div>
                                <h6 class="mb-0">Dutch Mill</h6>
                                <span>Yoghurt Drink</span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="badge text-white" style="background-color: #FFBE08;">Low Stocks</span>
                          </td>
                          <td>
                            <span class="text-dark">5</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Out of Stock</h5>
                  <div class="table-responsive" data-simplebar>
                    <table class="table text-nowrap align-middle table-custom mb-0">
                      <thead>
                        <tr>
                          <th scope="col" class="text-dark fw-normal ps-0">Product Name
                          </th>
                          <th scope="col" class="text-dark fw-normal">Status</th>
                          <th scope="col" class="text-dark fw-normal">Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center gap-6">
                              <div>
                                <h6 class="mb-0">Milo</h6>
                                <span>Nestle</span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="badge text-white" style="background-color: #FF0808;">Out of Stock</span>
                          </td>
                          <td>
                            <span class="text-dark">0</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Location</h5>
                        <div class="table-responsive" data-simplebar>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Recently Added Products</h5>
                  <div class="table-responsive" data-simplebar>
                    <table class="table text-nowrap align-middle table-custom mb-0">
                      <thead>
                        <tr>
                          <th scope="col" class="text-dark fw-normal ps-0">Product Name
                          </th>
                          <th scope="col" class="text-dark fw-normal">Date Added</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center gap-6">
                              <div>
                                <h6 class="mb-0">Milo</h6>
                                <span>Nestle</span>
                              </div>
                            </div>
                          </td>
                          <td>
                            2024-04-04
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<script>
  $(document).ready( function () {
    var table = $('#productExpiringTable').DataTable({
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        order: [[2, 'asc']],
        paging: true,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 300,
        responsive: true,
        autoWidth: false,
        ajax:{
          url: 'admin/process/table.php?table_type=expiring_soon',
          dataSrc: 'data'
        },
        columns:[
          {data: 'item_id', visible: false},
          {data: 'product_id', visible: false},
          {data: 'item_sku', title: 'SKU'},
          {data: 'product_name', title: 'Product Name'},
          {data: 'item_expiry', title: 'Expiry Date', className: 'text-center'},
          {data: 'expiry_notice', title: 'Expiry Notice', className: 'text-center'},
          {data: 'days_to_expiry', title: 'Remaining Days', className: 'text-center'},
          { 
                "data": "item_qty",
                "render": function(data, type, row, meta) {
                    return '<span class="badge bg-secondary">' + data + '</span>';
                },
                "title": "QTY",
                "className": "text-center"
          },
          { 
            "data": null, 
            "title": "Action", 
            "render": function(data, type, row) {
                return '<a class="btn btn-info btn-sm" href="index.php?route=view-product&product=' + row.product_id + '"><i class="fa-solid fa-eye"></i></a>';
            } 
          }
        ]
    });
    function getExpiringSoon(){
      $.ajax({
            url: 'admin/process/table.php?table_type=expiring_soon',
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
  });
        var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#00D9E9', '#FF66C3', '#FFD466'];
        var options = {
          series: [{
            name: 'Product',
          data: [225, 50, 10, 30]
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: [
            'Snack Bar',
            'EC Cafe',
            'Marketing',
            'Eskina'
          ],
          labels: {
            style: {
              colors: colors,
              fontSize: '12px'
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
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
}
?>