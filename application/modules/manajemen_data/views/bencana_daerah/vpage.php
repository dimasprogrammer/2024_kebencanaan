<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header magenta-gradient narrower py-1 mx-4 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        LIST DAFTAR BENCANA DAERAH
                    </h6>
                    <div class="clearfix">
                        <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-white btn-rounded waves-effect waves-light px-2 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>

                    </div>
                </div>
                <div class="card-body mb-0">
                    <div class="row mb-3 mt-1">

                        <div class="col-12 col-mb-12 mb-2">
                            <?php echo form_open(site_url('#'), array('id' => 'formFilter', 'style' => 'display:none;')); ?>

                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">
                            <thead>
                                <tr>
                                    <th width="3%" class="font-weight-bold">#</th>
                                    <th width="10%" class="font-weight-bold">Jenis Bencana</th>
                                    <th width="8%" class="font-weight-bold">Tanggal</th>
                                    <th width="18%" class="font-weight-bold">Kabupaten/Kota</th>
                                    <th width="35%" class="font-weight-bold">Validasi</th>
                                    <th width="15%" class="font-weight-bold">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!------------------------------------ FORM ENTRI DATA KEBUTUHAN BENCANA -------------------------------------------->
<div class="modal fade" id="modalEntryFormKebutuhan" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryKebutuhan">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Kebutuhan Bencana</h4>
                <button type="button" class="close btnCloseKebutuhan" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntryKebutuhan', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div id="errSuccessKebutuhan"></div>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="kebutuhan_bencana" class="control-label font-weight-bold">Kebutuhan Data Bencana <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="kebutuhan_bencana" id="kebutuhan_bencana" rows="4"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="alert alert-primary status">
                    <span><b>NB:</b> Perhatikan data yang anda inputkan apakah sudah sesuai, jika data sesuai silahkan tekan tombol Kebutuhan data</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseKebutuhan"><i class="fas fa-times"></i> Close Data </button>
                <button type="submit" class="btn btn-danger waves-effect waves-light px-3 py-2 font-weight-bold status" name="saveKebutuhan" id="saveKebutuhan"><i class="fab fa-korvue"></i> Save Kebutuhan </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------------------ FORM ENTRI DATA KEBUTUHAN BENCANA -------------------------------------------->

<!------------------------------------ FORM ENTRI VALIDASI DATA KORBAN BENCANA -------------------------------------------->
<div class="modal fade" id="modalEntryFormValidasiKorban" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryValidasiKorban">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title heading lead black-text font-weight-bold">Validasi Data Korban Bencana <i class="fas fa-check"></i> </h4>
                <button type="button" class="close btnCloseValidasiKorban" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntryValidasiKorban', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <?php echo form_hidden('tokenValidasiId', ''); ?>
                <div id="errSuccessValidasiKorban"></div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <div class="card card-cascade narrower z-depth-0">
                            <div class="view view-cascade gradient-card-header blue-gradient narrower py-1 mx-1 mb-1 d-flex justify-content-between align-items-center">

                                <a href="" class="white-text mx-3">Tabel Korban Bencana</a>

                                <div>
                                    <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" id="btnValidasiKorban" style="display:none;"> <i class="fa fa-check"></i> Validasi </a>
                                    <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" onclick="window.location.reload(true);"> <i class="fab fa-foursquare"></i> Refresh </a>
                                </div>

                            </div>
                            <div class="px-2">
                                <div class="table-responsive-md">
                                    <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblListKorban" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="3%">
                                                    <div class="custom-control custom-checkbox mt-0 pt-0">
                                                        <input type="checkbox" class="custom-control-input" id="checkAllKorban">
                                                        <label class="custom-control-label font-weight-bolder" for="checkAllKorban"></label>
                                                    </div>
                                                </th>
                                                <th width="3%" class="font-weight-bold">#</th>
                                                <!-- <th width="20%" class="font-weight-bold">Token Detail</th> -->
                                                <th width="20%" class="font-weight-bold">Kelurahan/Desa/Nagari</th>
                                                <th width="20%" class="font-weight-bold">Waktu Data</th>
                                                <th width="20%" class="font-weight-bold">Kondisi Korban</th>
                                                <th width="20%" class="font-weight-bold">Jenis Kelamin</th>
                                                <th width="20%" class="font-weight-bold">Jumlah Korban</th>
                                                <th width="20%" class="font-weight-bold">Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseValidasiKorban"><i class="fas fa-times"></i> Close Data </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------------------ FORM ENTRI VALIDASI DATA KORBAN BENCANA -------------------------------------------->

<!------------------------------------ FORM ENTRI VALIDASI DATA KERUSAKAN BENCANA -------------------------------------------->
<div class="modal fade" id="modalEntryFormValidasiKerusakan" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryValidasiKerusakan">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title heading lead black-text font-weight-bold">Validasi Data Kerusakan Bencana <i class="fas fa-check"></i> </h4>
                <button type="button" class="close btnCloseValidasiKerusakan" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntryValidasiKerusakan', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <?php echo form_hidden('tokenValidasiId', ''); ?>
                <div id="errSuccessValidasiKerusakan"></div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <div class="card card-cascade narrower z-depth-0">
                            <div class="view view-cascade gradient-card-header blue-gradient narrower py-1 mx-1 mb-1 d-flex justify-content-between align-items-center">

                                <a href="" class="white-text mx-3">Tabel Kerusakan Sarana</a>

                                <div>
                                    <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" id="btnValidasiKerusakan" style="display:none;"> <i class="fa fa-check"></i> Validasi </a>
                                    <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" onclick="window.location.reload(true);"> <i class="fab fa-foursquare"></i> Refresh </a>
                                </div>

                            </div>
                            <div class="px-2">
                                <div class="table-responsive-md">
                                    <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblListKerusakan" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="3%">
                                                    <div class="custom-control custom-checkbox mt-0 pt-0">
                                                        <input type="checkbox" class="custom-control-input" id="checkAllKerusakan">
                                                        <label class="custom-control-label font-weight-bolder" for="checkAllKerusakan"></label>
                                                    </div>
                                                </th>
                                                <th width="3%" class="font-weight-bold">#</th>
                                                <!-- <th width="20%" class="font-weight-bold">Token Detail</th> -->
                                                <th width="20%" class="font-weight-bold">Kelurahan/Desa/Nagari</th>
                                                <th width="15%" class="font-weight-bold">Waktu Data</th>
                                                <th width="15%" class="font-weight-bold">Jenis Kerusakan</th>
                                                <th width="15%" class="font-weight-bold">Rusak Berat</th>
                                                <th width="15%" class="font-weight-bold">Rusak Sedang</th>
                                                <th width="15%" class="font-weight-bold">Rusak Ringan</th>
                                                <th width="20%" class="font-weight-bold">Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseValidasiKerusakan"><i class="fas fa-times"></i> Close Data </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------------------ FORM ENTRI VALIDASI DATA KERUSAKAN BENCANA -------------------------------------------->