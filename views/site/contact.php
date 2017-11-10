<?php require ROOT . "/views/layouts/header.php"; ?>
<section id="ContactContent">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="contact_area">
            <h1>Contacts</h1>
            <p>Vestibulum id nisl a neque malesuada hendrerit. Mauris ut porttitor nunc, ut volutpat nisl. Nam ullamcorper ultricies metus vel ornare. Vivamus tincidunt erat in mi accumsan, a sollicitudin risus vestibulum. Nam dignissim purus vitae nisl adipiscing ultricies. Pellentesque in porttitor tellus. Integer fermentum in sem eu tempus. In eu metus vitae nibh laoreet sollicitudin et ac lectus. Curabitur blandit velit elementum augue elementum scelerisque.</p>
            <div class="contact_bottom">
              <div class="contact_us wow fadeInRightBig">
                <h2>Contact Us</h2>
                <form class="contact_form" id="contact_form" method="post">

                    <!-- Hidden Required Fields -->
                    <input type="hidden" name="project_name" value="ArmProgramming">
                    <input type="hidden" name="admin_email" value="armprogramming@engine.zzz.com.ua">
                    <input type="hidden" name="form_subject" value="Message for Artyom">
                    <!-- END Hidden Required Fields -->

                  <input class="form-control" type="text" name="Name" placeholder="Name(required)" required>
                  <input class="form-control" type="email" name="E-mail" placeholder="E-mail(required)" required>
                  <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Message(required)" required></textarea>
                  <input type="submit" value="Send">

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
</div>
<?php require ROOT . "/views/layouts/footer.php"; ?>
