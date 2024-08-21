<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header magenta-gradient narrower py-1 mx-4 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        List Data User
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
                                    <th width="10%" class="font-weight-bold">Nama Bencana</th>
                                    <th width="10%" class="font-weight-bold">Tanggal Bencana</th>
                                    <th width="10%" class="font-weight-bold">Penyebab Bencana</th>
                                    <th width="30%" class="font-weight-bold">Kabupaten/Kota</th>
                                    <th width="20%" class="font-weight-bold">Action</th>
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
    <div class="modal-dialog modal-xxl" id="frmEntryKebutuhan">
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