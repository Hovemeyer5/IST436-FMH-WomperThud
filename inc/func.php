<?php
    //Document for functions used for My Universal Notes
    require_once('config.php');
    
    //reformat phone
    function formatPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
         
        $l = strlen($phone);
        
        if($l == 7)
        {
            $phone = preg_replace('/([0-9]{3})([0-9]{4})/', '$1-$2', $phone);
        }
        elseif($l == 10)
        {
            $phone = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $phone);
        }
        return $phone;
    }
        
    //Display User Profile.
    function userProfile(){
        global $db;
        //get user profile
        $userProfile = $db->select("user, address", "u_fname, u_mi, u_lname, u_email, u_phone, add_street, add_city, add_state, add_zip",
        "user.u_add = address.add_id and u_id = ". $_SESSION['user']);
        $userProfile = $userProfile[0];
        //output details
        ?>
        <div class="userProfile_image_box">
            <img src="i/defaultUser.png" alt="profileImage">  
        </div>
        <div class = "userProfile_details">
                <p class="userProfile_label">Name:</p>
                <p class="userProfile_detail"><?=$userProfile['u_fname'] . " " . $userProfile['u_mi'] . " " . $userProfile['u_lname']?></p>
                                                              
                <p class="userProfile_label">Address:</p>
                <p class="userProfile_detail"><?=$userProfile['add_street']?>
                            <br /> <?=$userProfile['add_city'] . ", " . $userProfile['add_state']. " " . $userProfile['add_zip']?></p>
                
                <p class="userProfile_label">Phone:</p>
                <p class="userProfile_detail"><?=formatPhone($userProfile['u_phone'])?></p>
                                                              
                <p class="userProfile_label">Email:</p>
                <p class="userProfile_detail"><?=$userProfile['u_email']?></p>
        </div>
        <?
    };
    function accountDetails()
    {
        global $db;
        
        //See if user is a business owner or student
        $user = $db->select("business, address", "bus_id, bus_name, bus_email, bus_phone, bus_code, add_street, add_city, add_state, add_zip",
                            "bus_add = add_id and bus_owner = ". $_SESSION['user']);
        
        if($user == "")
        {
            //user is a student
            $user = $db->select("user, bus_student", "u_fname, u_mi, u_lname, bus_student.bus_id",
                                "bus_student.u_id = user.u_id and 
                                bus_student.u_id = ". $_SESSION['user']);
            
            //student business details
            $businesses = $db->select("business, user", "u_fname, u_mi, u_lname, bus_name, bus_email, bus_phone",
                            "business.bus_owner = user.u_id and business.bus_id = ". $user[0]['bus_id']);
            ?>
            <div class="account_business">
                <div class="account_stud_bus_heading">
                    Organizations you have joined:
                </div>
                
                <div class="account_student_joined">
                    <?
                    if($businesses != "" && count($businesses) > 0)
                    {
                        ?>
                        <div>
                            <ul>
                        <?
                        foreach($businesses as $business)
                        {
                            echo "<li><span class='account_sbj_name'>". $business['bus_name'] . "</span>
                                      <span><span class='label'>Owner:</span>" . $business['u_fname'] . " " . $business['u_lname']  ."</span>
                                      <span><span class='label'>Phone:</span>" . formatPhone($business['bus_phone']) . "</span>
                                      <span><span class='label'>Email:</span>" . $business['bus_email']."</span></li>\n";

                        }
                        ?>
                            </ul>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </div>
            <?
        }
        else{
            //easy variable access
            $user = $user[0];
            
            //output business details
            $students = $db->select("bus_student, user", "u_fname, u_mi, u_lname, u_phone, u_email",
                            "bus_student.u_id = user.u_id and bus_id = ". $user['bus_id']);
            ?>
            <div class="account_business">
                <div class="account_business_heading">
                    Your business:
                </div>
            
                <div class = "account_business_details">
                    <div>
                        <p class="label">Business:</p>
                        <p class="detail"><?=$user['bus_name']?></p>
                    </div>
                    <div>
                        <p class="label">Address:</p>
                        <p class="detail"><?=$user['add_street']?>, <?=$user['add_city'] . ", " . $user['add_state']. " " . $user['add_zip']?></p>
                    </div>
                    <div>
                        <p class="label">Phone:</p>
                        <p class="detail"><?=formatPhone($user['bus_phone'])?></p>
                    </div>
                    <div>
                        <p class="label">Email:</p>
                        <p class="detail"><?=$user['bus_email']?></p>
                    </div>
                </div>
                
                <div class="account_business_students_wrap">
                    <div class="account_stud_bus_heading">
                        You have <?=($students == "" ? "0" : count($students))?> students.
                    </div>
                    <div class="account_business_students">
                        <?
                        if($students != "" && count($students) > 0)
                        {
                            ?>
                            <div>
                                <ul>
                            <?
                            foreach($students as $student)
                            {
                                echo "<li>
                                        <span class='account_sbj_name'>". $student['u_fname'] . " " . $student['u_mi'] . " " . $student['u_lname'] .  "</span>
                                        <span><span class='label'>Phone:</span>" . formatPhone($student['u_phone']) . "</span>
                                        <span><span class='label'>Email:</span>" . $student['u_email']."</span></li>\n";
                            }
                            ?>
                                </ul>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?   
        }
        
    };
    

?>