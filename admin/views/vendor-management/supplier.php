<div class="body-wrapper-inner">
    <div class="container-fluid">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent border-bottom">
              <div class="row">
                <div class="col">
                <h5 class="mt-1 mb-0">Manage Supplier</h5>
                </div>
                <div class="col">
                <button class="btn btn-sm float-end" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <iconify-icon icon="rivet-icons:filter" width="20" height="20"></iconify-icon>
                </button>
                <button class="btn btn-primary btn-sm float-end" id="addCategoryBTN" data-bs-toggle="modal" data-bs-target="#supplierModal"><i class="fa-solid fa-plus"></i>&nbsp;Add Supplier</button>
                <ul class="dropdown-menu p-3">
                    <div class="fw-bolder text-dark">Hide Column:</div>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault0" data-column="0">
                        <label class="form-check-label text-dark" for="flexCheckDefault0">
                        ID
                        </label>
                        </div>
                    </li>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault2" data-column="2" checked>
                        <label class="form-check-label text-dark" for="flexCheckDefault2">
                        Company
                        </label>
                        </div>
                    </li>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault1" data-column="1" checked>
                        <label class="form-check-label text-dark" for="flexCheckDefault1">
                        Supplier
                        </label>
                        </div>
                    </li>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault3" data-column="3" checked>
                        <label class="form-check-label text-dark" for="flexCheckDefault3">
                        Address
                        </label>
                        </div>
                    </li>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault4" data-column="4" checked>
                        <label class="form-check-label text-dark" for="flexCheckDefault4">
                        Contact
                        </label>
                        </div>
                    </li>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault5" data-column="5" checked>
                        <label class="form-check-label text-dark" for="flexCheckDefault5">
                        Email
                        </label>
                        </div>
                    </li>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault6" data-column="6" checked>
                        <label class="form-check-label text-dark" for="flexCheckDefault6">
                        Status
                        </label>
                        </div>
                    </li>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault7" data-column="7">
                        <label class="form-check-label text-dark" for="flexCheckDefault7">
                        Created At
                        </label>
                        </div>
                    </li>
                    <li><div class="form-check">
                        <input class="form-check-input toggle-vis" type="checkbox" value="" id="flexCheckDefault8" data-column="8">
                        <label class="form-check-label text-dark" for="flexCheckDefault8">
                        Updated At
                        </label>
                        </div>
                    </li>
                </ul>

                </div>
              </div>
            </div>
            <div class="card-body">
            <table id="supplierTable" class="table table-hover table-cs-color">
            </table>
            </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="categoryForm">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="supplierModalLabel">Supplier Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <div class="row gy-2">
          <div class="col-lg-12">
            <label for="mainCategory" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="mainCategory" name="ven_company" placeholder="Ex. Company A">
          </div>
          <div class="col-lg-12">
            <label for="mainCategory" class="form-label">Supplier Name</label>
            <input type="text" class="form-control" id="mainCategory" name="ven_company" placeholder="Ex. Supplier A">
          </div>
          <div class="col-lg-12">
            <label for="mainCategory" class="form-label">Address</label>
            <input type="email" class="form-control" id="mainCategory" name="ven_address" placeholder="">
          </div>
          <div class="col-lg-12">
            <label for="mainCategory" class="form-label">Contact No. (Optional)</label>
            <input type="text" class="form-control" id="mainCategory" name="ven_contact" placeholder="">
          </div>
          <div class="col-lg-12">
            <label for="mainCategory" class="form-label">Email (Optional)</label>
            <input type="text" class="form-control" id="mainCategory" name="ven_email" placeholder="">
          </div>
          <div class="col-lg-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="loginEnabled" name="loginEnabled">
                <label class="form-check-label user-select-none" for="loginEnabled">Active</label>
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" id="updateCategory" update-id="">UPDATE</button>
        <button type="button" class="btn btn-primary" id="addCategory">ADD</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END -->

<script>
$(document).ready( function () {
    var table = $('#supplierTable').DataTable({
        responsive: true,
        select: true,
        autoWidth: false,
        ajax:{
          url: 'admin/process/table.php?table_type=supplier-list',
          dataSrc: 'data'
        },
        columns:[
          {data: 'id', visible: false},
          {data: 'vendor_company', title: 'Company', className: 'text-start', visible: false},
          {data: 'vendor_name', title: 'Supplier Name', visible: false},
          {data: 'vendor_address', title: 'Address', className: 'text-start', visible: false},
          {data: 'vendor_contact', title: 'Contact No.', className: 'text-start', visible: false},
          {
            data: 'vendor_email',
            title: 'Email',
            className: 'text-start',
            visible: true, // Set this to true to make the column visible
            render: function(data, type, row, meta) {
                if (data) {
                    return `${data} <a href="mailto:${data}">
                                <iconify-icon icon="ic:outline-email" width="20" height="20"></iconify-icon>
                            </a>`;
                } else {
                    return ''; // Handle case when email is not available
                }
            }
          },
          {
                "data": "status",
                "render": function(data, type, row, meta) {
                  if (data == 0) {
                      return '<span class="badge bg-danger">Not Active</span>';
                  } else {
                      return '<span class="badge bg-success">Active</span>';
                  }
                },
                "title": "Status",
                "className": "text-center", 
                "visible": false
          },
          {data: 'created_at', title: 'Date Created', className: 'text-start', visible: false},
          {data: 'updated_at', title: 'Date Updated', className: 'text-start', visible: false}
          <?php if(userHasPermission($pdo, $_SESSION["user_id"], 'update_category') || userHasPermission($pdo, $_SESSION["user_id"], 'delete_category') ){?>
          ,{"data": null,"className": "text-center", title: 'Action', "defaultContent": "<?php if(userHasPermission($pdo, $_SESSION["user_id"], 'update_category')){ ?><button class='btn btn-primary btn-sm btn-edit'><i class='fa-regular fa-pen-to-square'></i></button>&nbsp;<?php } ?><?php if(userHasPermission($pdo, $_SESSION["user_id"], 'delete_category')){ ?><button class='btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i></button><?php } ?>"}
          <?php } ?>
        ]
    });
    function updateColumnVisibility() {
        $('input.toggle-vis').each(function() {
            let columnIdx = $(this).data('column');
            let column = table.column(columnIdx);
            // Set column visibility based on checkbox state
            column.visible($(this).is(':checked'));
        });
    }

    // // Initial column visibility update based on checkbox states
    updateColumnVisibility();
    $('input.toggle-vis').on('change', function() { 
        updateColumnVisibility();
    });
    // document.querySelectorAll('input.toggle-vis').forEach((el) => {
    //     el.addEventListener('click', function (e) {
    //         // e.preventDefault();
    
    //         let columnIdx = e.target.getAttribute('data-column');
    //         let column = table.column(columnIdx);
    
    //         // Toggle the visibility
    //         column.visible(!column.visible());
    //     });
    // });

});
</script>