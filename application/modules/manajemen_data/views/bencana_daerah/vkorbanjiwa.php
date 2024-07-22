<!-- Panel 1 -->
                                <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="30%" class="font-weight-bold text-center">Kondisi Korban Jiwa</th>
                                                        <th width="30%" class="font-weight-bold text-center">Korban Jiwa</th>
                                                        <th width="30%" class="font-weight-bold text-center">Jumlah Korban Jiwa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php echo form_hidden('tokenId', $token['token_bencana_detail']); ?>
                                                    <?php echo form_hidden('tokenId', $token['token_bencana']); ?>
                                                    <?php $no_urut = 0;
                                                    foreach ($kondisi_korban as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td rowspan="<?= count($master_data_korban); ?>" class="text-center align-middle">
                                                                <?php echo $list->nm_kondisi; ?>
                                                            </td>
                                                            <td><?php echo $master_data_korban[0]['nm_jiwa']; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jumlah_korban" id="jumlah_korban" required> </td>
                                                        </tr>
                                                    <?php
                                                        foreach ($master_data_korban as $key => $item) :

                                                            if ($key > 0) {
                                                                echo "<tr>";
                                                                echo "<td>" . $item['nm_jiwa'] . "</td>";
                                                                echo '<td><input type="number" class="form-control" value="0" name="jumlah_korban" id="jumlah_korban" required> </td>';
                                                                echo "</tr>";
                                                            }
                                                        endforeach;

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Simpan Data </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Panel 1 -->