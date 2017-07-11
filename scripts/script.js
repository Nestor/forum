$(document).ready(function(){
    
});

var $etat_loginPanel = false;
$('#login_panel .btn_panel').click(function(){
    if($etat_loginPanel == false){
        $etat_loginPanel = true;
        $('#login_panel').css('top', '0px');
        $('#login_panel .btn_panel p').text('Fermer');
    } else {
        $etat_loginPanel = false;
        $('#login_panel').css('top', '-200px');
        $('#login_panel .btn_panel p').text('Ouvrir');
    }
});