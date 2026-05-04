<div class="content-wrapper bg-light">
  <div class="col-12 grid-margin">
    <div class="card shadow-lg">
      <div class="text-end mt-3 p-3">

      </div>
      <div class="card-body">
        <h2 class="card-description text-dark mb-5"><b>Participant View</b></h2>

        <div>
          <table class="table table-bordered">
            <tr>
              <th width="30%">Registration ID</th>
              <td><?php echo $row['registration_code']; ?></td>
            </tr>
            <tr>
              <th>Type Of Delegate</th>
              <td><?php echo $row['type_of_delegate']; ?></td>
            </tr>
            <tr>
              <th>Name</th>
              <td><?php echo $row['honorofic']; ?><?php echo $row['full_name']; ?></td>
            </tr>
            <tr>
              <th>Age</th>
              <td><?php echo $row['age']; ?></td>
            </tr>
            <tr>
              <th>Gender</th>
              <td><?php echo $row['gender']; ?></td>
            </tr>
            <tr>
              <th>Designation</th>
              <td><?php echo $row['designation']; ?></td>
            </tr>
            <tr>
              <th>Name of the College</th>
              <td><?php echo $row['college_name']; ?></td>
            </tr>
            <tr>
              <th>Name of the University</th>
              <td><?php echo $row['university_name']; ?></td>
            </tr>
            <tr>
              <th>Full Address</th>
              <td><?php echo $row['full_address']; ?></td>
            </tr>
            <tr>
              <th>City</th>
              <td><?php echo $row['city']; ?></td>
            </tr>
            <tr>
              <th>State</th>
              <td><?php echo $row['state']; ?></td>
            </tr>
            <tr>
              <th>Country</th>
              <td><?php echo $row['country']; ?></td>
            </tr>
            <tr>
              <th>Pin Code</th>
              <td><?php echo $row['pincode']; ?></td>
            </tr>
            <tr>
              <th>Email Address</th>
              <td><?php echo $row['email']; ?></td>
            </tr>
            <tr>
              <th>Mobile No</th>
              <td><?php echo $row['phone_number']; ?></td>
            </tr>
          </table>
        </div>


      </div>
    </div>
  </div>
</div>