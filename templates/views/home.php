<div class="w3-content" style="max-width:1500px">
  <div class="w3-opacity">
    <header class="w3-center w3-margin-bottom">
      <h1>Welcome to LAMP site</h1>

      <h2><?php
        require_once('../vendor/autoload.php');
        $db = LampSite\Database::getInstance();
        if ($db->isConnected()){
          echo "<h2>Database is connected";
        } else {
          echo "Database failed to connect";
        }
      ?></h2>

    </header>
  </div>
</div>