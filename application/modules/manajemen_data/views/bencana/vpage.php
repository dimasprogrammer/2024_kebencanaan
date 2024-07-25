<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header magenta-gradient narrower py-1 mx-4 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        LIST DATA BENCANA
                    </h6>
                    <div class="clearfix">
                        <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-white btn-rounded waves-effect waves-light px-2 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                        <button type="button" class="btn btn-blue btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" id="btnAdd"><i class="fas fa-plus-circle"></i> Tambah Baru</button>

                    </div>
                </div>
                <div class="card-body mb-0">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">
                            <thead>
                                <tr>
                                    <th width="3%" class="font-weight-bold">#</th>
                                    <th width="10%" class="font-weight-bold">Jenis Bencana</th>
                                    <th width="30%" class="font-weight-bold">Nama Bencana</th>
                                    <th width="30%" class="font-weight-bold">Tanggal Bencana</th>
                                    <th width="10%" class="font-weight-bold">Status</th>
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
<style>
    #map1,
    #map2 {
        height: 400px;
        width: 100%;
        margin-bottom: 20px;
    }
</style>
<!-- <div id="map1" class="mb-3"></div>
<div id="map2" class="mb-3"></div> -->


<!------------------------------------ FORM ENTRI DATA BENCANA -------------------------------------------->
<div class="modal fade" id="modalEntryForm" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntry">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Data bencana</h4>
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
                    <div class="col-12 col-md-6">
                        <label for="tanggal_bencana" class="control-label font-weight-bold">Pilih Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control datepickerindo" name="tanggal_bencana" id="tanggal_bencana" style="background-color: white;" required>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="kategori_tanggap" class="control-label font-weight-bold">TD/TND<span class="text-danger">*</span></label>
                        <?php echo form_dropdown('kategori_tanggap', isset($tanggap_bencana) ? $tanggap_bencana : array('' => 'Pilih Jenis Pedagang '), $this->input->post('kategori_tanggap', TRUE), 'class="form-control select-all" id="kategori_tanggap" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="id_jenis_bencana" class="control-label font-weight-bold">Jenis Bencana<span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_jenis_bencana', isset($jenis_bencana) ? $jenis_bencana : array('' => 'Pilih Jenis Pedagang '), $this->input->post('id_jenis_bencana', TRUE), 'class="form-control select-all" id="id_jenis_bencana" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 required">
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
                <h6 class="control-label font-weight-bold">TITIK KOORDINAT LOKASI BENCANA</h6>
                <!-- <div id="map-canvas" class="mb-3"></div> -->
                <div id="map1" class="mb-3"></div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?= $this->input->post('latitude', TRUE); ?>" readonly required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?= $this->input->post('longitude', TRUE); ?>" readonly required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-4 required">
                        <label for="nama_file_infografis" class="control-label font-weight-bold">Infografis</label>
                        <div class="custom-file">
                            <input type="file" class="customFile" name="nama_file_infografis" id="nama_file_infografis" lang="in" value="<?= $this->input->post('nama_file_infografis', TRUE); ?>">
                            <label class="custom-file-label" for="nama_file_infografis"> </i>Silahkan Pilih File</label>
                        </div>
                        <div class="invalid-feedback"></div>
                        <div id="infografis"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="nama_file" class="control-label font-weight-bold">Foto Bencana</label>
                        <div class="custom-file">
                            <input type="file" class="customFile" name="nama_file" id="nama_file">
                            <label class="custom-file-label" for="nama_file"> </i>Silahkan Pilih File</label>
                        </div>
                        <div class="invalid-feedback"></div>
                        <div id="logo"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="video_bencana" class="control-label font-weight-bold"> Video Bencana</label>
                        <input type="text" class="form-control" name="video_bencana" id="video_bencana" placeholder="Video Bencana" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="id_regency" class="control-label font-weight-bold">Pusdalop Bencana <span class="text-danger">*</span></label>
                        <?php echo form_multiselect('id_regency[]', isset($pusdalops) ? $pusdalops : array('' => 'Pusdalop Bencana'), $this->input->post('id_regency[]', TRUE), 'class="form-control select-all" data-placeholder="Pilih Data"  style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <div class="card">
                            <div class="card-header white-text primary-color-dark">
                                Daftar Pusdalop Bencana Daerah
                            </div>
                            <!-- <div id="errEntryShare"></div> -->
                            <div class="card-body text-center px-4 mb-3">
                                <div id="errSuccessShare"></div>
                                <table class="table table-striped table-hover" width="100%" id="tblPenanggungJawab">


                                </table>
                            </div>
                        </div>
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
                <button type="button" class="btn btn-grey waves-effect waves-light px-3 py-2 font-weight-bold btnClose"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------------------ FORM ENTRI DATA BENCANA -------------------------------------------->

<!------------------------------------ FORM EDIT DATA BENCANA SHARE-------------------------------------------->
<div class="modal fade" id="modalEntryFormShare" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryShare">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Update Data </h4>
                <button type="button" class="close btnCloseShare" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/updateShare' : ''), array('id' => 'formEntryShare', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <?php echo form_hidden('tokenIdShare', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="id_regency_penerima" class="control-label font-weight-bolder">OPD <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_regency_penerima', isset($regency) ? $regency : array('' => 'Pilih Data'), $this->input->post('id_regency_penerima', TRUE), 'class="form-control select-all" id="id_regency_penerima" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseShare"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="saveShare" id="saveShare"><i class="fas fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------------------ FORM EDIT DATA BENCANA SHARE-------------------------------------------->

<!------------------------------------ FORM ENTRI DATA BENCANA KIRIM -------------------------------------------->
<div class="modal fade" id="modalEntryFormKirim" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryKirim">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form View Data Bencana</h4>
                <button type="button" class="close btnCloseKirim" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntryKirim', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div id="errSuccess"></div>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-2">
                        <label for="tanggal_kirim" class="control-label font-weight-bold"> Tanggal </label>
                        <input type="text" class="form-control" id="tanggal_kirim" disabled>
                    </div>
                    <div class="col-12 col-md-2">
                        <label for="tanggap_kirim" class="control-label font-weight-bold"> Tanggap Bencana </label>
                        <input type="text" class="form-control" id="tanggap_kirim" disabled>
                    </div>
                    <div class="col-12 col-md-2 required">
                        <label for="jenis_bencana_kirim" class="control-label font-weight-bold">Jenis Bencana</label>
                        <input type="text" class="form-control" id="jenis_bencana_kirim" disabled>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="nama_bencana_kirim" class="control-label font-weight-bold"> Nama Bencana </label>
                        <input type="text" class="form-control" id="nama_bencana_kirim" disabled>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="keterangan_bencana_kirim" class="control-label font-weight-bold"> Keterangan Bencana </label>
                        <textarea class="form-control" id="keterangan_bencana_kirim" rows="4" disabled></textarea>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="penyebab_bencana_kirim" class="control-label font-weight-bold"> Penyebab Bencana </label>
                        <textarea class="form-control" id="penyebab_bencana_kirim" rows="4" disabled></textarea>
                    </div>
                </div>
                <!-- <div id="map-kirim" class="mb-3"></div> -->
                <h6 class="control-label font-weight-bold">TITIK KOORDINAT LOKASI BENCANA</h6>
                <div id="map2" class="mb-3"></div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-4 required">
                        <label for="infografis_kirim" class="control-label font-weight-bold"> Infografis </label>
                        <div id="infografis_kirim"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="infografis_kirim" class="control-label font-weight-bold"> Gambar Bencana </label>
                        <div id="gambar_kirim"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="video_bencana_kirim" class="control-label font-weight-bold">Video Bencana</label>
                        <input type="text" class="form-control" id="video_bencana_kirim" disabled>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <div class="card">
                            <div class="card-header white-text primary-color-dark">
                                Daftar Pusdalop Bencana Daerah
                            </div>
                            <!-- <div id="errEntryShare"></div> -->
                            <div class="card-body text-center px-4 mb-3">
                                <table class="table table-striped table-hover" width="100%" id="tblKirim">


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-primary status">
                    <span><b>NB:</b> Perhatikan data yang anda inputkan apakah sudah sesuai, jika data sesuai silahkan tekan tombol kirim data</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseKirim"><i class="fas fa-times"></i> Close Data </button>
                <button type="submit" class="btn btn-danger waves-effect waves-light px-3 py-2 font-weight-bold status" name="saveKirim" id="saveKirim"><i class="fab fa-korvue"></i> Kirim Data </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------------------ FORM ENTRI DATA BENCANA KIRIM -------------------------------------------->