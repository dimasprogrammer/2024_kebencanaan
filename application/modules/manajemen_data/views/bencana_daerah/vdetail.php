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
                                    <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab"><i class="fas fa-hand-holding-medical"></i>
                                        Korban Jiwa </a>
                                </li>

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#panel2" role="tab"><i class="fas fa-biohazard"></i> Kerusakan </a>
                                </li>

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#panel3" role="tab"><i class="fas fa-fish"></i> Ternak </a>
                                </li>

                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#panel4" role="tab"><i class="fas fa-dolly-flatbed"></i> Bantuan Tersalurkan </a>
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