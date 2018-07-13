<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

?>

    <div class="jumbotron ">            
        <form action="<?php echo base_url('index.php/controller_login/update_car')?>"  method="post">
            <h1 class="display-4">Car Update Data:</h1>
            <div class="form-group"><br>
                <input type="hidden" class="form-control" name="car_id" value="<?php echo $car_data[0]?>"> <br>
                <label>Car Model:</label>
                <input type="text" class="form-control" placeholder="Car Model" name="car_model" value="<?php echo $car_data[1]?>"> <br>
                <label>Car Year:</label>
                <input type="text" class="form-control" placeholder="Car Year" name="car_year" value="<?php echo $car_data[2]?>"> <br>
                <label>Car Plate:</label>
                <input type="text" class="form-control" placeholder="Car Plate" name="car_plate" value="<?php echo $car_data[3]?>"> <br>
                <label>Car Color:</label>
                <input type="text" class="form-control" placeholder="Car Color" name="car_color" value="<?php echo $car_data[4]?>"> <br>
                <button type="submit" class="btn btn-warning">Update Car Data</button>
            </div>
        </form>
    </div>
    
        
    </body>
</html>