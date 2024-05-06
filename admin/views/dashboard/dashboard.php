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
                                <h6 class="mb-0">Dutch Mill</h6>
                                <span>Yoghurt Drink</span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="badge text-white" style="background-color: #FF0808;">Low Stocks</span>
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
          </div>
    </div>
</div>
<script>
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