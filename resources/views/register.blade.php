<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");
.header {
  padding: 20px;
  text-align: center;
  background: #1abc9c;
  color: white;
  font-size: 30px;
}

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: red;
   color: white;
   text-align: center;
   
}
body {
    background-color: #eee;
    font-family: "Poppins", sans-serif;
    font-weight: 300
}

.container {
    height: 50vh
}

.card {
    width: 400px;
    border: none
}

.form-control {
    border: 2px solid #bdc1d2;
    font-size: 13px;
    height: 48px
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #f7bfd9;
    outline: 0;
    box-shadow: none
}

.form {
    position: relative;
    margin-bottom: 25px
}

.form a {
    position: absolute;
    right: 8px;
    bottom: 10px;
    color: #6ca0d6;
    font-size: 13px;
    text-decoration: none;
    z-index: 10;
    background-color: #fff;
    padding: 5px
}

.continue {
    height: 48px;
    font-size: 13px;
    background-color: #e91e63;
    border: none
}

.line-text {
    color: #cecece
}

.line {
    background-color: #eeeff6;
    width: 166px;
    height: 2px
}

.member a {
    color: #e91e63;
    font-size: 14px
}

.member span {
    font-size: 13px;
    font-weight: 400;
    color: #6ca0d6
}

</style>
<div class="header">
  <h1>จองวัคซีน Covid-19</h1>
  <p>ลงทะเบียนเพื่อรับสิทธิในการฉีดวัคซีน Covid-19</p>
  <img src="img/moph-logo-new.png"width = "150" height = "120">
  
</div>

<div class="container d-flex justify-content-center align-items-center">
    <div class="card">
        <div class="p-3 border-bottom d-flex align-items-center justify-content-center">
            <h5>เบอร์โทรศัพท์มือถือ / Mobile Number</h5>
        </div>
            <div class="p-3 px-4 py-4 border-bottom"> <input type="text" id="idteltxt"class="form-control mb-2" placeholder="กรอกเบอร์โทรศัพท์" />

            <button class="btn btn-success btn-block " onclick="createUser();">ลงทะเบียน</button>
            <button class="btn btn-primary btn-block " onclick="Checklogin();">เข้าสู่ระบบ</button>
            </div>
            </div>          
    </div>
    <div class="footer">
  <p>จองวัคซีน Covid-19</p>
</div>
</html>
<script>
    function Checklogin(){
        idteltxt = $("#idteltxt").val();
		
		$.ajax({
        type:"POST",
        url:'{{URL::to("register/login")}}', 
        data:{
            idteltxt: idteltxt,
          _token:"{{ csrf_token() }}"
          },success:function(result){
		   alert(result.message);
           window.location="http://localhost/Bookvaccinetest/public/bookvaccine";
          },fail:function(result,status,error){
            alert('failFunction');
          },error:function(result,status,error){
            console.log(result);
            console.log(status);
            console.log(error);
            alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
          }
        
      })
	}	
function createUser(){
           
            idteltxt = $("#idteltxt").val();
          
           if(idteltxt==''){
           alert('กรุณากรอกเบอร์โทรศัพท์');
           return false;
           }
           $.ajax({
           type:"POST",
           url:'{{URL::to("register/createUser")}}', 
           data:{
            idteltxt: idteltxt,
         _token:"{{ csrf_token() }}"
         },success:function(result){
           alert(result.message);00
         },fail:function(result,status,error){
           alert('failFunction');
         },error:function(result,status,error){
             let msg = result.responseJSON.message
           
               alert(msg);
         }
       
     })
   }
   function chkNumber(ele) //พิมพ์ได้เฉพาะตัวเลข
	{
  //var phoneno = /^(?([0-9]{3}))*-([0-9]{3})*-([0-9]{4})$/;
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
  }

  function checkText(ele)
	{
		var elem = String.fromCharCode(event.keyCode);
		if(!elem.match(/^([a-z0-9\_])+$/i)) return false;
		ele.onKeyPress=vchar;
		
	}

    function Checklogin(){
        idteltxt = $("#idteltxt").val();
		if(idteltxt==''){
           alert('กรุณากรอกเบอร์โทรศัพท์');
           return false;
           }
		$.ajax({
        type:"POST",
        url:'{{URL::to("register/login")}}', 
        data:{
            idteltxt: idteltxt,
          _token:"{{ csrf_token() }}"
          },success:function(result){
		   alert(result.message);
           window.location="http://localhost/Bookvaccinetest/public/bookvaccine";
          },fail:function(result,status,error){
            alert('failFunction');
          },error:function(result,status,error){
            console.log(result);
            console.log(status);
            console.log(error);
            alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
          }
        
      })
	}	
   </script>