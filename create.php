<?php
session_start();

if(isset($_POST['insert']))
{
  include('assets/includes/db.php');

  include('assets/includes/postvars.php');

  move_uploaded_file($_FILES["image"]["tmp_name"], $upload_image);

  move_uploaded_file($_FILES["document"]["tmp_name"], $upload_file);

  // Query to insert data
  $pdoQuery = "INSERT INTO proposals(pname, pdept, pamount, prequest, pdescription, pmeasure, pdocument, pfeedback, pcomments, image, document) VALUES (:pname, :pdept, :pamount, :prequest, :pdescription, :pmeasure, :pdocument, :pfeedback, :pcomments, '$upload_image', '$upload_file')";

  $pdoResult = $pdoConnect->prepare($pdoQuery);

  $pdoExec = $pdoResult->execute(array(":pname"=>$pname, ":pdept"=>$pdept, ":pamount"=>$pamount, ":prequest"=>$prequest, ":pdescription"=>$pdescription, ":pmeasure"=>$pmeasure, ":pdocument"=>$pdocument, ":pfeedback"=>$pfeedback, ":pcomments"=>$pcomments));

  // check if mysql insert query successful
  if($pdoExec){
    header('Location: everybody.php');
  }else{
      echo 'Data Not Inserted';
  }
}
include('assets/includes/header.php');
?>

<div class="center-container field-box">
  <div class="center-title">
    <h1>Create Your Proposal</h1>
  </div>
  <div class="center-form">

    <form action="" method="post" enctype="multipart/form-data">
      <div class="directive-box">
        <em>Please complete the following fields to be entered into the random selection Davenfund drawing. <br> We encourage you to share your proposal with your direct Supervisor for additional support and awareness. <br> Thank you. </em>
      </div>

        <input type="text" name="pname" required placeholder="Proposal Name"><br><br>

        <input type="text" name="pdept" required placeholder="Department"><br><br>

        <input type="number" name="pamount" required placeholder="Amount ($100 — $2,000)" min="0" max="2000"><br><br>

        <p class="form-text">Fund Request Category and Item</p>
        <div class="radio-container">
          <input type="radio" name="prequest" value="Professional Development" checked>&nbsp;&nbsp;&nbsp;&nbsp;Professional Development<br>
          <input type="radio" name="prequest" value="Equipment">&nbsp;&nbsp;&nbsp;&nbsp;Equipment<br>
          <input type="radio" name="prequest" value="Software">
          &nbsp;&nbsp;&nbsp;&nbsp;Software<br>
          <input type="radio" name="prequest" value="Other">&nbsp;&nbsp;&nbsp;&nbsp;Other<br>
        </div>
        <br>
        <div class="question-container">
          <p class="form-text">How will these funds help improve your role, your department, and/or DU in general?</p>
          <textarea rows="4" cols="35" placeholder="&nbsp;&nbsp;Description" name="pdescription"></textarea>
          <div class="q-box">
            <p class="q-mark">?</p>
            <p class="q-explain"><br>Ex. Able to spend less time switching between programs by having two monitors, able to utilize more program functionality by attending the conference, etc.</p>
          </div>

          <p class="form-text">How will you measure the improvements the funds provide?</p>
          <textarea rows="4" cols="35" placeholder="&nbsp;&nbsp;..." name="pmeasure"></textarea>
          <div class="q-box">
            <p class="q-mark">?</p>
            <p class="q-explain"><br>Ex. Saved two hours per week because of software training, 15% more efficient with two monitors, 40% less back pain while working because of my stand up desk, etc.</p>
          </div>


          <p class="form-text">Provide documentation on cost to justify requested amount.</p>
          <em>Give an overview here and attach files below</em>
          <textarea rows="4" cols="35" placeholder="&nbsp;&nbsp;... " name="pdocument"></textarea>
          <div class="q-box">
            <p class="q-mark">?</p>
            <p class="q-explain"><br>Ex. Quote for cost of equipment or software desired, webpage showing conference or course material with content and cost, email from Facilities or IT supporting your request, etc. </p>
          </div>

          <p class="form-text">Do you have any feedback on this process or program? Would you like to see this program continued?</p>
          <textarea rows="4" cols="35" placeholder="&nbsp;&nbsp;..." name="pfeedback"></textarea>
          <div class="q-box">
            <p class="q-mark">?</p>
            <p class="q-explain"><br>List ways we can improve this system or application process, list any feedback on future program enhancements or desires, etc.</p>
          </div>

          <p class="form-text">Additional comments:</p>
          <textarea rows="4" cols="35" placeholder="&nbsp;&nbsp;..." name="pcomments"></textarea>
        </div>

        <p class="form-text">Image:</p>
        <input type="file" name="image"><br><br>

        <p class="form-text">Documentation:</p>
        <input type="file" name="document"><br><br>


        <input type="submit" name="insert" value="Submit">

    </form>

  </div>
</div>

<?php include ('assets/includes/footer.php'); ?>
