<!-- Panel 3 -->
<div class="tab-pane fade" id="panel3" role="tabpanel">
    <div class="card-body mb-0">
        <div id="errEntry-ternak"></div>
        <form action="<?= site_url(isset($siteUri) ? $siteUri . '/create/ternak' : '') ?>" id="formEntry-ternak">
            <div class="row">
                <div class="col-lg-12 col-md-12 mb-3">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-bordered table-sm mb-0" width="100%">
                            <thead>
                                <tr>
                                    <th width="50%" class="font-weight-bold text-center align-middle">Jenis Ternak</th>
                                    <th width="50%" class="font-weight-bold text-center align-middle">Jumlah Ternak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no_urut = 0;
                                foreach ($jenis_ternak as $key => $list) :
                                ?>
                                    <tr>
                                        <td><?php echo $list->nm_jenis_ternak; ?></td>
                                        <td><input type="number" class="form-control form-control-sm text-right" onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" value="0" min="0" name="jumlah_ternak[<?= $list->id_jenis_ternak ?>]" id="jumlah_ternak-<?= $list->id_jenis_ternak ?>" required> </td>
                                    </tr>
                                <?php

                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save-ternak"><i class="fas fa-check"></i> Simpan Data </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Panel 3 -->