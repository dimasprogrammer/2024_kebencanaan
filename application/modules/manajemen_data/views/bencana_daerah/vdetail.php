<div class="card card-cascade narrower z-depth-0">

    <div class="view view-cascade gradient-card-header magenta-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

        <div>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-th-large mt-0"></i></button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-columns mt-0"></i></button>
        </div>

        <a href="" class="white-text mx-3">FORM INPUT KEBENCANAAN DAERAH</a>

        <div>
            <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" href="<?php echo site_url() . 'manajemen_data/bencana_daerah/'; ?>"> <i class="fas fa-angle-double-left mt-0"></i> KEMBALI </a>
            <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" onclick="window.location.reload(true);"> <i class="fab fa-foursquare"></i> REFRESH </a>
        </div>

    </div>
    <div class="col-xl-12 col-md-12">
        <div class="row">
            <div class="col-xl-12 col-md-12">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">

                            <!-- Grid column -->
                            <div class="col-md-12">

                                <!-- Accordion wrapper -->
                                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                                    <!-- Accordion card -->
                                    <div class="card">
                                        <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntry', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
                                        <div id="errSuccess"></div>
                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="headingOne1">
                                            <a class="black-text" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                                <h5 class="mb-0">
                                                    Data Kebencanaan #1 <i class="fas fa-angle-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                                            <div class="card-body">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                        <div id="errEntry"></div>
                                                        <?php echo form_hidden('tokenId', ''); ?>
                                                        <div class="form-row mb-3">
                                                            <div class="col-12 col-md-4 required">
                                                                <label for="tanggal_bencana" class="control-label black-text"> Tanggal Bencana </label>
                                                                <input type="text" class="form-control" value="<?php echo $token_bencana_share['tanggal_bencana']; ?>" readonly>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-12 col-md-4 required">
                                                                <label for="nama_bencana" class="control-label black-text"> Nama Bencana </label>
                                                                <input type="text" class="form-control" value="<?php echo $token_bencana_share['nama_bencana']; ?>" readonly>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-12 col-md-4 required">
                                                                <label for="jenis_bencana" class="control-label black-text"> Jenis Bencana </label>
                                                                <input type="text" class="form-control" value="<?php echo $token_bencana_share['jenis_bencana']; ?>" readonly>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mb-3">
                                                            <div class="col-12 col-md-3 required">
                                                                <label for="kategori_bencana" class="control-label black-text"> Kategori Bencana </label>
                                                                <input type="text" class="form-control" value="<?php
                                                                                                                $kategori_bencana = $token_bencana_share['kategori_bencana'];
                                                                                                                $katBen = ($kategori_bencana == 1) ? 'Bencana' : 'Non Bencana';
                                                                                                                echo $katBen;
                                                                                                                ?>" readonly>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-12 col-md-3 required">
                                                                <label for="penyebab_bencana" class="control-label black-text"> Penyebab Bencana </label>
                                                                <input type="text" class="form-control" value="<?php echo $token_bencana_share['penyebab_bencana']; ?>" readonly>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-12 col-md-3 required">
                                                                <label for="jumlah_kejadian" class="control-label black-text"> Jumlah Kejadian </label>
                                                                <input type="text" class="form-control" value="<?php echo $token_bencana_share['jumlah_kejadian']; ?>" readonly>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                            <div class="col-12 col-md-3 required">
                                                                <label for="kategori_tanggap" class="control-label black-text"> Kategori Bencana </label>
                                                                <input type="text" class="form-control" value="<?php
                                                                                                                $kategori_tanggap = $token_bencana_share['kategori_tanggap'];
                                                                                                                $katBen = ($kategori_tanggap == 1) ? 'Tanggap Darurat' : 'Non Tanggap Darurat';
                                                                                                                echo $katBen;
                                                                                                                ?>" readonly>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mb-3">
                                                            <div class="col-12 col-md-12 required">
                                                                <h6 class="control-label font-weight-bold">TITIK KOORDINAT LOKASI BENCANA</h6>
                                                                <div id="map-canvas" class="mb-3"></div>
                                                            </div>
                                                        </div>

                                                        <div class="blockquote-footer">
                                                            <span><b>NB:</b> Isilah kolom yang kosong untuk menyimpan data </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Accordion card -->

                                    <!-- Accordion card -->
                                    <div class="card">

                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="headingTwo2">
                                            <a class="black-text" class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                                <h5 class="mb-0">
                                                    Data Korban Jiwa #2 <i class="fas fa-angle-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                                wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                                shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                                sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                                accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Accordion card -->

                                    <!-- Accordion card -->
                                    <div class="card">

                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="headingThree3">
                                            <a class="black-text" class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                                <h5 class="mb-0">
                                                    Data Kerusakan #3 <i class="fas fa-angle-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionEx">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                                wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                                shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                                sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                                accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Accordion card -->
                                </div>
                                <!-- Accordion wrapper -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnClose"><i class="fas fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Submit</button>
                                </div>
                                <?php echo form_close(); ?>

                            </div>
                            <!-- Grid column -->

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>