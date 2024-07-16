<?php
$this->load->view('templates/header');
?>
<main role="main" class="container mcontainer">
    <div class="wrapper thank-you-page">
        <form action="<?php echo base_url(); ?>users/uploadDtls" method="post" id="uploadform" name="Upload_Form" class="form-signin" method="POST" enctype="multipart/form-data">
            <div class="thank-you-pop">
                <img src="<?php echo HTTP_IMAGES_PATH; ?>tick.png" alt="">
                <h1>Upload Details</h1>
                <h5 class="cupon-pop">Welcome: <span><?php  print $firstname." ".$lastname?></span></h3>
                <br>
                <div class="form-group">
                <label for="blocklst">Block</label>
                <select  name="blocklst" id="blocklst">
                <?php
                foreach($blockdtls as $row){
                    echo "<option value=".$row->block_id.">".$row->block_name."</option>"; 
                }
                echo "</select>";
                ?>
                </div>
                <div class="form-group">
                <label for="remarks">Remarks</label>
                <input type="text"  id="remarks" name="remarks" placeholder="Remarks"/>
            </div>
            <div class="form-group">
            <input type="file" name="uploadFile" id="uploadFile" accept=
                    "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                    text/plain, application/pdf, image/*">
                    
            <button type="submit" class="btn btn-primary" style="float:right">Submit</button>
            </div>
            </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-8 offset-2">
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>users/logout"></i> Log Out</a>
                </div>
            </div>
        </form>
    </div>
    <footer>@This Is Reserved By ARCHISMAN GUHA</footer>
    <footer>archismanguha2000@gmail.com</footer>
</main>
<?php
$this->load->view('templates/footer');
?>