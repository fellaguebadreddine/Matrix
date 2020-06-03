<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id'])) {
 $address =  htmlspecialchars(trim($_GET['id'])) ;
}else{
        echo 'Content not found....';
}
    $latitude =0;
    $longitude =0;

$latLong = getLatLong($address);
$latitude = $latLong['latitude']?$latLong['latitude']:'0';
$longitude = $latLong['longitude']?$latLong['longitude']:'0';

?>
                        
                        
                                    
                                        
                                        <hr>
                                    <div class="form-group">
                                        <label style="font-size: 15px;" class="col-md-3 control-label">Latitude:</label>
                                        
                                        <div class="input-group" >
                                        <input  class="form-control input-sm " readonly name="latitude" value="<?php  if(isset($latitude)){  echo   $latitude; } ?>" >
                                     <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-map-marker" > </i>
                                        
                                                        </span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 15px;"  class="col-md-3 control-label">longitude:</label>
                                        
                                        <div class="input-group" >
                                        <input  class="form-control input-sm " readonly name="longitude" value="<?php  if(isset($longitude)){  echo   $longitude; } ?>" >
                                     <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-map-marker" > </i>
                                        
                                                        </span>
                                    </div>
                                    </div>
                                    <iframe width="100%" height="250" src="https://maps.google.com/maps?width=100%&height=600&hl=en&coord=<?php echo $longitude; ?>,<?php echo $latitude; ?>&q=+(<?php echo $address ?>)&ie=UTF8&t=&z=12&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/en/journey-planner.htm">Map Directions</a></iframe>
                                    
                                
                                


