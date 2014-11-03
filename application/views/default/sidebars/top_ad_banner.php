<style>
.bhi-topscroll {
margin: 0 0 0 15px !important;
height:90px;
}

</style>
<div class="bhi-topscroll">
    <!--<div class="carousel slide carousel-fade" data-ride="carousel" id="inner-topad">
      <div class="carousel-inner">
        <?php $executive_ads = showAdsInArray('image', '650', '90', 15, 'span6',$this->uri->segment(1)); ?>
        <div class="item active ads300">
          <?php
                $initial_executive_ads_count = 0;
                $executive_ads_count = count($executive_ads);

                foreach ($executive_ads as $executive_ad) {
                    $initial_executive_ads_count++;
					
					echo '<div class="topad">';
                    echo $executive_ad;
					echo '</div>';
					
                    if ($initial_executive_ads_count % 1 == 0) {
                        if ($executive_ads_count > $initial_executive_ads_count) {
                            echo '</div>';
                            echo '<div class="item ads300">';
                        }
                    }
                }
          ?>
      </div>
    </div>
  </div>-->
      <div id="inner-topad" style="display:none;">
    <?php $executive_ads = showAdsInArray('image', '650', '90', 15, 'span6',$this->uri->segment(1)); ?>
    <?php
            foreach ($executive_ads as $executive_ad) {
                echo '<li>';
                echo $executive_ad;
                echo '</li>';
            }
      ?>
              
    </div>
</div>

<div class="clear">&nbsp;</div>
<?php
echo $this->session->flashdata('message') ? $this->session->flashdata('message') : '';
?>

