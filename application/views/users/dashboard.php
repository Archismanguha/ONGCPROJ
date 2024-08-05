<?php
$this->load->view('templates/header');
?>
<main role="main" class="container mcontainer">
    <div class="wrapper thank-you-page">
        <form action="<?php echo base_url(); ?>users/uploadDtls" method="post" id="uploadform" name="Upload_Form" class="form-signin" style = "max-width: 100% !important;" method="POST" enctype="multipart/form-data">
            <div class="thank-you-pop">
                
                <h1>Dashboard</h1>
                <h5 class="cupon-pop">Welcome: <span><?php  print $firstname." ".$lastname?></span></h3>
                <br>

            </div>
            </div>
            <hr>
            <div class="row">
                
            </div>
        </form>
    </div>
</main>
<?php
$this->load->view('templates/footer');
?>