<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#btn-db-increment-count").click(function(){
      $.ajax({
        type: 'POST',
        data:{
          username: "guest",
          password: "guest"
        },
        url: 'api/count',
        success: function(data) {
            $("#lbl-db-count").text(data);
        }
      });
    });
  });
</script>

<div class="w3-content" style="max-width:1500px">
  <div class="w3-opacity">
    <header class="w3-center w3-margin-bottom">
      <h1>Welcome to LAMP site</h1>
    </header>
  </div>
</div>
<div class="w3-content" style="max-width:1500px">
  <div class="w3-opacity w3-center">
    <?php
    require_once(__DIR__ . '/../../vendor/autoload.php');
    $db = LampSite\Database::getInstance(); 
    if ($db->isConnected()): ?>
      <h2>Database is connected</h2>
      <button id="btn-db-increment-count">Click Me</button>
      <p>Db click count: 
        <span id="lbl-db-count">
          <?php echo $db->getCount("guest", "guest"); ?>
        </span>
      </p>
    <?php else: ?>
      <h2>Database failed to connect</h2>
    <?php endif; unset($db); ?>
  </div>
</div>