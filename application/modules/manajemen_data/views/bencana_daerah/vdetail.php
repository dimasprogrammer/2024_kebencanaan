<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="card-body mb-0">
                    <!-- Grid row -->
                    <div class="row mb-1">
                        <!-- Grid column -->
                        <div class="col-md-12 mb-1">

                            <!-- Nav tabs -->
                            <ul class="nav md-tabs nav-justified indigo" role="tablist">

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab"><i class="fas fa-user"></i>
                                        Korban Jiwa </a>
                                </li>

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#panel2" role="tab"><i class="fas fa-biohazard"></i> Kerusakan </a>
                                </li>

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#panel3" role="tab"><i class="fas fa-envelope"></i> Ternak </a>
                                </li>

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#panel4" role="tab"><i class="fas fa-envelope"></i> Bantuan Tersalurkan </a>
                                </li>

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#panel5" role="tab"><i class="fas fa-envelope"></i> Bantuan Diterima </a>
                                </li>

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#panel6" role="tab"><i class="fas fa-envelope"></i> Bantuan Relawan </a>
                                </li>

                            </ul>

                            <!-- Tab panels -->
                            <div class="tab-content">

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

                                <!-- Panel 2 -->
                                <div class="tab-pane fade" id="panel2" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-center">Kerusakan Sarana</th>
                                                        <th width="20%" class="font-weight-bold text-center">Rusak Berat</th>
                                                        <th width="20%" class="font-weight-bold text-center">Rusak Sedang</th>
                                                        <th width="20%" class="font-weight-bold text-center">Rusak Ringan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php echo form_hidden('tokenId', $token['token_bencana_detail']); ?>
                                                    <?php echo form_hidden('tokenId', $token['token_bencana']); ?>
                                                    <?php $no_urut = 0;
                                                    foreach ($sarana_rusak as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_sarana; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_berat" id="rusak_berat" required> </td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_sedang" id="rusak_sedang" required> </td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_ringan" id="rusak_ringan" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-left">Rumah Terendam</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($sarana_terendam as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_sarana; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_berat" id="rusak_berat" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <br>
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-left">Sarana Lainnya</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($sarana_lainnya as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_sarana; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_berat" id="rusak_berat" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Simpan Data </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Panel 2 -->

                                <!-- Panel 3 -->
                                <div class="tab-pane fade" id="panel3" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="50%" class="font-weight-bold text-left">Jenis Ternak</th>
                                                        <th width="50%" class="font-weight-bold text-left">Jumlah Ternak</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($jenis_ternak as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_ternak; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jumlah_ternak" id="jumlah_ternak" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Simpan Data </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Panel 3 -->

                                <!-- Panel 3 -->
                                <div class="tab-pane fade" id="panel4" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-left">Jenis Bantuan</th>
                                                        <th width="30%" class="font-weight-bold text-left">Satuan</th>
                                                        <th width="30%" class="font-weight-bold text-left">Jumlah Bantuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($bantuan_diterima as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_bantuan; ?></td>
                                                            <td><?php echo $list->satuan; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jml_bantuan" id="jml_bantuan" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="50%" class="font-weight-bold text-left">Sumber Bantuan</th>
                                                        <th width="20%" class="font-weight-bold text-left">Sumber Bantuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($jenis_sumber as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_bantuan; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jml_bantuan" id="jml_bantuan" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Simpan Data </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Panel 3 -->

                                <!-- Panel 3 -->
                                <div class="tab-pane fade" id="panel5" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-left">Jenis Bantuan</th>
                                                        <th width="30%" class="font-weight-bold text-left">Satuan</th>
                                                        <th width="30%" class="font-weight-bold text-left">Jumlah Bantuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($bantuan_disalurkan as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_bantuan; ?></td>
                                                            <td><?php echo $list->satuan; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jml_bantuan" id="jml_bantuan" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="50%" class="font-weight-bold text-left">Sumber Bantuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($jenis_sumber as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_bantuan; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jml_bantuan" id="jml_bantuan" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Simpan Data </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Panel 3 -->

                                <!-- Panel 3 -->
                                <div class="tab-pane fade" id="panel6" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-left">Nama Organisasi</th>
                                                        <th width="30%" class="font-weight-bold text-left">Jumlah Relawan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="number" class="form-control" value="0" name="nama_organisasi" id="nama_organisasi" required> </td>
                                                        <td><input type="number" class="form-control" value="0" name="jml_relawan" id="jml_relawan" required> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Simpan Data </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Panel 3 -->


                            </div>

                        </div>
                        <!-- Grid column -->

                    </div>
                    <!-- Grid row -->
                </div>
            </div>
        </div>
    </div>
</section>