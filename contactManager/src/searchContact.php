<?php 
require_once 'includes/menuWithoutSearchButton.php';
?>

<div class="container-lg p-lg-2">
        <div class=" bg-info bg-light hero text-center ">
            <h1 class="display-4">Search Contacts By Name or Mobile Number</h1>
            
        </div>
    </div>

<div class ="container mt-4" >
<form class="d-flex mt-4" method = "GET" action = "searchByTel.php">
        <input class="form-control me-2" type="search" placeholder="Search contact by number" aria-label="Search" name = "search">
        <button class="btn btn-outline-success" type="submit">Search</button>
</form>

<form class="d-flex mt-4"  method = "GET" action = "searchByName.php">
        <input class="form-control me-2" type="search" placeholder="Search contact by Name" aria-label="Search" name = "search">
        <button class="btn btn-outline-success" type="submit">Search</button>
</form>
</div>
<?php 
require_once 'includes/footer.php';
?>