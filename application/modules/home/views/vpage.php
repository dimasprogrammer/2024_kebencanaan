<div class="container-fluid">

  <!-- Section: Intro -->
  <section class="mt-md-4 pt-md-2 mb-5 pb-4">
    <!-- Grid row 1-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">

        <!-- Panel -->
        <div class="card">

          <h4 class="ml-4 mt-2 mb-2 font-weight-bold black-text">
            Longsor / Terban
          </h4>

          <!-- Card Data -->
          <div class="row mt-1">

            <div class="col-md-5 col-5 text-left pl-4">
              <img class="btn-floating" style="width: 70%; height: auto;" src="<?php echo base_url('assets/img/longsor.png'); ?>" alt="">
            </div>


            <div class="col-md-7 col-7 text-right pr-5">

              <h1 class="ml-4 mt-2 mb-2 font-weight-bold red-text">
                <?php $longsor = $longsor['total_longsor'];
                echo isset($longsor) ? $longsor : 0; ?>
              </h1>

              <p class="font-small grey-text">Total Kejadian</p>
            </div>

          </div>
          <!-- Card Data -->

          <!-- Card Data -->

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">

        <!-- Panel -->
        <div class="card">

          <h4 class="ml-4 mt-2 mb-2 font-weight-bold black-text">
            Banjir
          </h4>

          <!-- Card Data -->
          <div class="row mt-1">

            <div class="col-md-5 col-5 text-left pl-4">
              <img class="btn-floating" style="width: 70%; height: auto;" src="<?php echo base_url('assets/img/banjir.png'); ?>" alt="">
            </div>

            <div class="col-md-7 col-7 text-right pr-5">

              <h1 class="ml-4 mt-2 mb-2 font-weight-bold red-text">
                <?php $banjir = $banjir['total_banjir'];
                echo isset($banjir) ? $banjir : 0; ?>
              </h1>

              <p class="font-small grey-text">Total Kejadian</p>
            </div>

          </div>
          <!-- Card Data -->

          <!-- Card Data -->

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">

        <!-- Panel -->
        <div class="card">

          <h4 class="ml-4 mt-2 mb-2 font-weight-bold black-text">
            Kebakaran
          </h4>

          <!-- Card Data -->
          <div class="row mt-1">

            <div class="col-md-5 col-5 text-left pl-4">
              <img class="btn-floating" style="width: 70%; height: auto;" src="<?php echo base_url('assets/img/kebakaran.png'); ?>" alt="">
            </div>

            <div class="col-md-7 col-7 text-right pr-5">

              <h1 class="ml-4 mt-2 mb-2 font-weight-bold red-text">
                <?php $kebakaran = $kebakaran['total_kebakaran'];
                echo isset($kebakaran) ? $kebakaran : 0; ?>
              </h1>

              <p class="font-small grey-text">Total Kejadian</p>
            </div>

          </div>
          <!-- Card Data -->

          <!-- Card Data -->

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">

        <!-- Panel -->
        <div class="card">

          <h4 class="ml-4 mt-2 mb-2 font-weight-bold black-text">
            Cuaca Extrim
          </h4>

          <!-- Card Data -->
          <div class="row mt-1">

            <div class="col-md-5 col-5 text-left pl-4">
              <img class="btn-floating" style="width: 70%; height: auto;" src="<?php echo base_url('assets/img/cuacaextrim.png'); ?>" alt="">
            </div>

            <div class="col-md-7 col-7 text-right pr-5">

              <h1 class="ml-4 mt-2 mb-2 font-weight-bold red-text"><?php $cuaca = $cuaca['total_cuaca'];
                                                                    echo isset($cuaca) ? $cuaca : 0; ?></h1>

              <p class="font-small grey-text">Total Kejadian</p>
            </div>

          </div>
          <!-- Card Data -->

          <!-- Card Data -->

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row 1-->

    <!-- Grid row 2-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">

        <!-- Panel -->
        <div class="card">

          <h4 class="ml-4 mt-2 mb-2 font-weight-bold black-text">
            Erupsi Gunung Berapi
          </h4>

          <!-- Card Data -->
          <div class="row mt-1">

            <div class="col-md-5 col-5 text-left pl-4">
              <img class="btn-floating" style="width: 70%; height: auto;" src="<?php echo base_url('assets/img/gunungmeletus.png'); ?>" alt="">
            </div>

            <div class="col-md-7 col-7 text-right pr-5">

              <h1 class="ml-4 mt-2 mb-2 font-weight-bold red-text">
                <?php $erupsi = $erupsi['total_erupsi'];
                echo isset($erupsi) ? $erupsi : 0; ?>
              </h1>

              <p class="font-small grey-text">Total Kejadian</p>
            </div>

          </div>
          <!-- Card Data -->

          <!-- Card Data -->

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->
      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">

        <!-- Panel -->
        <div class="card">

          <h4 class="ml-4 mt-2 mb-2 font-weight-bold black-text">
            Gempa Bumi
          </h4>

          <!-- Card Data -->
          <div class="row mt-1">

            <div class="col-md-5 col-5 text-left pl-4">
              <img class="btn-floating" style="width: 70%; height: auto;" src="<?php echo base_url('assets/img/gempa.png'); ?>" alt="">
            </div>

            <div class="col-md-7 col-7 text-right pr-5">

              <h1 class="ml-4 mt-2 mb-2 font-weight-bold red-text">
                <?php $gempa_bumi = $gempa_bumi['total_gempa_bumi'];
                echo isset($gempa_bumi) ? $gempa_bumi : 0; ?>
              </h1>

              <p class="font-small grey-text">Total Kejadian</p>
            </div>

          </div>
          <!-- Card Data -->

          <!-- Card Data -->

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">

        <!-- Panel -->
        <div class="card">

          <h4 class="ml-4 mt-2 mb-2 font-weight-bold black-text">
            Banjir Bandang
          </h4>
          <!-- Card Data -->
          <div class="row mt-1">

            <div class="col-md-5 col-5 text-left pl-4">
              <img class="btn-floating" style="width: 70%; height: auto;" src="<?php echo base_url('assets/img/bandang.png'); ?>" alt="">
            </div>

            <div class="col-md-7 col-7 text-right pr-5">

              <h1 class="ml-4 mt-2 mb-2 font-weight-bold red-text">
                <?php $banjir_bandang = $banjir_bandang['total_banjir_bandang'];
                echo isset($banjir_bandang) ? $banjir_bandang : 0; ?>
              </h1>

              <p class="font-small grey-text">Total Kejadian</p>
            </div>

          </div>
          <!-- Card Data -->

          <!-- Card Data -->

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->
      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">

        <!-- Panel -->
        <div class="card">

          <h4 class="ml-4 mt-2 mb-2 font-weight-bold black-text">
            Abrasi Pantai
          </h4>

          <!-- Card Data -->
          <div class="row mt-1">

            <div class="col-md-5 col-5 text-left pl-4">
              <img class="btn-floating" style="width: 70%; height: auto;" src="<?php echo base_url('assets/img/abrasi.png'); ?>" alt="">
            </div>

            <div class="col-md-7 col-7 text-right pr-5">

              <h1 class="ml-4 mt-2 mb-2 font-weight-bold red-text">
                <?php $abrasi_pantai = $abrasi_pantai['total_abrasi_pantai'];
                echo isset($abrasi_pantai) ? $abrasi_pantai : 0; ?>
              </h1>

              <p class="font-small grey-text">Total Kejadian</p>
            </div>

          </div>
          <!-- Card Data -->

          <!-- Card Data -->

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->


    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-lg-12 col-md-12 mb-lg-0 mb-4">

        <!-- Panel -->
        <div class="card mb-3" style="max-width: 100rem;">

          <div class="card-header bg-transparent">
            <h5 class="biru-text font-weight-bold">
              DATA TANGGAP DARURAT BENCANA PROVINSI SUMATERA BARAT</h5>
          </div>
          <div class="card white text-center z-depth-2">
            <div class="card-body">
              <?php $no_urut = 0;
              foreach ($bencana as $key => $list) :
                $dataDetail = $this->mHome->getDataPusdalopsTerdampak($list->token_bencana);
                $regencies = array();
                foreach ($dataDetail as $value) {
                  $regency = !empty($value['nm_regency']) ? ucwords(strtolower($value['nm_regency'])) : 'Data not available';
                  $regencies[] = $regency;
                }
              ?>
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <div class="card lighten-2 text-left z-depth-2">
                      <!-- Card Data -->
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="card-body">
                            <div>
                              <h5 class="biru-text font-weight-bold"> Bencana <?php echo $list->jenis_bencana; ?> : <?php echo $list->token_bencana; ?></h5>
                              <table class="tablehome">
                                <tbody>
                                  <tr>
                                    <td style="width: 18%;">
                                      <h6 class="gray-text">Waktu Kejadian</h6>
                                    </td>
                                    <td style="width: 2%;">
                                      <h6 class="gray-text">:</h6>
                                    </td>
                                    <td style="width: 65%;">
                                      <h6 class="gray-text">
                                        <span class="red-text">Update Tanggal <?php echo tgl_indonesia($list->tanggal_bencana); ?> Pukul: <?php echo $list->jam_bencana; ?> WIB</span>
                                      </h6>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <h6 class="gray-text">Lokasi Kejadian</h6>
                                    </td>
                                    <td>
                                      <h6 class="gray-text">:</h6>
                                    </td>
                                    <td>
                                      <h6 class="gray-text"><?php echo implode(', ', $regencies); ?></h6>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <h6 class="gray-text">Titik Koordinat</h6>
                                    </td>
                                    <td>
                                      <h6 class="gray-text">:</h6>
                                    </td>
                                    <td>
                                      <h6 class="gray-text"><?php echo $list->latitude; ?>, <?php echo $list->longitude; ?></h6>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="clearfix">
                              <a href="javascript:void(0);" class="btnFilter btn btn-purple waves-effect waves-light px-4 py-2 font-weight-bold">
                                <i class="fas fa-chevron-down"></i> Lihat Data
                              </a>
                              <?php echo form_close(); ?>
                              <a type="button" data-id="<?php echo $list->token_bencana; ?>" class="btn btn-warning waves-effect waves-light px-4 py-2 font-weight-bold btnFoto" title="Foto dan Video Bencana">
                                <i class="fas fa-paper-plane"></i> Foto Bencana
                              </a>
                              <button type="button" class="btn btn-success  waves-effect waves-light px-4 py-2 font-weight-bold" id="btnAdd"> Infografis</button>
                            </div>

                          </div>

                        </div>


                        <div class="col-md-6 col-12">
                          <!-- Card content -->
                          <div class="card-body card-body-cascade text-center">
                            <img style="width: 100%; height: 200px;" src="<?php echo base_url('assets/img/disaster.jpg'); ?>" alt="">

                          </div>
                          <!-- Card content -->
                        </div>

                      </div>
                      <!-- Card Data -->

                      <!-- Card Data -->
                      <?php echo form_open(site_url('#'), array('id' => 'formFilter', 'style' => 'display:none;')); ?>
                      <div class="card rgba-white-slight">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <h6 class="black-text font-weight-bold"> AKUMULASI DATA YANG TERDAMPAK </h6>
                              <table class="table table-bordered mb-0 table-sm" style="border-width: 2px; border-style: solid;">
                                <tbody>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Jumlah Pengungsi </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;">
                                        <?php
                                        echo $pengungsi = $this->mHome->getDataDetailTokenBencana($list->token_bencana, 5);
                                        ?> </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Jumlah Terdampak </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 10 </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Korban Meninggal </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> <?php
                                                                      echo $pengungsi = $this->mHome->getDataDetailTokenBencana($list->token_bencana, 1);
                                                                      ?> </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Korban Luka Berat/Sedang/Ringan </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> <?php
                                                                      echo $pengungsi = $this->mHome->getDataDetailTokenBencana($list->token_bencana, 3);
                                                                      ?> </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Jumlah Penduduk Hilang </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> <?php
                                                                      echo $pengungsi = $this->mHome->getDataDetailTokenBencana($list->token_bencana, 2);
                                                                      ?> </font>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="col-md-6 col-12">
                              <h6 class="black-text font-weight-bold"> FASILITAS UMUM TERDAMPAK </h6>
                              <table class="table table-bordered mb-0 table-sm" style="border-width: 2px; width: 100%; overflow-x: auto; border-style: solid;">
                                <tbody>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Pasar </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;">
                                        0
                                      </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Fasilitas Pendidikan </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 0 </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Fasilitas Ibadah </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 0 </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Fasilitas Kesehatan </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 0 </font>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <h6 class="black-text font-weight-bold"> PEMUKIMAN
                              </h6>
                              <table class="table table-bordered mb-0 table-sm" style="border-width: 2px; border-style: solid;">
                                <tbody>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Rumah Terdampak </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;">
                                        0 </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Gedung Terdampak </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 10 </font>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <br>
                              <h6 class="black-text font-weight-bold"> PERTANIAN
                              </h6>
                              <table class="table table-bordered mb-0 table-sm" style="border-width: 2px; border-style: solid;">
                                <tbody>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Rumah Terdampak </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;">
                                        0 </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Gedung Terdampak </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 10 </font>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="col-md-6 col-12">
                              <h6 class="black-text font-weight-bold"> INFRASTRUKTUR </h6>
                              <table class="table table-bordered mb-0 table-sm" style="border-width: 2px; border-style: solid;">
                                <tbody>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Jembatan </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;">
                                        0
                                      </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Jalan </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 0 </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Irigasi </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 0 </font>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <font style="font-size: 16px;"> Bangunan Sungai, Pantai dan Konservasi </font>
                                    </td>
                                    <td class="text-center">
                                      <font style="font-size: 16px;"> 0 </font>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <br>
                              <h6 class="red-text font-weight-bold">Update Data: Tanggal <?php echo hari($list->tanggal_bencana) . ', ' . tgl_indonesia($list->tanggal_bencana) . ', ' . $list->tanggal_bencana . ' WIB'; ?>
                              </h6>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              <?php
              endforeach; ?>
            </div>
          </div>

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </section>
  <!-- Section: Intro -->


</div>

<!------------------------------------ FORM VIEW FOTO BENCANA -------------------------------------------->
<div class="modal fade" id="modalEntryFormFoto" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
  <div class="modal-dialog modal-xxl" id="frmEntryFoto">
    <div class="modal-content">
      <div class="modal-header blue-gradient-rgba">
        <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form View Data Bencana</h4>
        <button type="button" class="close btnCloseFoto" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div><?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntryFoto', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
      <div class="modal-body">
        <?php echo form_hidden('tokenId', ''); ?>
        <div class="form-row mb-3">
          <div class="col-12 col-md-6 required">
            <label for="video_bencana" class="control-label font-weight-bold">Video Bencana</label>
            <div id="video_bencana"></div>
          </div>
          <div class="col-12 col-md-6 required">
            <label for="nama_file" class="control-label font-weight-bold">Foto Bencana</label>
            <div id="nama_file"></div>
          </div>
        </div>
        <button type="button" class="btn btn-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseFoto"><i class="fas fa-times"></i> Close Data </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!------------------------------------ FORM VIEW FOTO BENCANA -------------------------------------------->