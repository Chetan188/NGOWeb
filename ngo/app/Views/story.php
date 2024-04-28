<?= $this->extend('header'); ?>
<?= $this->section('main_content'); ?>
<section id="main-slider" class="fixed-height" style="height:700px">      	
	<div class="slide-title-outter-wrapper">
		<div class="slide-title-inner-wrapper">
			<div class="slide-title align-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-offset-2 col-md-8">                                
							<div class="page-title">
								<div class="de-icon circle outline light large-size aligncenter animation fadeInUp">
									<i class="de-icon-heart"></i>
            					</div>
                             	<h1 class="animation fadeInUp"><?php echo $stories[0]['name']; ?></h1>
                               	<div class="heart-divider animation fadeInUp">
                            		<span class="white-line"></span>
                                	<i class="de-icon-heart pink-heart"></i>
                                	<i class="de-icon-heart white-heart"></i>
                                	<span class="white-line"></span>
                           		</div>
                              	<p class="animation delay1 fadeInUp">
                            		<?php echo $stories[0]['comment']; ?> 
                            	</p>
                            </div>                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="slides">
    	<div data-stellar-ratio="0.5" class="slide-image" style="background-image:url(public/<?php echo setting('story_banner'); ?>); background-position:top">
        </div>
        <div class="slide-overlay" style="opacity:0.25"> </div>                               
	</div>
</section>
<section id="content"><br><br>
	<div class="container">
      	<div class="row">
            <div class="col-md-12 text-center">
                <div class="page-subtitle animation fadeIn">
      				<h2><?php echo $stories[1]['name']; ?></h2>
              		<div class="heart-divider">
             			<span class="grey-line"></span>
                 		<i class="de-icon-heart pink-heart"></i>
                    	<i class="de-icon-heart grey-heart"></i>
                    	<span class="grey-line"></span>
            		</div>
                </div>
          	</div>
      	</div>
      	<div class="row">
        	<div class="col-md-offset-1 col-md-10 animation fadeIn">
            	<p><?php echo $stories[1]['comment']; ?> </p>
            </div>
       	</div>
  	</div>
  	<div class="divider-wrapper">
  		<div class="image-divider fixed-height" style="background-image:url(public/<?php echo setting('story_banner'); ?>); height:760px" data-stellar-background-ratio="0.5" >
  			<div class="divider-overlay" style="opacity:0.2"></div>
            <div class="alignment"> 
            	<div class="v-align center-middle">                  	
               		<div class="container">               
            			<div class="row">
                			<div class="col-md-offset-2 col-md-8">                                        
								<div class="de-icon circle outline light large-size aligncenter animation fadeInUp"><i class="de-icon-quote-1"></i></div>
                                <h2 class="animation fadeInUp"><?php echo $stories[2]['name']; ?></h2>
                                <div class="heart-divider animation fadeInUp">
                            		<span class="white-line"></span>
                                	<i class="de-icon-heart pink-heart"></i>
                                	<i class="de-icon-heart white-heart"></i>
                                	<span class="white-line"></span>
                            	</div>    
                                <p class="animation delay1 fadeInUp">
                            		<?php echo $stories[2]['comment']; ?> 
                            	</p>
             				</div>
                 		</div>
                	</div>
               	</div>
          	</div>
     	</div>
   	</div>
   	<div class="container">
      	<div class="row">
	        <div class="col-md-12 text-center">
	          	<div class="page-subtitle animation fadeIn">	
	    			<h2><?php echo $stories[3]['name']; ?></h2>
	          		<div class="heart-divider">
	         			<span class="grey-line"></span>
	             		<i class="de-icon-heart pink-heart"></i>
	                	<i class="de-icon-heart grey-heart"></i>
	                	<span class="grey-line"></span>
	        		</div>
	       		</div>
	      	</div>
	   	</div>
        <div class="row">
	    	<div class="col-md-offset-1 col-md-10 animation fadeIn">
	        	<p><?php echo $stories[3]['comment']; ?></p>                        
	        </div>
	  	</div>
    	<div class="row">                        
	    	<div class="col-md-offset-1 col-md-10" style="margin-top:50px">
	        	<img src="<?php echo base_url('public/'.setting('story_hugged')); ?>" alt="" class="fullwidth animation fadeIn">
	        </div>
	    </div>
    	<div class="row">                        
	        <div class="col-md-12 text-center" style="margin:100px 0 0 0">
	        	<h2 class="animation fadeIn"><?php echo $stories[4]['name']; ?></h2>
	        </div>
	    </div><br><br><br>
	</div>
</section>
<?= $this->endSection(); ?>