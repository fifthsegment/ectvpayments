<form class="form-horizontal" action = "<?php echo site_url('manager/paypal_save'); ?>" method="POST">
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
    <div class="col-lg-10">
      <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $this->config->item('paypal_email'); ?>">
    </div>
  </div>


  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">PayPal URL</label>
    <div class="col-lg-10">
      <input type="text" name="url" class="form-control" id="url" placeholder="URL" value="<?php echo $this->config->item('paypal_url'); ?>">
    </div>
  </div>

    <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">Notification URL</label>
    <div class="col-lg-10">
      <input type="text" name="ackurl" class="form-control" id="url" placeholder="<?php echo site_url('/'); ?>" value="<?php echo $this->config->item('paypal_ackurl'); ?>">
      <span class="help-block"><p>The URL at which notification of the Payment will be sent.<br/>
        <i>For Your Server it will start like this : <?php echo site_url('/'); ?></i></p>
      </span>
    </div>
  </div>


  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">Return URL</label>
    <div class="col-lg-10">
      <input type="text" name="returnurl" class="form-control" id="url" placeholder="<?php echo site_url('/'); ?>" value="<?php echo $this->config->item('paypal_returnurl'); ?>">
      <span class="help-block"><p>The URL to return to after Payment.<br/>
        <i>For Your Server it will start like this : <?php echo site_url('/'); ?></i></p>
      </span>
    </div>
  </div>

    <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">Currency Code</label>
    <div class="col-lg-10">
      <input type="text" name="currencycode" class="form-control" id="cur" placeholder="Example USD CAD INR PKR" value="<?php echo $this->config->item('paypal_currencycode'); ?>">
      <span class="help-block"><p>Enter 3 Letter Currency Code<br/>
        </p>
      </span>
    </div>
  </div>



  <div class="form-group">
        <label for="inputSandbox" class="col-lg-2 control-label">Sandbox</label>
        <div class="col-lg-offset col-lg-7">
          <?php $checked = ($this->config->item('paypal_sandbox') == true ? "checked" : ""); ?>
          <?php $checked_value = ($this->config->item('paypal_sandbox') == false ? "checked" : ""); ?>
          <div class="radio">
            <label>
              <input type="radio" name="sandbox" id="optionsRadios1" value="true" <?php echo $checked ?>>
              ON
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="sandbox" id="optionsRadios2" value="false" <?php echo $checked_value ?>>
              OFF
            </label>
          </div>
      </div>
 </div>

<div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">Test</label>
    <div class="col-lg-10">
      <a href="<?php echo site_url('manager/paypal_test');?>"  class="btn btn-primary" id="inputEmail" placeholder="Email">Launch</a>
    </div>
  </div>
 <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Save Settings</button>
    </div>
  </div>
</form>