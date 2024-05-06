<div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
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
                <table id="myTable" class="table table-hover table-cs-color">
                    <thead>
                        <tr>
                            <th>Unit Type</th>
                            <th>Short Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pieces</td>
                            <td>pcs</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Pack</td>
                            <td>pks</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Box</td>
                            <td>box</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Kilogram</td>
                            <td>kgs</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Set</td>
                            <td>set</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Pair</td>
                            <td>pr</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Serving</td>
                            <td>serving</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Slice</td>
                            <td>slice</td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Ounce</td>
                            <td>oz</td>
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