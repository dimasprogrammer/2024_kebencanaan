<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header black-gradient narrower py-1 mx-4 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        LIST DATA KEJADIAN
                    </h6>
                    <div class="clearfix">
                        <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-success btn-rounded waves-effect waves-light px-2 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                        <button type="button" class="btn btn-blue btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" id="btnAdd"><i class="fas fa-plus-circle"></i> Tambah Baru</button>

                    </div>
                </div>
                <div class="card-body mb-0">
                    <div class="row mb-3 mt-1">

                        <div class="col-12 col-mb-12 mb-2">
                            <?php echo form_open(site_url('#'), array('id' => 'formFilter', 'style' => 'display:none;')); ?>
                            <div class="card rgba-grey-slight">
                                <div class="card-body">
                                    <div class="form-row mb-3 ">
                                        <div class="col-12 col-md-3">
                                            <label for="fullname" class="control-label font-weight-bolder">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" value="<?php echo $this->input->post('fullname', TRUE); ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-12">
                                            <div class="d-flex justify-content-lg-start align-items-center" style="margin-right: -5px;">
                                                <button type="submit" class="btn btn-rounded btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="filter" id="filter"><i class="fas fa-filter"></i> Lakukan Pencarian</button>
                                                <button type="button" class="btn btn-rounded btn-danger waves-effect waves-light px-3 py-2 font-weight-bold" name="cancel" id="cancel"><i class="fas fa-sync-alt"></i> Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">
                            <thead>
                                <tr>
                                    <th width="3%" class="font-weight-bold">#</th>
                                    <th width="30%" class="font-weight-bold">Jenis Korban Jiwa</th>
                                    <th width="10%" class="font-weight-bold">Korban Jiwa</th>
                                    <th width="10%" class="font-weight-bold">Jumlah Korban Jiwa</th>
                                    <th width="10%" class="font-weight-bold">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!------------------------------------ FORM ENTRI DATA BENCANA -------------------------------------------->
<div class="modal fade" id="modalEntryForm" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntry">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> FORM DATA KEJADIAN</h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntry', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div id="errSuccess"></div>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-3">
                        <label for="tanggal_bencana" class="control-label font-weight-bold">Pilih Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control datepickerindo" name="tanggal_bencana" id="tanggal_bencana" style="background-color: white;" required>
                    </div>
                    <div class="col-12 col-md-3 required">
                        <label for="kategori_tanggap" class="control-label font-weight-bold">TD/TND<span class="text-danger">*</span></label>
                        <?php echo form_dropdown('kategori_tanggap', kategoriTanggap(), $this->input->post('kategori_tanggap', TRUE), 'class="form-control select-all" id="kategori_tanggap" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-3  required">
                        <label for="id_regency" class="control-label font-weight-bold">Kabupaten/Kota <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_regency', isset($regency) ? $regency : array('' => 'Pilih Data'), $this->input->post('id_regency', TRUE), 'class="form-control select-all" id="id_regency" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-3 required">
                        <label for="id_district" class="control-label font-weight-bold">Kecamatan <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_district', array('' => 'Pilih Data'), $this->input->post('id_district', TRUE), 'class="form-control select-all" id="id_district" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-3 required">
                        <label for="id_village" class="control-label font-weight-bold">Kelurahan/Nagari <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_village', array('' => 'Pilih Data'), $this->input->post('id_village', TRUE), 'class="form-control select-all" id="id_village" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-3 required">
                        <label for="jorong" class="control-label font-weight-bold"> Jorong <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jorong" id="jorong" placeholder="Jorong" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-3 required">
                        <label for="id_jenis_bencana" class="control-label font-weight-bold">Jenis Bencana<span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_jenis_bencana', isset($jenis_bencana) ? $jenis_bencana : array('' => 'Pilih Jenis Pedagang '), $this->input->post('id_jenis_bencana', TRUE), 'class="form-control select-all" id="id_jenis_bencana" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-3 required">
                        <label for="nama_bencana" class="control-label font-weight-bold"> Nama Bencana <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_bencana" id="nama_bencana" placeholder="Nama Bencana" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="keterangan_bencana" class="control-label font-weight-bold"> Keterangan Bencana <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keterangan_bencana" id="keterangan_bencana" rows="4"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="penyebab_bencana" class="control-label font-weight-bold"> Penyebab Bencana <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="penyebab_bencana" id="penyebab_bencana" rows="4"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="nama_file_infografis" class="control-label font-weight-bold">Infografis <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="customFile" name="nama_file_infografis" id="nama_file_infografis" lang="in" value="<?= $this->input->post('nama_file_infografis', TRUE); ?>">
                            <label class="custom-file-label" for="nama_file_infografis"> </i>Silahkan Pilih File</label>
                        </div>
                        <div class="invalid-feedback"></div>
                        <div id="infografis"></div>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="nama_file" class="control-label font-weight-bold">Foto Bencana <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="customFile" name="nama_file" id="nama_file" lang="in" value="<?= $this->input->post('nama_file', TRUE); ?>">
                            <label class="custom-file-label" for="nama_file"> </i>Silahkan Pilih File</label>
                        </div>
                        <div class="invalid-feedback"></div>
                        <div id="gambar"></div>
                    </div>
                </div>


                <!-- <div class="form-row mb-3">
                    <div class="col-md-12 col-12 required">
                        <label for="id_status" class="control-label font-weight-bolder">Status <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_status', status(), $this->input->post('id_status', TRUE), 'class="form-control select-data" id="id_status" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div> -->
                <div class="alert alert-danger">
                    Ukuran dokumen yang diupload maksimal 2 Mb. Format dokumen yang diupload harus pdf/ppt</div>
                <div class="blockquote-footer">
                    <span><b>NB:</b> Untuk kolom anggaran dan profil hanya optional</span>
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
<!------------------------------------ FORM ENTRI DATA BENCANA -------------------------------------------->