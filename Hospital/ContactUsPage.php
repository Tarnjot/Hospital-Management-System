<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Main.css" />
    <title>contactUs</title>
  </head>
  <body>
  <div class="header">
    <div class="header-text">
        <div class="inline-headings">
            <h2><a href="MainPage.php" id="contact-home-button">Home</a></h2>
            <h2><a id="contact-page-title" >Contact Us Page</a></h2>
        </div>
    </div>
</div>
    <div class="line"></div>

    <div class="main-content">
      <div>
        <h2 class="box-content">Email: Hospital@gmail.com</h2>
        <h2 class="box-content">Phone Number: 12312312</h2>
        <h2 class="box-content">Address: 289 Victoria Rd, Sheffield S30 3EY</h2>
      </div>
      <form action="ContactUs.php" method="POST" id="contact-form">
    <div class="form-container">
        <div class="contact-field">
            <label for="fullname" id="label-fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
        </div>

        <div class="contact-field">
            <label for="email" id="label-email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="contact-field">
            <label for="message" id="label-message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>

        <div class="input-field">
            <h2 id="contact-submit-button"><button type="submit" id="contact-button">Submit</button></h2>
        </div>
    </div>
</form>
        <div class="footer">
          <h2>Operating 24/7 just for you!</h2>
        </div>
    </footer>
    </div>
  </body>
</html>
