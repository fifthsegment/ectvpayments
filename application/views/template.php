<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<? echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>


    <!-- JavaScript plugins (requires jQuery) -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<? echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- Enable responsive features in IE8 with Respond.js (https://github.com/scottjehl/Respond) -->
    <script src="<? echo base_url(); ?>assets/js/respond.js"></script>

     <div class="container">



      <h4>Admin Panel</h4>
      <div class="row">
        <div class="col-lg-4">
          <ul class="list-group">
            <? $this->load->view('navigation') ?>
          </ul>
        </div>

        <div class="col-lg-8 panel panel-primary">
           <div class="panel-heading"><? echo $page_title; ?></div>
           
           <?php $this->load->view($view_to_load); ?>

         <div class="panel-footer">Panel footer</div></div>
      </div>
    </div>
  </body>
</html>