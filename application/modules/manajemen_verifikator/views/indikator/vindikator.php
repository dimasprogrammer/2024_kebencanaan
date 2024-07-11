<!-- Section: Table -->
<section>
    <div id="errSuccess"></div>
    <div class="row">
        <div class="col-xl-12 col-md-12">

            <div class="card mb-4">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold" width="12%"><strong>Nama Instansi</strong></th>
                                <th class="font-weight-bold" width="1%"><strong>:</strong></th>
                                <th class="font-weight-bold"><strong><?php echo $token_inovasi['opd_id_name']; ?></strong></th>
                            </tr>
                            <tr>
                                <th class="font-weight-bold" width="12%"><strong>Nama Inovasi</strong></th>
                                <th class="font-weight-bold" width="1%"><strong>:</strong></th>
                                <th class="font-weight-bold"><strong><?php echo $token_inovasi['nama_inovasi']; ?></strong></th>
                            </tr>
                            <tr>
                                <th class="font-weight-bold" width="12%"><strong>Skor Kematangan</strong></th>
                                <th class="font-weight-bold" width="1%"><strong>:</strong></th>
                                <th class="font-weight-bold">
                                    <strong>
                                        <?php $dataBobot = $this->mindi->getSkorKematanganCheck($token_inovasi['token']);
                                        echo $dataBobot['info']; ?>
                                    </strong>
                                </th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Table UI -->

    <div class="card card-cascade narrower z-depth-0">

        <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

            <div>
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-th-large mt-0"></i></button>
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fas fa-columns mt-0"></i></button>
            </div>

            <a href="" class="white-text mx-3">TABEL INDIKATOR SATUAN INOVASI DAERAH</a>

            <div>
                <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" href="<?php echo site_url() . 'manajemen_verifikator/inovasi/'; ?>"> <i class="fas fa-angle-double-left mt-0"></i> KEMBALI </a>
                <a type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" onclick="window.location.reload(true);"> <i class="fab fa-foursquare"></i> REFRESH </a>
            </div>

        </div>

        <div class="px-4">

            <div class="table-responsive">

                <!--Table-->
                <table class="table table-hover mb-0" width="100%">

                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th width="2%" class="font-weight-bold"><a>No. </i></a></th>
                            <th width="6%" class="font-weight-bold"><a>Indikator</i></a></th>
                            <th width="15%" class="font-weight-bold"><a>Keterangan</i></a></th>
                            <th width="6%" class="font-weight-bold"><a>Informasi</i></a></th>
                            <th width="6%" class="font-weight-bold"><a>Bobot</i></a></th>
                            <th width="12%" class="font-weight-bold"><a>Pilih Parameter</i></a></th>
                            <th width="15%" class="font-weight-bold"><a>Data Pendukung</i></a></th>
                            <th width="6%" class="font-weight-bold"><a>Jenis File</i></a></th>
                            <th width="6%" class="font-weight-bold"><a>Catatan</i></a></th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                        <?php echo form_hidden('tokenId', $token_inovasi['token']); ?>
                        <?php $no_urut = 0;
                        foreach ($list_indikator as $key => $list) :
                            $id_indikator = !empty($list) ? $list->id_indikator : 0;
                            $jenis_dokumen = !empty($list) ? $list->jenis_dokumen : 0;
                            $this->db->select('a.id_indikator_nilai, a.id_indikator_satuan, b.bobot_satuan');
                            $this->db->from('ms_indikator_nilai a');
                            $this->db->join('cx_indikator_satuan b', 'a.id_indikator_satuan = b.id_indikator_satuan', 'inner');
                            $this->db->where('a.id_indikator', $id_indikator);
                            $this->db->where('a.token', $token_inovasi['token']);
                            $this->db->limit(1);
                            $dataNilai = $this->db->get();
                            if ($dataNilai->num_rows() <= 0) {
                                $parameter = '<span class="badge bg-danger">Paramater Belum Ada</span>';
                                $btn = 1;
                                $bobot_satuan = '';
                                $btnDeleteParameter = '';
                            } else {
                                $bobot_satuan = !empty($dataNilai->row_array()) ? $dataNilai->row_array()['bobot_satuan'] : 0;
                                $btn = 2;
                                $parameter = '<span class="badge bg-success">Paramater Ada</span>';
                                $btnDeleteParameter = '<button type="button" class="btn btn-danger btn-sm px-2 py-1 mt-2 my-0 mx-0 waves-effect waves-light btnDeleteParameter" data-id="' . $this->encryption->encrypt($dataNilai->row_array()['id_indikator_nilai']) . '" title="Hapus data"><i class="fas fa-trash-alt"></i> Hapus Paramater </button>';
                            }
                            $bobot_indikator = $list->bobot;
                            $total_bobot = !empty($bobot_satuan) ? $bobot_satuan * $bobot_indikator : $bobot_indikator;
                            $no_urut++;
                            $checkDataUpload = $this->mindi->cekDokumenPendukung($token_inovasi['token'], $id_indikator);
                            $btnUpload = $checkDataUpload->num_rows();

                            $checkDataLink = $this->mindi->cekDokumenLink($token_inovasi['token'], $id_indikator);
                            $btnURL =  $checkDataLink->num_rows();

                            $viewTotalBobot = ($btnUpload <= 0 && $btnURL <= 0) ? 0 : $total_bobot;

                            $keteranganBobot = ($btnUpload <= 0 && $btnURL <= 0) ? '<small class="text-danger"> Upload File Untuk Melihat Total Bobot </small>' : '';
                            $id_indikator;
                            // print_r($checkDataUpload->row_array());
                            // die;
                            if ($jenis_dokumen == 1) {

                                if ($btnUpload <= 0) {
                                    $btnDeleteFile = '';
                                    $btnCheck = '<button type="button" class="btn btn-magenta btn-sm px-2 py-1 mt-2 my-0 mx-0 waves-effect waves-light btnUpload" data-id="' . $id_indikator . '" title="Upload File"><i class="fas fa-archive"></i> Upload File</button>';
                                } else {
                                    $year       = date('Y', strtotime($checkDataUpload->row_array()['create_date']));
                                    $month      = date('m', strtotime($checkDataUpload->row_array()['create_date']));
                                    $btnCheck = '<a class="btn btn-primary btn-sm px-2 py-1 mt-2 my-0 mx-0" href="' . base_url('dokumen/pendukung/' . $year . '/' . $month . '/' . $checkDataUpload->row_array()['nama_file']) . '">Download File</a>';
                                    $btnDeleteFile = '<button type="button" class="btn btn-danger btn-sm px-2 py-1 mt-2 my-0 mx-0 waves-effect waves-light btnDeleteFile" data-id="' . $checkDataUpload->row_array()['id_indikator_file'] . '" title="Delete File"><i class="fas fa-trash-alt"></i> Delete File</button>';
                                }
                            } else {
                                if ($btnURL <= 0) {
                                    $btnDeleteFile = '';
                                    $btnCheck = '<button type="button" class="btn btn-magenta btn-sm px-2 py-1 mt-2 my-0 mx-0 waves-effect waves-light btnLink" data-id="' . $id_indikator . '" title="Upload Link"><i class="fas fa-archive"></i> Link Youtube </button>';
                                } else {
                                    $btnCheck = '<a class="btn btn-primary btn-sm px-2 py-1 mt-2 my-0 mx-0" target="_blank" href="' . $checkDataLink->row_array()['link_youtube'] . '">Lihat Video</a>';
                                    $btnDeleteFile = '<button type="button" class="btn btn-danger btn-sm px-2 py-1 mt-2 my-0 mx-0 waves-effect waves-light btnDeleteLink" data-id="' . $checkDataLink->row_array()['id_indikator_link'] . '" title="Delete Link"><i class="fas fa-trash-alt"></i> Delete Link</button>';
                                }
                            }

                            $checkCatatan = $this->mindi->cekCatatan($token_inovasi['token'], $id_indikator);
                            if ($checkCatatan->num_rows() <= 0) {
                                $btnCatatan = '<button type="button" class="btn btn-primary btn-sm px-2 py-1 mt-2 my-0 mx-0 waves-effect waves-light btnCatatan" data-id=' . $list->id_indikator . ' title="Isi Catatan"><i class="far fa-check-square"></i> Check </button>';
                            } else {
                                $btnCatatan = $checkCatatan->row_array()['catatan'];
                            }


                        ?>
                            <tr>
                                <td><?php echo $no_urut; ?></td>
                                <td><?php echo $list->nm_indikator; ?><BR> Bobot: <b> <?php echo $list->bobot; ?></b></td>
                                <td><?php echo $list->keterangan; ?></td>
                                <td><?php echo $list->informasi; ?></td>
                                <td><?php echo $viewTotalBobot; ?> <br> <?php echo $keteranganBobot; ?></td>

                                <td>
                                    <?php echo $parameter; ?>
                                    <br>
                                    <?php echo $btnDeleteParameter; ?>
                                    <?php if ($btn == 1) {
                                    ?>
                                        <button type="button" class="btn btn-magenta btn-sm px-2 py-1 mt-2 my-0 mx-0 waves-effect waves-light btnEditParamater" data-id='<?php echo $list->id_indikator; ?>' title="Pilih Parameter"><i class="fas fa-pencil-alt"></i> Entri Parameter </button>
                                    <?php
                                    } ?>

                                </td>
                                <td><?php echo $list->data_pendukung; ?> <br>
                                    <?php echo $btnCheck; ?>
                                    <?php echo $btnDeleteFile; ?>
                                </td>
                                <td><?php echo $list->jenis_file; ?></td>
                                <td><?php echo $btnCatatan; ?></td>
                            </tr>
                        <?php
                        endforeach; ?>
                    </tbody>
                    <!-- Table body -->

                </table>
                <!-- Table -->

            </div>

        </div>

    </div>

</section>
<!--Section: Table-->

<div class="modal fade" id="modalEntryForm" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntry">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Parameter </h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/createNilai' : ''), array('id' => 'formEntry', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenIno', $token_inovasi['token']); ?>
                <?php echo form_hidden('tokenId', ''); ?>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="id_indikator_satuan" class="control-label font-weight-bold">Pilih Parameter <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('id_indikator_satuan', array('' => 'Pilih Indikator '), $this->input->post('id_indikator_satuan', TRUE), 'class="form-control select-all" id="id_indikator_satuan" style="width:100%" required=""'); ?>
                        <div class="invalid-feedback"></div>
                    </div>
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

<div class="modal fade" id="modalEntryFormFile" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryFile">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Dokumen Pendukung</h4>
                <button type="button" class="close btnCloseFile" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/createFile' : ''), array('id' => 'formEntryFile', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntryFile"></div>
                <?php echo form_hidden('tokenIno', $token_inovasi['token']); ?>
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
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseFile"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="saveFile" id="saveFile"><i class="fas fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEntryFormLink" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmEntryLink">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Dokumen Pendukung</h4>
                <button type="button" class="close btnCloseLink" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/createLink' : ''), array('id' => 'formEntryLink', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntryLink"></div>
                <?php echo form_hidden('tokenIno', $token_inovasi['token']); ?>
                <?php echo form_hidden('tokenId', ''); ?>

                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="link_youtube" class="control-label font-weight-bold">Link Youtube <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="link_youtube" id="link_youtube" placeholder="Link Youtube" value="<?php echo $this->input->post('link_youtube', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseLink"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="saveLink" id="saveLink"><i class="fas fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEntryFormCatatan" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="frmEntryCatatan">
        <div class="modal-content">
            <div class="modal-header blue-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Catatan </h4>
                <button type="button" class="close btnCloseCatatan" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart(site_url(isset($siteUri) ? $siteUri . '/createCatatan' : ''), array('id' => 'formEntryCatatan', 'class=' => 'needs-validated', 'novalidate' => '')); ?>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenIno', $token_inovasi['token']); ?>
                <?php echo form_hidden('tokenId', ''); ?>

                <div class="col-12 col-md-12 required">
                    <!-- <label for="catatan" class="control-label font-weight-bold">Rancang Bangun (Minimal 300 Kata) <span class="text-danger">*</span></label> -->
                    <textarea class="form-control" name="catatan" id="catatan" value="<?= $this->input->post('catatan', TRUE); ?>" rows="3"></textarea>

                    <div class="invalid-feedback"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnCloseCatatan"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="saveCatatan" id="saveCatatan"><i class="fas fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>