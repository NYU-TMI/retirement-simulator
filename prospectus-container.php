<?php

session_start();
$year = $_SESSION["year"];
$groupid = $_SESSION["groupid"];
?>
<style>
.prospectus {
width: 100%;
height: 640px;
border: 1px solid #ccc;
}
</style>
<div class="modal fade" id="label-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog label-width">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel">
          <ul class="nav nav-tabs" id="firstTabs">
          </ul>
 
        </p>
      </div>
      <div class="modal-body">    
        <iframe src="../prospectus/prospectus.php" class="prospectus"></iframe>
        </div>  
      </div>
    </div>
  </div>
</div>
<script>
  var groupid = <?= $groupid ?>;
</script>