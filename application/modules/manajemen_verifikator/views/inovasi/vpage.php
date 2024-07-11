<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <!-- Grid column -->
            <!-- Tabs -->
            <div class="classic-tabs ">

                <!-- Nav tabs -->
                <div class="tabs-wrapper">

                    <ul class="nav tabs-primary" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link waves-light waves-effect waves-light" href="<?php echo site_url() . 'manajemen_verifikator/inovasi/'; ?>"><i class="fas fa-table fa-1x"></i> SEMUA </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link waves-light waves-effect waves-light" href="<?php echo site_url() . 'manajemen_verifikator/inovasi/index/1'; ?>"><i class="fas fa-table fa-1x"></i> INISIATIF </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link waves-light waves-effect waves-light" href="<?php echo site_url() . 'manajemen_verifikator/inovasi/index/2'; ?>"><i class="fas fa-table fa-1x"></i> UJI COBA </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link waves-light waves-effect waves-light" href="<?php echo site_url() . 'manajemen_verifikator/inovasi/index/3'; ?>"><i class="fas fa-table fa-1x"></i> PENERAPAN </a>
                        </li>

                    </ul>

                </div>
                <!-- Tab panels -->


                <div class="tab-content card">

                    <!-- Panel 1 -->
                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
                        <div class="card-body mb-0">
                            <div class="card-header white-text text-left">
                                <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-white btn-rounded waves-effect waves-light px-2 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                                <button type="button" class="btn btn-blue btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" id="btnAdd"><i class="fas fa-plus-circle"></i> Tambah Baru</button>
                                <a href="javascript:void(0);" class="btnFilter btn btn-orange btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold">
                                    <i class="fas fa-sliders-h"></i> Filter Data
                                </a>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col-12 col-md-12 required">
                                    <div class="row mb-3 mt-1">

                                        <div class="col-12 col-mb-12 mb-2">
                                            <?php echo form_open(site_url('#'), array('id' => 'formFilter', 'style' => 'display:none;')); ?>
                                            <div class="card rgba-grey-slight">
                                                <div class="card-body">
                                                    <div class="form-row mb-3 getOpd">
                                                        <div class="col-12 col-md-6">
                                                            <label for="opd" class="control-label font-weight-bolder">Nama Instansi</label>
                                                            <?php
                                                            $getInstansi = $this->muser->getOptionOpd();
                                                            echo form_dropdown('opd', isset($getInstansi) ? $getInstansi : array('' => 'Pilih Nama Instansi'), $this->input->post('opd', TRUE), 'class="form-control select-all" style="width:100%"'); ?>
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
                                        <table cellspacing="0" class="table table-striped table-border table-hover table-sm" id="tblList" width="100%">
                                            <thead>
                                                <th width="5%" class="font-weight-bold">#</th>
                                                <th width="15%" class="font-weight-bold">Nama Instansi</th>
                                                <th width="15%" class="font-weight-bold">Nama Inovasi</th>
                                                <th width="10%" class="font-weight-bold">Urusan Pemerintahan</th>
                                                <th width="10%" class="font-weight-bold">Waktu Uji Coba</th>
                                                <th width="8%" class="font-weight-bold">Tahapan Inovasi</th>
                                                <th width="10%" class="font-weight-bold">Waktu Penerapan</th>
                                                <th width="5%" class="font-weight-bold">Skor Kematangan</th>
                                                <th width="2%" class="font-weight-bold">Status</th>
                                                <th width="20%" class="font-weight-bold">Action</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 1 -->


                </div>

            </div>
            <!-- Grid column -->
        </div>
    </div>
</section>

<div class="modal fade" id="modalEntryForm" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntry">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Data Inovasi</h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/create' : ''), array('id' => 'formEntry', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="nama_inovasi" class="control-label font-weight-bold">Nama Inovasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_inovasi" id="nama_inovasi" placeholder="Nama Inovasi" value="<?php echo $this->input->post('nama_inovasi', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="tahapan_inovasi" class="control-label font-weight-bold">Tahapan Inovasi <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-3">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_tahapan_inovasi" id="type_tahapan_1" value="1" <?php echo set_radio('id_tahapan_inovasi', '1'); ?> required>
                                    <label class="custom-control-label" for="type_tahapan_1">Inisiatif</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_tahapan_inovasi" id="type_tahapan_2" value="2" <?php echo set_radio('id_tahapan_inovasi', '2'); ?> required>
                                    <label class="custom-control-label" for="type_tahapan_2">Uji Coba</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_tahapan_inovasi" id="type_tahapan_3" value="3" <?php echo set_radio('id_tahapan_inovasi', '3'); ?> required>
                                    <label class="custom-control-label" for="type_tahapan_3">Penerapan</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="inisiator_inovasi" class="control-label font-weight-bold">Inisiator Inovasi<span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-2">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_inisiator_inovasi" id="type_inisiator_1" value="1" <?php echo set_radio('id_inisiator_inovasi', '1'); ?> required>
                                    <label class="custom-control-label" for="type_inisiator_1">Kepala OPD</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_inisiator_inovasi" id="type_inisiator_2" value="2" <?php echo set_radio('id_inisiator_inovasi', '2'); ?> required>
                                    <label class="custom-control-label" for="type_inisiator_2">Anggota DPRD</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_inisiator_inovasi" id="type_inisiator_3" value="3" <?php echo set_radio('id_inisiator_inovasi', '3'); ?> required>
                                    <label class="custom-control-label" for="type_inisiator_3">OPD</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_inisiator_inovasi" id="type_inisiator_4" value="4" <?php echo set_radio('id_inisiator_inovasi', '4'); ?> required>
                                    <label class="custom-control-label" for="type_inisiator_4">ASN</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_inisiator_inovasi" id="type_inisiator_5" value="5" <?php echo set_radio('id_inisiator_inovasi', '5'); ?> required>
                                    <label class="custom-control-label" for="type_inisiator_5">Masyarakat</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="jenis_inovasi" class="control-label font-weight-bold">Jenis Inovasi OPD <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-2">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_jenis_inovasi" id="type_jenis_1" value="1" <?php echo set_radio('id_jenis_inovasi', '1'); ?> required>
                                    <label class="custom-control-label" for="type_jenis_1">Digital</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="id_jenis_inovasi" id="type_jenis_2" value="2" <?php echo set_radio('id_jenis_inovasi', '2'); ?> required>
                                    <label class="custom-control-label" for="type_jenis_2">Non Digital</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="id_bentuk_inovasi" class="control-label font-weight-bold">Pilih Bentuk Inovasi OPD <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_bentuk_inovasi', isset($bentuk_inovasi) ? $bentuk_inovasi : array('' => 'Pilih Bentuk Inovasi '), $this->input->post('id_bentuk_inovasi', TRUE), 'class="form-control select-all" id="id_bentuk_inovasi" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="id_tematik" class="control-label font-weight-bold">Pilih Tematik Inovasi <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_tematik', isset($tematik) ? $tematik : array('' => 'Pilih Tematik Inovasi '), $this->input->post('id_tematik', TRUE), 'class="form-control select-all" id="id_tematik" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <label for="id_urusan_utama" class="control-label font-weight-bold">Urusan Pemerintahan</label>
                <div class="form-row mb-2">
                    <div class="col-12 col-md-6 required">
                        <label for="id_urusan_utama" class="control-label font-weight-bolder">Urusan Utama <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_urusan_utama', isset($urusan_utama) ? $urusan_utama : array('' => 'Pilih Urusan Utama '), $this->input->post('id_urusan_utama', TRUE), 'class="form-control select-all" id="id_urusan_utama" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                    <!-- <div class="col-12 col-md-6 required">
                        <label for="label_kontrol" class="control-label font-weight-bold"> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label_kontrol" id="label_kontrol" placeholder="" value="<?php echo $this->input->post('label_kontrol', TRUE); ?>" disabled>
                        <div class="invalid-feedback"></div>
                    </div> -->
                    <div class="col-12 col-md-6 required">
                        <label for="id_urusan_lainnya" class="control-label font-weight-bolder">Urusan lain yang berurusan <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_urusan_lainnya', isset($urusan_lainnya) ? $urusan_lainnya : array('' => 'Pilih Urusan Lainnya '), $this->input->post('id_urusan_lainnya', TRUE), 'class="form-control select-all" id="id_urusan_lainnya" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <!-- <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="id_urusan_lainnya" class="control-label font-weight-bolder">Urusan lain yang berurusan <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_urusan_lainnya', isset($urusan_lainnya) ? $urusan_lainnya : array('' => 'Pilih Urusan Lainnya '), $this->input->post('id_urusan_lainnya', TRUE), 'class="form-control select-all" id="id_urusan_lainnya" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div> -->
                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="waktu_uji_coba" class="control-label font-weight-bold">Waktu Uji Coba Inovasi OPD <span class="text-danger">*</span></label>
                        <input type="date" class="form-control datepickerindo" name="waktu_uji_coba" id="waktu_uji_coba" style="background-color: white;" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="waktu_penerapan" class="control-label font-weight-bold">Waktu Penerapan Inovasi OPD <span class="text-danger">*</span></label>
                        <input type="date" class="form-control datepickerindo" name="waktu_penerapan" id="waktu_penerapan" style="background-color: white;" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-6 col-md-6 required">
                        <label for="rancang_bangun" class="control-label font-weight-bold">Rancang Bangun (Minimal 300 Kata) <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="rancang_bangun" id="rancang_bangun" value="<?= $this->input->post('rancang_bangun', TRUE); ?>" rows="2"></textarea>

                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-6 col-md-6 required">
                        <label for="rancang_perbaikan" class="control-label font-weight-bold">Perbaiki Rancang Bangun <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="rancang_perbaikan" id="rancang_perbaikan" value="<?= $this->input->post('rancang_perbaikan', TRUE); ?>" rows="2"></textarea>

                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <?php $i = 1;
                    foreach ($fileupload as $key => $list) :
                    ?>
                        <div class="col-12 col-md-6  mb-3 required">
                            <label for="nama_file[<?= $list->id_category_file ?>]" class="control-label font-weight-bold">
                                <?php echo form_hidden('upload[' . $i . ']', $list->id_category_file);
                                echo $list->nm_category; ?> </label>
                            <div class="card">
                                <div class="card-body mb-0 pb-3">
                                    <label class="btn btn-primary btn-block waves-effect waves-light px-0">
                                        <input type="file" class="uploadFoto" name="nama_file[<?= $list->id_category_file  ?>]" id="nama_file[<?= $list->id_category_file  ?>]" required>
                                    </label>
                                    <small class="text-danger font-weight-bolder alert-foto"></small>
                                </div>
                            </div>
                            <div id="tes_<?= $list->id_category_file  ?>"></div>
                        </div>
                    <?php $i++;
                    endforeach; ?>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-12 col-12 required">
                        <label for="status_inovasi" class="control-label font-weight-bolder">Status <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('status_inovasi', status_inovasi(), $this->input->post('status_inovasi', TRUE), 'class="form-control select-data" id="status_inovasi" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
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

<!------------------------------------ MENGUPLOAD DOKUMEN HASIL UJI COBA -------------------------------------------->
<div class="modal fade" id="modalEntryFormUploadHasil" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryUploadHasil">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Upload Hasil Uji Coba</h4>
                <button type="button" class="close btnCloseUploadHasil" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/createUploadHasil' : ''), array('id' => 'formEntryUploadHasil', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntryUploadHasil"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="nomor_surat" class="control-label font-weight-bold">Nomor Surat/Dokumen <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat/Dokumen" value="<?php echo $this->input->post('nomor_surat', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="tanggal_surat" class="control-label font-weight-bold">Tanggal Surat <span class="text-danger">*</span></label>
                        <input type="date" class="form-control datepickerindo" name="tanggal_surat" id="tanggal_surat" style="background-color: white;" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12">
                        <label for="tentang_surat" class="control-label font-weight-bold">Tentang Surat <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="tentang_surat" id="tentang_surat" rows="3" placeholder="Tentang Surat"><?php echo $this->input->post('tentang_surat', TRUE); ?></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="nomor_surat" class="control-label font-weight-bold">Upload Dokumen <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="customFile" name="nama_file" id="nama_file" lang="in" value="<?= $this->input->post('nama_file', TRUE); ?>">
                            <label class="custom-file-label" for="nama_file"> </i>Silahkan Pilih File</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseUploadHasil"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="saveUploadHasil" id="saveUploadHasil"><i class="fas fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------------------ MENGUPLOAD DOKUMEN HASIL UJI COBA -------------------------------------------->

<!---------------------------- MENGAJUKAN NOMOR REGISTRASI KE BALITBANG PROVINSI ------------------------------------>
<div class="modal fade" id="modalEntryFormPermohonan" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryPermohonan">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Permohonan Nomor Registrasi </h4>
                <button type="button" class="close btnClosePermohonan" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/createPermohonan' : ''), array('id' => 'formEntryPermohonan', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntryPermohonan"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required"><label for="nomor_surat" class="control-label font-weight-bold">Apakah Anda yakin mengirimkan Inovasi Daerah Ke Balitbang Provinsi <span class="text-danger">?</span></label>
                    </div>
                </div>
                <label for="nomor_surat" class="control-label font-weight-bold">Saya yang dibawah ini:</label>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="nama_lengkap" class="control-label font-weight-bolder">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $this->input->post('nama_lengkap', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="jabatan" class="control-label font-weight-bolder">Jabatan / Golongan</label>
                        <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan / Golongan" value="<?php echo $this->input->post('jabatan', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="instansi" class="control-label font-weight-bolder">Instansi</label>
                        <input type="text" class="form-control" name="instansi" id="instansi" placeholder="Instansi" value="<?php echo $this->input->post('instansi', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="no_hp" class="control-label font-weight-bolder">No. HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No. HP" value="<?php echo $this->input->post('no_hp', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="email" class="control-label font-weight-bolder">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php echo $this->input->post('email', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <label for="menyatakan" class="control-label font-weight-bold">Menyatakan bahwa saya akan melaksanakan ketentuan sebagai berikut:</label>
                <label for="menyatakan" class="control-label font-weight-bolder">
                    1. Saya telah memahami tata cara pengisian data indeks inovasi daerah sesuai dengan informasi pada pedoman umum dan petunjuk teknis; <br>
                    2. Saya telah mengisi data inovasi secara baik dan benar; <br>
                    3. Saya telah melampirkan bukti dukung yang valid sesuai dengan yang dipersyaratkan; <br>
                    4. Saya telah menyadari tidak ada perbaikan apabila terdapat kekeliruan atau kekurangcermatan pengisian data pasca pengiriman ke Balitbang Provinsi;
                </label>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <input class="form-check-input" type="checkbox" value="1" id="status_permohonan" name="status_permohonan" />
                        <label class="form-check-label font-weight-bolder text-left" for="status_permohonan"> Saya menyatakan bahwa data pernyataan yang diinputkan diatas sudah benar</label>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="blockquote-footer">
                    <span><b>NB:</b> silahkan tekan tombol submit untuk menyimpan data </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect waves-light px-3 py-2 font-weight-bold btnClosePermohonan"><i class="fas fa-times"></i> Batalkan Permohonan </button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="savePermohonan" id="savePermohonan"><i class="fas fa-check"></i> Kirim Ke Balitbang </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!---------------------------- MENGAJUKAN NOMOR REGISTRASI KE BALITBANG PROVINSI ------------------------------------>

<!---------------------------- FORM UNTUK MELIHAT DATA PENGIRIM ------------------------------------>
<div class="modal fade" id="modalEntryFormPengirim" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryPengirim">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Data Pengirim </h4>
                <button type="button" class="close btnClosePengirim" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/createPengirim' : ''), array('id' => 'formEntryPengirim', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntryPengirim"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="nama_lengkap_pengirim" class="control-label font-weight-bold">Nama Lengkap</label>
                        <div id="nama_lengkap_pengirim"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="jabatan_pengirim" class="control-label font-weight-bold">Jabatan / Golongan</label>
                        <div id="jabatan_pengirim"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="instansi_pengirim" class="control-label font-weight-bold">Instansi</label>
                        <div id="instansi_pengirim"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="no_hp_pengirim" class="control-label font-weight-bold">No. HP</label>
                        <div id="no_hp_pengirim"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="email_pengirim" class="control-label font-weight-bold">E-mail</label>
                        <div id="email_pengirim"></div>
                    </div>
                </div>
                <Hr>
                </Hr>
                <div class="form-row mb-3">
                    <button type="button" class="btn btn-grey waves-effect waves-light px-3 py-2 font-weight-bold btnClosePengirim"><i class="fas fa-angle-double-left"></i> KEMBALI </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!---------------------------- FORM UNTUK MELIHAT DATA PENGIRIM ------------------------------------>