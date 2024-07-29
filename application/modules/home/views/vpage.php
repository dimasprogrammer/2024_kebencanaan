<div class="container-fluid">

  <!-- Section: Intro -->
  <section class="mt-md-4 pt-md-2 mb-5 pb-4">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">

        <!-- Card -->
        <div class="card card-cascade cascading-admin-card">

          <!-- Card Data -->
          <div class="admin-up">
            <i class="fas fa-chart-line primary-color mr-3 z-depth-2"></i>
            <div class="data">
              <p class="text-uppercase">TOTAL BENCANA</p>
              <h4 class="font-weight-bold dark-grey-text">100</h4>
            </div>
          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade">
            <div class="progress mb-3">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="card-text black-text">Data Bencana Keseluruhan</p>
          </div>

        </div>
        <!-- Card -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">

        <!-- Card -->
        <div class="card card-cascade cascading-admin-card">

          <!-- Card Data -->
          <div class="admin-up">
            <i class="fas fa-procedures danger-color mr-3 z-depth-2"></i>
            <div class="data">
              <p class="text-uppercase">TOTAL KORBAN</p>
              <h4 class="font-weight-bold dark-grey-text">200</h4>
            </div>
          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade">
            <div class="progress mb-3">
              <div class="progress-bar red accent-2" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="card-text black-text">Data Korban Bencana Keseluruhan</p>
          </div>

        </div>
        <!-- Card -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-md-0 mb-4">

        <!-- Card -->
        <div class="card card-cascade cascading-admin-card">

          <!-- Card Data -->
          <div class="admin-up">
            <i class="	fas fa-building light-blue lighten-1 mr-3 z-depth-2"></i>
            <div class="data">
              <p class="text-uppercase">TOTAL KERUSAKAN</p>
              <h4 class="font-weight-bold dark-grey-text">20000</h4>
            </div>
          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade">
            <div class="progress mb-3">
              <div class="progress-bar red accent-2" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="card-text black-text">Data Kerusakan Bencana Keseluruhan</p>
          </div>

        </div>
        <!-- Card -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-0">

        <!-- Card -->
        <div class="card card-cascade cascading-admin-card">

          <!-- Card Data -->
          <div class="admin-up">
            <i class="fas fa-clipboard danger-color mr-3 z-depth-2"></i>
            <div class="data">
              <p class="text-uppercase">TOTAL TAKSIRAN KERUGIAN</p>
              <h4 class="font-weight-bold dark-grey-text"><?php echo convert_to_rupiah(200000000); ?></h4>
            </div>
          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade">
            <div class="progress mb-3">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="card-text black-text">Data Taksiran Kerugian Keseluruhan</p>
          </div>

        </div>
        <!-- Card -->

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->
    <!-- Card -->
    <div class="card card-cascade narrower">
      <br>

      <div class="card card-cascade narrower z-depth-0">

        <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

          <div>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-th-large mt-0"></i></button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-columns mt-0"></i></button>
          </div>

          <a href="" class="white-text mx-3">DATA KESELURUHAN BENCANA SUMATERA BARAT</a>

          <div>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-pencil-alt mt-0"></i></button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-eraser mt-0"></i></button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-info-circle mt-0"></i></button>
          </div>

        </div>

        <div class="px-4">

          <div class="table-responsive">

            <!--Table-->
            <table cellspacing="0" class="table table-hover mb-0 " id="tblList">

              <!-- Table head -->
              <thead>
                <tr>
                  <th width="7%"><a>No <i class="fas fa-sort ml-1"></i></a></th>
                  <th width="15%"><a>Tanggal Bencana<i class="fas fa-sort ml-1"></i></a></th>
                  <th width="15%"><a>Jenis Bencana<i class="fas fa-sort ml-1"></i></a></th>
                  <th width="25%"><a>Nama Bencana<i class="fas fa-sort ml-1"></i></a></th>
                  <th width="30%"><a>Kabupaten/Kota<i class="fas fa-sort ml-1"></i></a></th>
                </tr>
              </thead>
              <!-- Table head -->
            </table>
            <!-- Table -->

          </div>
        </div>

      </div>


    </div>
    <!-- Card -->
  </section>
  <!-- Section: Intro -->


</div>