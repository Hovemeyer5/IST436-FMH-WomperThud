//array to hold added html
var detailBoxes = [];
 
detailBoxes['phone'] = "<div class='detailBox'><select name='phoneTypeREPLACETHISNUM'><option value='1'>Home</option><option value='2'>Work</option><option value='3'>Other</option></select><input name='phoneREPLACETHISNUM' type='text' class='form-control' placeholder='Phone'><input class='hide' name='phoneIDREPLACETHISNUM' value=''><button data-count='REPLACETHISNUM' data-type='phone' class='remove'>Remove</button></div>";
detailBoxes['address'] = "<div class='detailBox'><select name='addTypeREPLACETHISNUM'><option value='1'>Home</option><option value='2'>Work</option><option value='3'>Other</option></select><input name='streetREPLACETHISNUM' type='text' class='form-control' placeholder='Street'><input name='cityREPLACETHISNUM' type='text' class='form-control' placeholder='City'><input name='stateREPLACETHISNUM' type='text' class='form-control' placeholder='State'><input name='zipcodeREPLACETHISNUM' type='text' class='form-control' placeholder='Zipcode'><button data-type='address' data-count='REPLACETHISNUM' class='remove'>Remove</button><input class='hide' name='addIDREPLACETHISNUM' value=''></div>";
detailBoxes['email'] = "<div class='detailBox'><select name='emailTypeREPLACETHISNUM'><option value='1'>Home</option><option value='2'>Work</option><option value='3'>Other</option></select><input name='emailREPLACETHISNUM' type='text' class='form-control' placeholder='Email'><input class='hide' name='emailIDREPLACETHISNUM' value=''><button data-count='REPLACETHISNUM' data-type='email' class='remove'>Remove</button></div>";
detailBoxes['url'] = "<div class='detailBox'><select name='urlTypeREPLACETHISNUM'><option value='1'>Home</option><option value='2'>Work</option><option value='3'>Other</option></select><input name='urlREPLACETHISNUM' type='text' class='form-control' placeholder='URL'><input class='hide' name='urlIDREPLACETHISNUM' value=''><button data-count='REPLACETHISNUM' data-type='url' class='remove'>Remove</button></div>";

$(document).ready(function(){
					$('.add').click(function(e){
								e.preventDefault();
								var typeToAdd = $(this).data('type');
								var countAlreadyThere = $("#" + typeToAdd + "s").data('count');
								var newCount = countAlreadyThere+1;
								var detailBox = detailBoxes[typeToAdd].replace(/REPLACETHISNUM/g, newCount);
								$("#" + typeToAdd + "s").append(detailBox);
								$("#" + typeToAdd + "s").attr("data-count", newCount);
                        });
                        $('#save').click(function(){
								$("#editContact").submit();
                        });
                        $('.remove').click(function(e){
								e.preventDefault();
								var typeToAdd = $(this).data('type');
								var detailBoxCount = $(this).data('count');
								alert("input[name='"+typeToAdd+"ID"+detailBoxCount+"']");
								var countAlreadyThere = $("#" + typeToAdd + "s").data('count');
								var newCount = countAlreadyThere-1;
								$("input[name='"+typeToAdd+"ID"+detailBoxCount+"']").attr("value", $("input[name='"+typeToAdd+"ID"+detailBoxCount+"']").val() + "X");
								$(this).parent().hide();
								$("#" + typeToAdd + "s").attr("data-count", newCount);
                        });
});
