<section class="mb-5 pb-4 mt-4">
    <div class="card card-cascade narrower z-depth-0">

        <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

            <div>
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-th-large mt-0"></i></button>
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-columns mt-0"></i></button>
            </div>

            <a href="" class="white-text mx-3">TABEL INDIKATOR PARAMETER</a>

            <div>
                <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>"> <i class="fab fa-foursquare"></i> REFRESH PAGE </a>
            </div>

        </div>

        <div class="px-4">

            <div class="table-responsive">

                <!--Table-->
                <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">

                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th width="3%" class="font-weight-bold">#</th>
                            <th width="15%" class="font-weight-bold">Nama OPD</th>
                            <th width="15%" class="font-weight-bold">Bobot Nilai</th>
                            <th width="7%" class="font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                </table>
                <!-- Table -->

            </div>

        </div>

    </div>
</section>
<div class="modal fade" id="modalEntryForm" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="frmEntry">
        <div class="modal-content">
            <div class="modal-header aqua-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Data Indikator Parameter </h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntry', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="id_indikator_satuan" class="control-label font-weight-bolder">Parameter</label>
                        <?php echo form_dropdown('id_indikator_satuan', isset($indikator_satuan) ? $indikator_satuan : array('' => 'Pilih Indikator '), $this->input->post('id_indikator_satuan', TRUE), 'class="form-control select-all" id="id_indikator_satuan" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="nm_indikator" class="control-label font-weight-bold">Nama Indikator <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nm_indikator" id="nm_indikator" placeholder="Nama Indikator" value="<?php echo $this->input->post('nm_indikator', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="blockquote-footer">
                    <span><b>NB:</b> <span><b>NB:</b> Wajib Mengisi Kolom indikator_parameter</span></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnClose"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>