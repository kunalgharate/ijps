<?php
			$this->load->view('layout/header');
		?>
<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
         <section class="products-area ptb-100">
            <div class="container">
                <div class="psylo-grid-sorting row align-items-center">
                    
                    <div class="col-lg-4 col-md-6 ordering"></div>
                    <div class="col-lg-4 col-md-6 ordering"></div>
                    <div class="col-lg-4 col-md-6 ordering">
                       <form class="search-form" method="post" action="<?php echo base_url('reference-books'); ?>">
                            <input type="search" name="search_queyr" class="search-field" placeholder="Search...">

                            <button type="submit"><i class='bx bx-search-alt'></i></button>
                        </form>
                    </div>
                </div>
                
                <div class="row">
                    <?php 
                    
                    if(!empty($referenceList)) {
                        foreach($referenceList as $key=>$rowValue){ 
                            if(!empty($rowValue['image'])){ ?>
                            <div class="col-lg-3 col-md-6">
                        <div class="products-item">
                            <div class="products-image">
                                <a href="<?php echo base_url('view-book/'.$rowValue['id']) ?>"><img src="<?php echo base_url('uploads/reference/'.$rowValue['image'])?>" alt="image"></a>
    
                                <div class="action-btn">
                                    <a href="<?php echo base_url('view-book/'.$rowValue['id']) ?>" class="default-btn">View<i class="flaticon-pointer"></i></a>
                                </div>
                            </div>
    
                            <div class="products-content">
                                <h3>
                                    <a href="<?php echo base_url('view-book/'.$rowValue['id']) ?>"><?php echo $rowValue['title']; ?></a>
                                </h3>
                               
                            </div>
                        </div>
                    </div>
                   
                        <?php } }
                    }
                    ?>
                      </div>
                    	<?php echo $pagination_links;?>
               

                <!--<div class="book-store-btn">-->
                <!--    <a href="#" class="default-btn">Load More <i class="flaticon-spinner-of-dots"></i></a>-->
                <!--</div>-->
            </div>

            <div class="products-main-shape">
                <img src="<?php echo base_url('images/pricing-shape.png')?>" alt="image">
            </div>
        </section>
        <?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>