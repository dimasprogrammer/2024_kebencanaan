<!-- Sidebar navigation -->
<!-- <div id="slide-out" class="side-nav sn-bg-2 fixed"> -->
<div id="slide-out" class="side-nav fixed">
    <ul class="custom-scrollbar">

        <!-- Logo -->
        <!-- <li class="logo-sn waves-effect py-3">
            <div class="text-center">

                <?= $this->asset->image((isset($appIcon) ? $appIcon : ''), '', array('alt' => 'logo-provinsi-sumbar', 'class' => 'mr-1 ml-1')); ?>

            </div>
        </li> -->

        <!-- Search Form -->
        <li class="mt-3">
            <div class="text-center">
                <h5 class="dark-grey-text"><img style="width: 8%; height:20px;" src="<?php echo base_url('assets/img/logo_sumbar.png'); ?>" alt="">Data Bencana</h5>
            </div>
        </li>
        <hr>

        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <?= $this->app_loader->create_menu(); ?>
            </ul>
        </li>
        <!-- Side navigation links -->

    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
<!-- Sidebar navigation -->