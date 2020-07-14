<style>
 div {
   line-height:2em;padding:20px
 }
 th, td{
   text-align:center;
 }
</style>

<div>
Price Year : <input type="text" name="year" id="year"><button type="button" onclick="submit()">Submit</button>
</div>

<div>
<table class="table table-bordered table-hover table-responsive">
<tbody>
<tr>
  <th rowspan="2" style="vertical-align:middle;"> Car Name </th>
  <th colspan="3"> Years </th></tr>
  <?php foreach($years as $y){
          $highlight = $y == $search ? 'style="background-color:#c0c0c0"' : '';
          echo '<th '.$highlight.'>'.$y.'</th>';   
          }
  ?>

<?php

foreach($data as $c){
  echo '<tr>
        <td>'.$c['car_name'].'</td>';   
        foreach($years as $y){
          $highlight = $y == $search ? 'style="background-color:#c0c0c0"' : '';
          echo '<td '.$highlight.'>'.$c[$y].'</td>';   
        } 
  echo '</tr>';
}

?>

</tbody>
</table>
</div>

<script>
function submit(){
  year = document.getElementById('year').value;
  if(year == '') {
    alert('Please specify the Price Year');
    return false;
  }
  
  var numbers = /^[0-9]+$/;
  if(!year.match(numbers)){
    alert('Please specify only Number for the Price Year.');
    return false;
  }

  document.location.href= '<?php echo base_url() ?>cars/index/'+year;
}

</script>


