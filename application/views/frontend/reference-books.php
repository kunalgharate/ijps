<?php
			$this->load->view('layout/header');
		?>
			<title>Reference Books | International Journal of Pharmaceutical Sciences</title>
			<meta name="description" content="Download top pharmacy & medical reference books in PDF. National & international authors, instant access."/>
			<meta name="keywords" content="medical reference books, pharmacy reference books, medical ebooks, pharmacy ebooks, PDF books, pharmacology, pharmacokinetics, drug interactions, therapeutics, anatomy, physiology"/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/reference-books">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="International Journal of Pharmaceutical Sciences">
			<meta property="og:site_name" content="ijpsjournal" >
			<meta property="og:url" content="https://www.ijpsjournal.com/reference-books">
			<meta property="og:description" content="Get the medical & pharmacy knowledge you need. PDF reference books from top authors, easily accessible.">
			<meta property="og:type" content="article">
			<meta property="og:image" content="https://www.ijpsjournal.com/uploads/reference/ross_and_wilson2.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@int_j_pharm_sci">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="Download top pharmacy & medical reference books in PDF. National & international authors, instant access.">
			<meta name="twitter:image" content="https://www.ijpsjournal.com/uploads/reference/ross_and_wilson2.jpg">
			
<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
<!-- Start Products Details Area -->
<section class="products-details-area ptb-100">
            
            <div class="container">
                
                <div class="row align-items-start">
                    <div class="col-lg-6 col-md-12">
                        <div class="products-details-slides">
                            <div class="products-feedback">
                               
                                    <div class="item">
                                        <div class="products-image">
                                            <img src="<?php echo base_url('uploads/reference/'.$bookList[0]['image'])?>" alt="image" width='500' height='500'>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="">
                            <h3><?php echo $bookList[0]['title']; ?></h3>
                            <p class="text-justify"><?php echo $bookList[0]['description']; ?> </p>

                            <div class="products-add-to-cart">
                                <button type="submit" class="default-btn" ><a href="<?php echo $bookList[0]['url']; ?>" target='_blank'>Download<i class="bx bx-download"></i></a></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>

            <div class="products-details-shape">
                <img src="<?php echo base_url('images/line-shape.png')?>" alt="image">
            </div>
        </section>
        <!-- End Products Details Area -->

        <!-- Start Products Area -->
        <section class="products-area pb-70 mt-5 mb-5">
            <div class="container-fluid">
                <div class="section-title">
                    <h2>Related Books</h2>
                    <p>Read the National and International reference books from the medical and pharmaceutical field.</p>
                </div>

                <div class="products-slides owl-carousel owl-theme">
                    
                    <?php
                    
                    //echo "<pre>";print_r($randomBooks);
                   foreach($randomBooks as  $key=> $rowValue){ ?>
                         <div class="products-item">
                        <div class="products-image">
                            <a href="<?php echo base_url('view-book/'.$rowValue['id']) ?>"><img src="<?php echo base_url('uploads/reference/'.$rowValue['image'])?>" alt="image"></a>

                            <div class="action-btn">
                                <a href="<?php echo base_url('view-book/'.$rowValue['id']) ?>" class="default-btn">View<i class="flaticon-pointer"></i></a>
                            </div>
                        </div>
                        
                    </div>
                    
                    <?php } ?>
                   

                   

                   
                </div>
            </div>

            <div class="products-main-shape">
                 <img src="<?php echo base_url('images/pricing-shape.png')?>" alt="image">
            </div>
        </section>
        <!-- End Products Area -->
        <?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>