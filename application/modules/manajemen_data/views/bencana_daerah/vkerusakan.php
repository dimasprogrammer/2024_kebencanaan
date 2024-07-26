<!-- Panel 2 -->
<div class="tab-pane fade" id="panel2" role="tabpanel">
    <div class="card-body mb-0">
        <div id="errEntry-korbanjiwa"></div>
        <form action="<?= site_url(isset($siteUri) ? $siteUri . '/create/kerusakan' : '') ?>" id="formEntry-kerusakan">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-bordered table-sm mb-0" width="100%">
                            <thead>
                                <tr>
                                    <th width="40%" class="font-weight-bold text-center">Kerusakan Sarana</th>
                                    <th width="20%" class="font-weight-bold text-center">Rusak Berat</th>
                                    <th width="20%" class="font-weight-bold text-center">Rusak Sedang</th>
                                    <th width="20%" class="font-weight-bold text-center">Rusak Ringan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no_urut = 0;
                                foreach ($sarana_rusak as $key => $list) :
                                ?>
                                    <tr>
                                        <td><?php echo $list->nm_jenis_sarana; ?></td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right" onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" value="0" min="0" name="rusak_berat[<?= $list->id_jenis_sarana ?>]" id="rusak_berat-<?= $list->id_jenis_sarana ?>" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right" onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" value="0" min="0" name="rusak_sedang[<?= $list->id_jenis_sarana ?>]" id="rusak_sedang-<?= $list->id_jenis_sarana ?>" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right" onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" value="0" min="0" name="rusak_ringan[<?= $list->id_jenis_sarana ?>]" id="rusak_ringan-<?= $list->id_jenis_sarana ?>" required>
                                        </td>
                                    </tr>
                                <?php

                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="table-responsive-md" style="width: 50%;">
                        <table cellspacing="0" class="table table-striped table-bordered table-sm mb-3" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th colspan="<?= count($sarana_terendam) ?>" class="font-weight-bold text-center">Rumah Terendam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no_urut = 0;
                                foreach ($sarana_terendam as $key => $list) :
                                ?>
                                    <tr>
                                        <td width="75%" class="text-center align-middle font-weight-bold"><?php echo $list->nm_jenis_sarana; ?></td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right" onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" value="0" min="0" name="jml_terendam[<?= $list->id_jenis_sarana ?>]" id="jml_terendam-<?= $list->id_jenis_sarana ?>" required>
                                        </td>
                                    </tr>
                                <?php

                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-bordered table-sm mb-0" width="100%">
                            <thead>
                                <tr>
                                    <th colspan="<?= count($sarana_lainnya) ?>" class="font-weight-bold text-center">Sarana Lainnya</th>
                                </tr>
                                <tr>
                                    <?php $no_urut = 0;
                                    foreach ($sarana_lainnya as $key => $list) :
                                    ?>
                                        <th class="text-center align-middle font-weight-bold"><?php echo $list->nm_jenis_sarana; ?></th>
                                    <?php

                                    endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $no_urut = 0;
                                    foreach ($sarana_lainnya as $key => $list) :
                                    ?>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-right" onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)" value="0" min="0" name="jml_sarana_lainnya[<?= $list->id_jenis_sarana ?>]" id="jml_sarana_lainnya-<?= $list->id_jenis_sarana ?>" required>
                                        </td>
                                    <?php
                                    endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="table-responsive-md">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save-kerusakan"><i class="fas fa-check"></i> Simpan Data </button>
            </div>
        </form>
    </div>
</div>
<!-- Panel 2 -->