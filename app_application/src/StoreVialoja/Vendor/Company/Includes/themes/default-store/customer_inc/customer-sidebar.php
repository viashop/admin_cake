<section id="columns" class="offcanvas-siderbars">
    <div class="container">
        
        <?php
        App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'default-store'. DS .'customer_inc'. DS .'breadcrumbs');
        ?>

        <div class="row col2-left-layout">

            <?php
            App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'default-store'. DS .'customer_inc'. DS .'aside-left');
            ?>
			
            <!-- BEGIN - Content -->
            <?php
            echo $this->Session->flash();
            echo $this->fetch('content');
            ?>
            <!-- END -Content -->
				
        </div>
    </div>
</section>