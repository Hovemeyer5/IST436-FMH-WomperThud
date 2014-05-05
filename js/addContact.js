//array to hold added html
var detailBoxes = [];
 
detailBoxes['phone'] = "<div class='detailBox'><select name='phoneType[]'><option value='1'>Home</option><option value='2'>Work</option><option value='3'>Other</option></select><input name='phone[]' type='text' class='form-control' placeholder='Phone'><button onclick='removeDetailBox(this, event)'>Remove</button><input class='hide' name='phoneID[]' value=''></div>";
detailBoxes['address'] = "<div class='detailBox'><select name='addType[]'><option value='1'>Home</option><option value='2'>Work</option><option value='3'>Other</option></select><input name='street[]' type='text' class='form-control' placeholder='Street'><input name='city[]' type='text' class='form-control' placeholder='City'><input name='state[]' type='text' class='form-control' placeholder='State'><input name='zipcode[]' type='text' class='form-control' placeholder='Zipcode'><button onclick='removeDetailBox(this, event)'>Remove</button><input class='hide' name='addID[]' value=''></div>";
detailBoxes['email'] = "<div class='detailBox'><select name='emailType[]'><option value='1'>Home</option><option value='2'>Work</option><option value='3'>Other</option></select><input name='email[]' type='text' class='form-control' placeholder='Email'><button onclick='removeDetailBox(this, event)'>Remove</button><input class='hide' name='emailID[]' value=''></div>";
detailBoxes['url'] = "<div class='detailBox'><select name='urlType[]'><option value='1'>Home</option><option value='2'>Work</option><option value='3'>Other</option></select><input name='url[]' type='text' class='form-control' placeholder='URL'><button onclick='removeDetailBox(this, event)'>Remove</button><input class='hide' name='urlID[]' value=''></div>";

$(document).ready(function(){
     $('.add').click(function(e){
          e.preventDefault();
          var typeToAdd = $(this).data('type');
          $("#" + typeToAdd + "s").append(detailBoxes[typeToAdd]);
    });
    $('#save').click(function(){
          $("#editContact").submit();
    });

});

function removeDetailBox(thisDetailBox, e) {
     e.preventDefault();
     if ($(thisDetailBox).next().val() == "") {
                             //code
                             $(thisDetailBox).parent().remove();
     }
     else
     {
        $(thisDetailBox).next().attr("value", $(thisDetailBox).next().val() + "X");
        $(thisDetailBox).parent().hide();
     }
}