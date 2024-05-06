<div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                  <div class="row">
                    <div class="col">
                    <h5 class="mt-1 mb-0">Manage Brand</h5>
                    </div>
                  <div class="col">
                  <button class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-plus"></i>&nbsp;Add Brand</button>
                  </div>
                  
                  </div>

                </div>
                <div class="card-body">
                <table id="myTable" class="table table-hover table-cs-color">
                    <thead>
                        <tr>
                            <th>Brand Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Samsung</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Apple</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Nescafe</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>YTS Quality</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Century Pacific Food</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
<script>
  $(document).ready( function () {
    // let table = new DataTable('#myTable');
    $('#myTable').DataTable( {
    responsive: true,
    select: true
  });
  });
</script>