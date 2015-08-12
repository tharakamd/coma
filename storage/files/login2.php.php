<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './includes/bootstrap_import_style.php'; ?>
        <link rel="stylesheet" href="css/login2.css">
        <link rel="stylesheet" type="text/css" href="css/buttons.css">
        <title>Apekama</title>
    </head>
    <body>
        <div class="row apekama_log">
            <div class="col-lg-4 "></div>
            <div class="col-lg-4 ">
                <img src="images/loging_background.jpg" class="login_image">
            </div>
            <div class="col-lg-4 "></div>
        </div>
        <div class="row login_forms">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 log_col">
                <div class="button_container ">
                    <Button class="button button-glow button-border button-rounded button-primary login_button" id="buy_button" role="button">Buy Items</Button>
                    <Button class="button button-glow button-border button-rounded button-primary login_button" id="sell_button" role="button">Sell Items</Button>
                </div>
            </div>
            <div class="col-lg-4 "></div>
        </div>
    </body>
</html>