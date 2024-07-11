<section class="mb-5 pb-4 mt-4">
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header blue-gradient-rgba narrower py-1 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        List Data Indikator Satuan
                    </h6>
                    <div class="clearfix">
                        <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-sm btn-white btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                        <button type="button" class="btn btn-success btn-rounded btn-sm waves-effect waves-light px-3 py-2 font-weight-bold" id="btnAdd"><i class="fas fa-plus-circle"></i> Tambah Baru</button>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">
                            <thead>
                                <tr>
                                    <th width="3%" class="font-weight-bold">#</th>
                                    <th width="15%" class="font-weight-bold">Satuan Indikator</th>
                                    <th width="10%" class="font-weight-bold">Indikator</th>
                                    <th width="10%" class="font-weight-bold">Bobot</th>
                                    <th width="6%" class="font-weight-bold">Status</th>
                                    <th width="7%" class="font-weight-bold">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalEntryForm" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="frmEntry">
        <div class="modal-content">
            <div class="modal-header aqua-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Data Indikator Satuan</h4>
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
                        <label for="id_indikator" class="control-label font-weight-bolder">Pilih Indikator <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_indikator', isset($indikator) ? $indikator : array('' => 'Pilih Indikator '), $this->input->post('id_indikator', TRUE), 'class="form-control select-all" id="id_indikator" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-8 required">
                        <label for="nm_indikator_satuan" class="control-label font-weight-bolder">Indikator Satuan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nm_indikator_satuan" id="nm_indikator_satuan" placeholder="Indikator Satuan" value="<?php echo $this->input->post('nm_indikator_satuan', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="bobot_satuan" class="control-label font-weight-bolder">Bobot Satuan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="bobot_satuan" id="bobot_satuan" placeholder="Bobot Satuan" value="<?php echo $this->input->post('bobot_satuan', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>


                <div class="form-row mb-3">
                    <div class="col-md-12 col-12 required">
                        <label for="id_status" class="control-label font-weight-bolder">Status <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_status', status(), $this->input->post('id_status', TRUE), 'class="form-control select-data" id="id_status" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="blockquote-footer">
                    <span><b>NB:</b> <span><b>NB:</b> Wajib Mengisi Kolom indikator_satuan</span></span>
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