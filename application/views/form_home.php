<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

?>

    <div class="jumbotron ">            
        <form action="<?php echo base_url('index.php/controller_login/register_car')?>"  method="post">
            <h1 class="display-4">Car Registration:</h1>
            <div class="form-group"><br>
                <label>Car Model:</label>
                <input type="text" class="form-control" placeholder="Car Model" name="car_model"> <br>
                <label>Car Year:</label>
                <input type="text" class="form-control" placeholder="Car Year" name="car_year"> <br>
                <label>Car Plate:</label>
                <input type="text" class="form-control" placeholder="Car Plate" name="car_plate"> <br>
                <label>Car Color:</label>
                <input type="text" class="form-control" placeholder="Car Color" name="car_color"> <br>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
    
        
    </body>
</html>