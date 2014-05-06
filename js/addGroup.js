$(document).ready(function() {
    $('#search').keyup(function(){
        var searchData = $(this).val();
        $.ajax({
            type: "POST", url: "aj.php",
            data: {search: searchData, action:'selectSearch'},
            success: function(data)
            {
               $("#contactListing ul").html(data);
            }
        });
   });
});
$(document).ready(function(){

    $('#save').click(function(){
          $("#editGroup").submit();
    });

});

function removeMember(thisMember) {
     if ($(thisMember).prev().val().indexOf('M') != 0) {
          //code
          $(thisMember).parent().remove();
     }
     else
     {
        $(thisMember).prev().attr("value", $(thisMember).prev().val() + "X");
        $(thisMember).parent().hide();
     }
}
//function to add a member to the group's list for submissiton
function addMember(thisMember) {
     //get the member to add's id
     var memberID = $(thisMember).children().last().val();
     //assume the member has not alreayd been added
     var alreadyAdded = "false";
     //loop through current members and flag if already added.
     $('#members ul').children().each(function(){
          var liID = $(this).children().last().prev().val();
          if (liID.indexOf('X') == -1)
          {          
               //This is not a hidden li
               if (liID.indexOf('M') == -1){ 
                    //straight comparison
                    if (liID == memberID) {
                       
                         alreadyAdded  = "true";
                    }
               }
               else{
                    //trim the M and compare
                    if (liID.slice(1,liID.length) == memberID) {
                         alreadyAdded  = "true";
                    }
               }
          }
     });
     if (alreadyAdded == "true") {
          //code
          $('#alreadyThere span').show().slideUp(5000);
     }
     else
     {
     //add the member
          var memberString = $(thisMember).html() + '<span onclick="removeMember(this)" class="glyphicon glyphicon-remove"></span>';
          memberString= "<li>" + memberString + "</li>";
          $('#members ul').append(memberString);
     }
}