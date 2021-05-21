<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="assets/css/style.css"/>
    </head>
<body>

<?php
    include_once("classes/Managecsv.php");
    $myfile = new Managecsv("sample.csv");
    $csvdata = $myfile->readcsv();
?>

<div class="header">
  <h3>CORE PHP: CSV Application using OOPS</h3>
</div>
<div class="maindiv">
    <form action="" method="post" name="empform" id="empform">
      <div id="form-main-container">
      <div id="form-area">
        <div id="form-title">
            Employee Form
        </div>
        <div id="form-body">
          <div>
            <div class="col-12">
              <fieldset class="form-group">
                <label class="form-label" for="fullname">Full Name:</label>
                <input type="text" class="form-control" name="fullname" placeholder="Enter full name" id="fullname" required="">
                <label id="fullname-error" class="error">This field is required.</label>
              </fieldset>
            </div>
            <div class="col-12">
              <fieldset class="form-group">
                <label class="form-label" for="email">Email address:</label>
                <input type="email" class="form-control" name="email" placeholder="ex. jankitest@yopmail.com" id="email" required="">
                <label id="email-error" class="error">Please enter valid email address.</label>
              </fieldset>
            </div>
            <div class="col-12">
              <fieldset class="form-group">
                <label class="form-label" for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter phone" id="phone" required="">
                <label id="phone-error" class="error">Please enter valid phone number.</label>
              </fieldset>
            </div>
            <div class="col-12">
              <fieldset class="form-group">
                <label class="form-label" for="department">Department:</label>
                <input type="text" class="form-control" name="department" placeholder="Enter your department" id="department"  required="">
                <label id="department-error" class="error">This field is required.</label>
              </fieldset>
            </div>
            <div class="col-12">
              <fieldset class="form-group">
                <label class="form-label" for="joiningdate">Joining date:</label>
                <input type="date" class="form-control" name="joiningdate" id="joiningdate" placeholder="Enter name" required="">
                <label id="joiningdate-error" class="error">This field is required.</label>
              </fieldset>
            </div>
          </div>
          <div>
            <div class="center-text button-area">
              <button type="button" class="btn" id="submitbtn" >Submit</button>
              <button type="button" class="btn btn-save" id="cancelbtn" >Cancel</button>
            </div>

          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="action" value="insert">
    </form>
    <div class="listview">
        <a href="sample.csv" class="rightside btn btn-save" download>Download CSV</a>
        <a href="javascript:" id="insertform" class="rightside btn">Add new Employee</a>

        <table class="table">
          <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Department</th>
                <th scope="col">Joining Date</th>
                <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php

                $rownum = 0;
                foreach($csvdata as $row){
                    if($rownum > 0){
                        ?>
                            <tr>
                                <th scope="row"><?php echo $rownum;?></th>
                                <?php
                                $totalcolumns = count($row);
                                for ($i=0; $i < $totalcolumns; $i++) {
                                    $addtext = 'text';
                                    $addvalue = $row[$i];
                                    if($i == 1) {
                                        $addtext = 'email';
                                    }
                                    else if($i == 2) {
                                        $addtext = 'text';
                                    }
                                    else if($i == 4) {
                                        $addtext = 'date';
                                        $addvalue = date("d/m/Y",strtotime($row[$i]));
                                    }
                                    echo "<td  data-id='".$rownum."' ><span class='rowvalue showvalue_".$rownum."'>".$addvalue. "</span><input type='".$addtext."' style='display:none;' id='input_".$rownum."_".$i."' class='rowtextbox inputopen_".$rownum."' value='".$row[$i]."' /> </td>";
                                }
                                ?> 
                                <td>
                                    <a href="javascript:void(0);" class="btn openinput" id="openinput_<?php echo $rownum;?>" data-id="<?php echo $rownum;?>">Edit</a>
                                    <a href="javascript:void(0);" style="display:none;" class="btn btn-save saveinput" id="saveinput_<?php echo $rownum;?>" data-id="<?php echo $rownum;?>">Save</a>
                                </td>   
                            </tr>
                        <?php
                    }
                    $rownum++;
                }
            ?>
          </tbody>
        </table>
        </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/common.js"></script>
</body>
</html>
