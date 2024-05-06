<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Category</h5>
          </div>
          <div class="col">
            <button class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-plus"></i>&nbsp;Add Category</button>
          </div>

        </div>

      </div>
      <div class="card-body">
        <table id="myTable" class="table table-hover table-cs-color">
          <thead>
            <tr>
              <th>Category Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Shampoo</td>
              <td><button class="btn btn-primary btn-sm"><i
                    class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i
                    class="fa-solid fa-trash"></i></button></td>
            </tr>
            <tr>
              <td>Party Supplies</td>
              <td><button class="btn btn-primary btn-sm"><i
                    class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i
                    class="fa-solid fa-trash"></i></button></td>
            </tr>
            <tr>
              <td>Food & Beverages</td>
              <td><button class="btn btn-primary btn-sm"><i
                    class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i
                    class="fa-solid fa-trash"></i></button></td>
            </tr>
            <tr>
              <td>Electronics</td>
              <td><button class="btn btn-primary btn-sm"><i
                    class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i
                    class="fa-solid fa-trash"></i></button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    // let table = new DataTable('#myTable');
    $('#myTable').DataTable({
      responsive: true,
    select: true,
    autoWidth: false
    });
  });
</script>