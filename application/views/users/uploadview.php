<?php
$this->load->view('templates/header');
?>
<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 20%; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<main role="main" class="container mcontainer">
    <div class="wrapper thank-you-page">
        <form action="<?php echo base_url(); ?>users/uploadDtls" method="post" id="uploadform" name="Upload_Form" class="form-signin" method="POST" enctype="multipart/form-data">
            <div class="thank-you-pop">
                <img src="<?php echo HTTP_IMAGES_PATH; ?>tick.png" alt="">
                <h1>Upload Details</h1>
                <br>
                <div class="form-group">
                <label for="blocklst" style="float: left;padding: 1%;font-family: auto;font-size: 18px;">Block</label>
                <select class="minimal" name="blocklst" id="blocklst" style="width: 60%;">
                <?php
                foreach($blockdtls as $row){
                    echo "<option value=".$row->block_id.">".$row->block_name."</option>"; 
                }
                echo "</select>";
                ?>
                </div>
                <div class="form-group">
                <label for="remarks" style="float: left;padding: 1%;font-family: auto;font-size: 18px;">Remarks</label>
                <input type="text"  id="remarks" name="remarks" placeholder="Remarks" style="width: 65%;"/>
            </div>
            <div class="form-group">
            <input type="file" name="uploadFile" id="uploadFile" accept=
                    "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                    text/plain, application/pdf, image/*" style="float: left;">
                    
            <button type="submit" class="btn btn-primary" style="float:right">Submit</button>
        </div>
            </div>
            </div>
            <hr>
            <div class="row">
                
            </div>
        </form>
    </div>
    <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 40%;">
    <span class="close" style="text-align: right;">&times;</span>
    <p id="modalPara"></p>
  </div>

</div>
</main>
<script>
var uploadmsg = <?php echo json_encode($uploadmsg); ?>;

var modal = document.getElementById("myModal");

var span = document.getElementsByClassName("close")[0];

document.getElementById("modalPara").innerHTML = uploadmsg;

if(uploadmsg.includes("Error")){
    document.getElementById("modalPara").style.color = "red";
}
else{
    document.getElementById("modalPara").style.color = "green";
}

if(uploadmsg != ""){
    modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php
$this->load->view('templates/footer');
?>