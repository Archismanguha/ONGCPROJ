<?php
$this->load->view('templates/header');
?>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #DDD;
}

tr:hover {background-color: #D6EEEE;}
</style>
<main role="main" class="container mcontainer">
    <div class="wrapper thank-you-page">
        <form action="<?php echo base_url(); ?>users/uploadDtls" method="post" id="uploadform" name="Upload_Form" class="form-signin" style = "max-width: 100% !important;" method="POST" enctype="multipart/form-data">
            <div class="thank-you-pop">
                
                <h1>View Details</h1>
                <br>
                <table id="alldtlTable">
                    <tr>
                        <th>Name</th>
                        <th>Block</th>
                        <th>Remarks</th>
                        <th>File</th>
                    </tr>
                    
                </table>
                <div id="pagination"></div> 
            </div>
            </div>
            <hr>
            <div class="row">
                
            </div>
        </form>
    </div>

</main>

<script> 
        var arr = '<?php echo json_encode($alldtls); ?>';
        var data = JSON.parse(arr);
        var baseUrl = '<?php echo base_url(); ?>';

        const rowsPerPage = 5; 
        let currentPage = 1; 
  
        function displayTable(page) { 
            const table = document.getElementById("alldtlTable"); 
            const startIndex = (page - 1) * rowsPerPage; 
            const endIndex = startIndex + rowsPerPage; 
            const slicedData = data.slice(startIndex, endIndex); 
  
            // Clear existing table rows 
            table.innerHTML = ` 
        <tr> 
            <th>Name</th>
            <th>Block</th>
            <th>Remarks</th>
            <th>File</th> 
        </tr> 
    `; 
  
            // Add new rows to the table 
            slicedData.forEach(item => { 
                const row = table.insertRow(); 
                const nameCell = row.insertCell(0); 
                const blockCell = row.insertCell(1); 
                const remarkCell = row.insertCell(2); 
                const fileCell = row.insertCell(3);
                nameCell.innerHTML = item.FirstName + " " + item.LastName; 
                blockCell.innerHTML = item.block_name; 
                remarkCell.innerHTML = item.remarks; 
                fileCell.innerHTML = "<a href='" + baseUrl + "assets/upload/" + item.filename +"' download>"+item.filename+"</a>"; 
            }); 
  
            // Update pagination 
            updatePagination(page); 
        } 
  
        function updatePagination(currentPage) { 
            const pageCount = Math.ceil(data.length / rowsPerPage); 
            const paginationContainer = document.getElementById("pagination"); 
            paginationContainer.innerHTML = ""; 
  
            for (let i = 1; i <= pageCount; i++) { 
                const pageLink = document.createElement("a"); 
                pageLink.href = "#"; 
                pageLink.innerText = i; 
                pageLink.onclick = function () { 
                    displayTable(i); 
                }; 
                if (i === currentPage) { 
                    pageLink.style.fontWeight = "bold"; 
                } 
                paginationContainer.appendChild(pageLink); 
                paginationContainer.appendChild(document.createTextNode(" ")); 
            } 
        } 
  
        // Initial display 
        displayTable(currentPage); 
    </script> 


<?php
$this->load->view('templates/footer');
?>