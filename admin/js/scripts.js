$(document).ready(function(){
$('#selectAllBoxes').click(function(event){
if(this.checked){
$('.checkBoxes').each(function(){
this.checked = true;

});

}else{

    $('.checkBoxes').each(function(){
        this.checked = false;
        
        });
 
}

});
// loader didn't work #sad
// var div_box = "<div id='load-screen'><div id='loading'></div></div>";    
// $("body").prepend(div_box);
// $('#load-screen').delay(7000).fadeOut(600, function(){
//     $(this).remove();

// });

});

function loadUsersOnline() {
    $.get("admin_functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data);

    });
}

setInterval(function(){

    loadUsersOnline();

}, 500);




//this time is in milliseconds, 500 then means half of a second

