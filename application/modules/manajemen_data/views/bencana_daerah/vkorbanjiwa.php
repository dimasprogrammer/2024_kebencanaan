<!-- Panel 1 -->
<div class="tab-pane fade in show active" id="panel1" role="tabpanel"><br>
    <div class="card-body mb-0">
        <div id="errEntry-korbanjiwa"></div>
        <form action="<?= site_url(isset($siteUri) ? $siteUri . '/create/korbanjiwa' : '') ?>" id="formEntry-korbanJiwa">
            <div class="table-responsive-md">
                <table cellspacing="0" class="table table-striped table-bordered table-sm table-hover mb-0" width="100%">
                    <thead>
                        <tr>
                            <th width="30%" class="font-weight-bold text-center align-middle" rowspan="2">Korban Jiwa</th>
                            <th class="font-weight-bold text-center align-middle" colspan="<?= count($kondisi_korban); ?>">Kondisi Korban</th>
                        </tr>
                        <tr>
                            <?php foreach ($kondisi_korban as $index => $item) : ?>
                                <th class="font-weight-bold text-center"><?php echo $item->nm_kondisi; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($master_data_korban as $index => $item) :
                            echo "<tr>";
                            echo "<td>" . $item['nm_jiwa'] . "</td>";
                            foreach ($kondisi_korban as $key => $list) :
                                echo '<td><input type="number" class="form-control form-control-sm text-right" value="0" min="0"
                                        onfocus="resetValueOnClick(this)" onfocusout="restoreValueOnClick(this)"
                                        name="jumlah_korban[' . $item['id'] . '][' . $list->id_kondisi . ']" 
                                        id="jumlah_korban-' . $item['id'] . '-' . $list->id_kondisi . '" required> </td>';
                            endforeach;
                            echo "</tr>";
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save-korban-jiwa"><i class="fas fa-check"></i> Simpan Data </button>
            </div>
        </form>
    </div>
</div>
<!-- Panel 1 -->