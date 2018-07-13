<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<table class="table table-hover">
  <thead>
    <tr class="table-active">
      <th scope="col">#</th>
      <th scope="col">Car Model</th>
      <th scope="col">Car Year</th>
      <th scope="col">Car Plate</th>
      <th scope="col">Car Color</th>
      <th scope="col">Action Update or Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $counterCars = 0;
        $couterColumns = 0;
        if(!(is_null($car_array) && $car_array !== '')){
            foreach ($car_array as $car) {
                echo '<form action="'. base_url('index.php/controller_login/update_car_form') .'" method="post" ><tr name = "car_'. (++$counterCars) .'">';
                foreach($car as $value){
                    echo '<td "> <input type="hidden" name = "column_'. (++$couterColumns) .'" value="' . $value . '">' . $value . '</td>';
                }
                echo '<td>        
                <button type="submit" class="btn btn-warning ">Update</button>
                <button type="submit" class="btn btn-danger" formaction="'. base_url('index.php/controller_login/delete_car') .' ">Delete</button>
              </td> </tr> </form>';
              $couterColumns = 0;
            }
        }
    ?>
  </tbody>
</table>
</body>
</html>