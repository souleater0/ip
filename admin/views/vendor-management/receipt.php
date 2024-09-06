<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Receipt</h5>
          </div>
          <?php if(userHasPermission($pdo, $_SESSION["user_id"], 'create_brand')){?>
          <div class="col">
            <!-- <button class="btn btn-primary btn-sm float-end" id="addBrandBTN" data-bs-toggle="modal" data-bs-target="#brandModal"><i class="fa-solid fa-plus"></i>&nbsp;Add
              Brand</button> -->
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="card-body">
        <table id="brandTable" class="table table-hover table-cs-color">
        </table>
      </div>
    </div>
  </div>
</div>