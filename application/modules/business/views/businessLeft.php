 <div class="leftSide" >
  <?php 
  // echo "<pre>";
  // print_r($busdetail);
  // exit();
  // die();
  ?>
<input style="width:100%;" type="text" name="search_name" placeholder="SEARCH BY NAME" id="search_name" onkeyup=" return searchByName(this.value)">
    <ul class="leftmenu" id="leftMenu">
       
        <span style="display:none;" id="myloading"><img src="<?php echo base_url();?>assects/images/image.gif"></span>
              <?php if(!empty($busdetail)){foreach ($busdetail as $key3 => $value3) {?>
        <li><a href="<?php echo base_url(); ?>business/dashboard/editbabapanel/<?php echo $value3->a_BusnAdminId; ?>" class="" ><?php echo $value3->t_FirstName.' '.$value3->t_LastName ;?></a>
        </li>
      <?php }}else echo "No records Founds" ?>
    </ul>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>/assects/js/search_business_name.js"></script>


