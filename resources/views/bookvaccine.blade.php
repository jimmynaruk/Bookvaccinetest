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
    height: 50vh block;
}

.card {
    width: 400px;
    border: none;
}

.content 
{
    padding:20px;
    
}
</style>
<body>
<div class="header">
  <h1>จองวัคซีน Covid-19</h1>
  <p>ลงทะเบียนเพื่อรับสิทธิในการฉีดวัคซีน Covid-19</p>
  <img src="img/moph-logo-new.png"width = "150" height = "120">
  <div >
 <a class="btn btn-primary" href="{{URL::TO('register')}}"> &nbsp;{{Session()->flash('log Out')}}Logout</a>
</div>
</div>

<div class="content">
<div class="container d-flex justify-content-center align-items-center">
    <div class="card">
        <div class="p-3 border-bottom d-flex align-items-center justify-content-center">
            <h5>ลงทะเบียนฉีดวัคซีน Covid-19</h5>
        </div>
        <div class="p-3 px-4 py-4 border-bottom"> 
        @if (Session::get('haslogin') == 1)
        <label for="cars">เบอร์โทรศัพท์:
        <input type="text" id="teltxt" class="form-control" onkeypress="return chkNumber(this)" value="{{Session::get('getuser')}}" maxlength="10" hidden/>{{Session::get('getuser')}}</label>
        @endif
        <div >
 <a class="btn btn-primary" href="{{URL::TO('bookdetail')}}"> &nbsp;ดูข้อมูลการจองของคุณ</a>
</div>
        <br>
        <label for="cars">กรอกชื่อนามสกุล:</label>
        <input type="text" id="nametxt"class="form-control mb-2" placeholder="กรอกชื่อ - นามสกุล" />
        
           
        <div class="form"> 
            <label for="cars">กรอกวันนัดหมาย:</label>
                <input type="date" class="form-control"  id="datetxt"/>  
            </div> 
            <div class="form"> 
            <label for="cars">กรอกเวลานัดหมาย:</label>
                <input type="time" class="form-control" id="timetxt"/>
           </div> 
           <br>
           <div class="form"> 
            <label for="cars">เลือกสถานที่รับบริการ:</label>
            <select  id="placetxt">
                <option value="สถาณีกลางบางซื่อ">สถาณีกลางบางซื่อ</option>
                <option value="โรงพยาบาลกรุงธนบุรี">โรงพยาบาลกรุงธนบุรี</option>
                <option value="โรงเรียนราชประชาสมาสัย">โรงเรียนราชประชาสมาสัย</option>
            </select>
           </div> 
           <br>
            <button class="btn btn-danger btn-block continue" onclick="Checkbook()">ลงทะเบียน</button>
           
        </div>
   
    <div class="p-2 d-flex flex-row justify-content-center align-items-center member">
        <span style="color:red">**1 หมายเลขโทรศัพท์จองวัคซีนได้ครั้งเดียว</span>
    </div>
    <div class="p-1 d-flex flex-row justify-content-center align-items-center member">
       <span style="color:blue">**กรุณามาก่อนเวลานัด 30 นาทีและนำบัตรประชาชนมาด้วย</span> 
   </div>
</div>
<div class="footer">
  <p>จองวัคซีน Covid-19</p>
</div>
</body>
</html>

<script>

function Checkbook(){
    nametxt = $("#nametxt").val();
    teltxt = $("#teltxt").val();
    datetxt =$("#datetxt").val();
    timetxt = $("#timetxt").val();
    placetxt = $("#placetxt").val();
		if(nametxt==''){
        alert('กรุณากรอกชื่อนามสกุล');
        return false;
        }else if(teltxt ==''){
		    alert('กรุณากรอกเบอร์โทรศัพท์');
		    return false;
		}else if(datetxt ==''){
            alert('กรุณาเลือกวันนัดหมาย');
            return false;
        }else if(timetxt==''){
            aleart('กรุณาเลือกเวลานัดหมาย');
            return false;
        }
		$.ajax({
        type:"POST",
        url:'{{URL::to("bookvaccine/saveBookVac")}}', 
        data:{
            nametxt: nametxt,
            teltxt: teltxt,
            datetxt: datetxt,
            timetxt: timetxt,
            placetxt: placetxt,
          _token:"{{ csrf_token() }}"
          },success:function(result){
		   alert(result.message);
           window.location="http://localhost/Bookvaccinetest/public/bookdetail";
        },fail:function(result,status,error){
           alert('failFunction');
         },error:function(result,status,error){
             let msg = result.responseJSON.message
           
               alert(msg);
         }
        
      })
	}	

    function checkText(ele)
	{
		var elem = String.fromCharCode(event.keyCode);
		if(!elem.match(/^([a-z0-9\_])+$/i)) return false;
		ele.onKeyPress=vchar;
		
	}
	function chkNumber(ele) //พิมพ์ได้เฉพาะตัวเลข
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
  }

  
</script>
