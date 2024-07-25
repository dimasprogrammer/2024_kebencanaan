<section class="mb-5 pb-4 mt-4 text-sm">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <?php echo form_open('', array('id' => 'formEntry', 'class='=>'needs-validated', 'novalidate'=>'')) . form_close(); ?>
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

                                <li class="nav-item waves-effect waves-light" onclick="activeTabSet(1)">
                                    <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab"><i class="fas fa-hand-holding-medical"></i>
                                        Korban Jiwa </a>
                                </li>

                                <li class="nav-item waves-effect waves-light" onclick="activeTabSet(2)">
                                    <a class="nav-link" data-toggle="tab" href="#panel2" role="tab"><i class="fas fa-biohazard"></i> Kerusakan </a>
                                </li>

                                <li class="nav-item waves-effect waves-light" onclick="activeTabSet(3)">
                                    <a class="nav-link" data-toggle="tab" href="#panel3" role="tab"><i class="fas fa-fish"></i> Ternak </a>
                                </li>

                                <li class="nav-item waves-effect waves-light" onclick="activeTabSet(4)">
                                    <a class="nav-link" data-toggle="tab" href="#panel4" role="tab"><i class="fas fa-dolly-flatbed"></i> Bantuan Tersalurkan </a>
                                </li>

                                <li class="nav-item waves-effect waves-light" onclick="activeTabSet(5)">
                                    <a class="nav-link" data-toggle="tab" href="#panel5" role="tab"><i class="fas fa-envelope"></i> Bantuan Diterima </a>
                                </li>

                                <li class="nav-item waves-effect waves-light" onclick="activeTabSet(6)">
                                    <a class="nav-link" data-toggle="tab" href="#panel6" role="tab"><i class="fas fa-users"></i> Bantuan Relawan </a>
                                </li>

                            </ul>

                            <!-- Tab panels -->
                            <div class="tab-content">
                                <div class="tab-date mt-5 px-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="data_date">Kelurahan/Nagari/Desa</label>
                                                <?php echo form_dropdown('wil_village', isset($data_village) ? $data_village : array('' => 'Pilih Kelurahan/ Nagari/ Desa '),'', 
                                                    'class="form-control select-all" id="wil_village" style="width:100%" required=""'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="data_date">Periode Data</label>
                                                <input type="datetime-local" class="form-control" name="data_date" id="data_date" style="background-color: white;" required>
                                                <?php echo form_hidden('token_bencana_detail', $token['token_bencana_detail']); ?>
                                            </div>
                                            <div class="form-group text-right">
                                                <button class="btn btn-primary btn-sm" id="btn-refresh-korban-jiwa">Refresh</button>
                                            </div>
                                        </div>
                                        <div class="col-md-4 align-middle" style="background-color: #f5f5f5; vertical-align: middle; padding: 18px; border-radius: 10px;">
                                            Kelurahan/Nagari/Desa : <span id="label-kelnagdes"></span> <br />
                                            Periode Data terakhir : <span id="label-waktu_data"></span> <br />
                                            Waktu Input terakhir : <span id="label-waktu_input"></span> 
                                        </div>
                                    </div>
                                </div>

                                <?php echo $vkorbanjiwa; ?>

                                <?php echo $vkerusakan; ?>

                                <?php echo $vternak; ?>

                                <?php echo $vbantuantersalurkan; ?>

                                <?php echo $vbantuanditerima; ?>

                                <?php echo $vbantuanrelawan; ?>

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