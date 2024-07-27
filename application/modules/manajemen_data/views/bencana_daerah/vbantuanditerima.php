<!-- Panel 4 -->
<div class="tab-pane fade" id="panel5" role="tabpanel">
    <div class="card-body mb-0">
        <div id="errEntry-diterima"></div>
        <form action="<?= site_url(isset($siteUri) ? $siteUri . '/create/diterima' : '') ?>" id="formEntry-diterima">
            <div class="row">
                <div class="col-lg-7 col-md-12 mb-3">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-bordered table-sm mb-0" width="100%">
                            <thead>
                                <tr>
                                    <th width="40%" class="font-weight-bold text-center">Jenis Bantuan Diterima</th>
                                    <th width="30%" class="font-weight-bold text-center">Satuan</th>
                                    <th width="30%" class="font-weight-bold text-center">Jumlah Bantuan Diterima</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no_urut = 0;
                                foreach ($bantuan_diterima as $key => $list) :
                                ?>
                                    <tr>
                                        <td><?php echo $list->nm_jenis_bantuan; ?></td>
                                        <td><?php echo $list->satuan; ?></td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right" 
                                                onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" value="0" min="0" 
                                                name="jml_bantuan_diterima[<?= $list->id_jenis_bantuan ?>]" id="jml_bantuan_diterima-<?= $list->id_jenis_bantuan ?>" 
                                            required>
                                        </td>
                                    </tr>
                                <?php

                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 mb-3">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-bordered table-sm mb-0" width="100%">
                            <thead>
                                <tr>
                                    <th width="50%" class="font-weight-bold text-center">Sumber Bantuan</th>
                                    <th width="20%" class="font-weight-bold text-center">Jumlah Bantuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no_urut = 0;
                                foreach ($jenis_sumber as $key => $list) :
                                ?>
                                    <tr>
                                        <td><?php echo $list->nm_jenis_bantuan; ?></td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right" 
                                                onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" value="0" min="0" 
                                                name="jml_sumber_diterima[<?= $list->id_jenis_bantuan ?>]" id="jml_sumber_diterima-<?= $list->id_jenis_bantuan ?>" 
                                            required>
                                        </td>
                                    </tr>
                                <?php

                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save-diterima"><i class="fas fa-check"></i> Simpan Data </button>
            </div>
        </form>
    </div>
</div>
<!-- Panel 4 -->