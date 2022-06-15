<?php 
session_start();

function notif($type,$message){
    $_SESSION['notif']['type']=$type;
    $_SESSION['notif']['message']=$message;
    if($type=='error'){
        $_SESSION['notif']['title']="Oops...";
    }else{
         $_SESSION['notif']['title']="Good job";
    }

}

function shownotif(){
   
    if(isset($_SESSION['notif'])){
        $type=$_SESSION['notif']['type'];
        $message=$_SESSION['notif']['message'];
        $title=$_SESSION['notif']['title'];
        
        $html=" 
       <script>
        $(window).on('load',function(){
                swal({
                    title: '".$title."',
                    text: '".$message."',
                    confirmButtonColor: '#66BB6A',
                    type: '".$type."'
                });
            });
        </script>
        ";
        echo $html;
        unset($_SESSION['notif']);
    }
}
?>