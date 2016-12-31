<div class="clearfix section-page-file">
    <?php if(!empty($page['message'])): ?>
    <div class="alert alert-default">
        <p><?php echo $page['message']; ?></p>
    </div>
    <?php endif; ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form id="submit_plan" class="plan-form form-horizontal" action="/" method="POST">
            <div class="form-group">
                <input class="form-control" type="text" name="contact_name" id="contact_name" placeholder="Name" />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="contact_email" id="contact_email" placeholder="Email Address" />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="plan_selected" id="plan_selected" value="[Plan:Level] - [Enquiry:Type]" placeholder="About?" />
            </div>
            <div class="form-group">
                <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>
</div>