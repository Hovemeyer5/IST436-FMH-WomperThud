$(document).ready(function() {
    $('#search').keyup(function(){
        var searchData = $(this).val();
        $.ajax({
            type: "POST", url: "aj.php",
            data: {search: searchData, action:'selectSearch'},
            success: function(data)
            {
                console.log(data);
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
     if ($(thisMember).prev().val() == "") {
          //code
          $(thisMember).parent().remove();
     }
     else
     {
        $(thisMember).prev().attr("value", $(thisMember).prev().val() + "X");
        $(thisMember).parent().hide();
     }
}

function addMember(thisMember) {
     var memberString = $(thisMember).html() + '<span onclick="removeMember(this)" class="glyphicon glyphicon-remove"></span>';
     memberString= "<li>" + memberString + "</li>";
     $('#members ul').append(memberString);
}