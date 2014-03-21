
<table class="table table-bordered">
	
<?php
foreach($results as $data) { ?>
<tr>
    <td><?php echo $data->Date_Time ?></td>
    <?php $class = ($data->Status == "SUCCESS" ? "label-success" : "label-danger"); ?>
    <td><span class="label <?php echo $class; ?>"><?php echo $data->Status ?></span></td>
    <td><?php echo $data->Log ?> </td> 
</tr>
<?php
}
?>
</table>
   <p>
   	<ul class="pagination">
   		<?php echo $links; ?>
   	</ul></p>
  
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
