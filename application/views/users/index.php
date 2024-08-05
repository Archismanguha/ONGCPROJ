<?php $this->load->view('templates/header'); ?>
<main role="main" class="container mcontainer">
    <div class="wrapper">
        <form action="<?php echo base_url(); ?>users/dologin" method="post" id="loginform" name="Login_Form" class="form-signin" method="POST">
            <h4 class="form-signin-heading">ONGC Login</h4>
             <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name*" required />
            </div>
            <div class="form-group">
                <label for="empid">Employee Id</label>
                <input type="text" class="form-control" id="empid" name="empid" placeholder="Employee Id*" required />
            </div>
            <button type="submit" class="btn btn-primary" style="float:right">Login</button>
            <div>
                <span id="errSpan" style="display:none; color:red;"></span>
            </div>
        </form>
    </div>
</main>
<script>
    debugger;
var loginErrMsg = <?php echo json_encode($loginErrMsg); ?>;

var span = document.getElementById("errSpan");

if(loginErrMsg != ""){
    document.getElementById("errSpan").innerHTML = loginErrMsg;
    span.style.display = "block";
}
else{
    document.getElementById("errSpan").innerHTML = "";
    span.style.display = "none";
}

</script>
<?php $this->load->view('templates/footer'); ?>