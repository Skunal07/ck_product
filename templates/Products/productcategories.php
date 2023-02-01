   <!-- ======= Works Section ======= -->
   <section class="section site-portfolio">
       <div class="container">
           <div class="row mb-5 align-items-center">
               <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
                   <h2>Hey, I'm Johan Stanworth</h2>
                   <p class="mb-0">Freelance Creative &amp; Professional Graphics Designer</p>
               </div>
               <div class="col-md-12 col-lg-6 text-start text-lg-end" data-aos="fade-up" data-aos-delay="100">
                   <div id="filters" class="filters">
                    <?php 
                    if($id == 0){
                        echo $this->Html->link(__("All"), ['action' => 'productcategories'], ['class' => 'side-nav-link active profile-edit-btn']); 
                    }else{
                        echo $this->Html->link(__("All"), ['action' => 'productcategories'], ['class' => 'side-nav-link profile-edit-btn']); 
                    }
                        ?>
                       <?php
                        $count = 0;
                        foreach ($productc as $productc) : ?>
                           <?php
                            $count++;
                            if ($id == $productc->id) {
                                echo $this->Html->link(__($productc->category_name), ['action' => 'productcategories', $productc->id], ['class' => 'side-nav-link active profile-edit-btn']);
                            } else {
                                echo $this->Html->link(__($productc->category_name), ['action' => 'productcategories', $productc->id], ['class' => 'side-nav-link  profile-edit-btn']);
                            }
                            if ($count == 5) {
                                break;
                            }
                            ?>
                       <?php endforeach; ?>
                   </div>
               </div>
           </div>
           <div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">
               <?php foreach ($products as $product) : ?>

                   <div class="item web col-sm-6 col-md-4 col-lg-4 mb-4">
                       <a href="http://localhost:8765/products/view/<?= $product->id ?>" class="item-wrap fancybox">
                           <div class="work-info">
                               <span><?= $product->product_title ?></span>
                           </div>
                           <?= $this->Html->image(h($product->product_image), array('width' => '200px', 'class' => 'aimage')) ?>
                       </a>
                   </div>
               <?php endforeach; ?>

           </div>
       </div>
   </section><!-- End  Works Section -->

   <!-- ======= Clients Section ======= -->
   <section class="section">
       <div class="container">
           <div class="row justify-content-center text-center mb-4">
               <div class="col-5">
                   <h3 class="h3 heading">My Clients</h3>
                   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit explicabo inventore.</p>
               </div>
           </div>
           <div class="row">
               <div class="col-4 col-sm-4 col-md-2">
                   <a href="#" class="client-logo"><img src="/img/logo-adobe.png" alt="Image" class="img-fluid"></a>
               </div>
               <div class="col-4 col-sm-4 col-md-2">
                   <a href="#" class="client-logo"><img src="/img/logo-uber.png" alt="Image" class="img-fluid"></a>
               </div>
               <div class="col-4 col-sm-4 col-md-2">
                   <a href="#" class="client-logo"><img src="/img/logo-apple.png" alt="Image" class="img-fluid"></a>
               </div>
               <div class="col-4 col-sm-4 col-md-2">
                   <a href="#" class="client-logo"><img src="/img/logo-netflix.png" alt="Image" class="img-fluid"></a>
               </div>
               <div class="col-4 col-sm-4 col-md-2">
                   <a href="#" class="client-logo"><img src="/img/logo-nike.png" alt="Image" class="img-fluid"></a>
               </div>
               <div class="col-4 col-sm-4 col-md-2">
                   <a href="#" class="client-logo"><img src="/img/logo-google.png" alt="Image" class="img-fluid"></a>
               </div>

           </div>
       </div>
   </section><!-- End Clients Section -->

   </main>
   <?= $this->Html->css('productc', ["block" => 'css']);
