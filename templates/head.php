<head>
  <title><?php echo $page_title; ?></title>
  <link rel="shortcut icon" type="<?php echo $favicon_image_type; ?>" href="<?php echo $favicon_image_file; ?>"/>
  <?php 
    foreach ($stylesheets as $stylesheet) {
      echo "<link rel=\"stylesheet\" href=\"" . $stylesheet . "\">";
    }
  ?>
</head>