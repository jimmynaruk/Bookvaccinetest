<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
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
    width: 700px;
    border: none;
}

.content 
{
    padding:20px;
    
}

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
<div class="container d-flex justify-content-center align-items-center ">
    <div class="card" >
        <div class="p-3 border-bottom d-flex align-items-center justify-content-center ">
            <h5>ข้อมูลลงทะเบียนฉีดวัคซีน Covid-19 </h5>
        </div>
       
        <form>
        
      
        <div class="form-group">
        @if (Session::get('haslogin') == 1)
        <label for="recipient-name" class="col-form-label">&nbsp;&nbsp;&nbsp;หมายเลขโทรศัพท์: 
          <input id="teldetail"   value="{{Session::get('getuser')}}" hidden>{{Session::get('getuser')}}</label>
         
        @endif
        @foreach($dataname['dataName'] as $var)
        </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">&nbsp;&nbsp;&nbsp;ชื่อ - นามสกุล: {{$var->fnamelname}}</label>
            </div>
           
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">&nbsp;&nbsp;&nbsp;วันนัดหมาย: {{\Carbon\Carbon::parse($var->datebook)->format('d/m/Y')}}</label>
               
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">&nbsp;&nbsp;&nbsp;เวลานัดหมาย: {{$var->timebook}} น.</label>
               
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">&nbsp;&nbsp;&nbsp;สถานที่รับบริการ: {{$var->place}} </label>
               
              </div>
        @endforeach
        <a class="btn btn-primary btn-block" href="{{URL::TO('bookvaccine')}}"> &nbsp;ลงทะเบียนจองวัคซีน</a>
        <img src="img/Poster-5.jpg"width = "700" height = "750">
        </div>
        
            
              </form>
              </div>  
              </div>  
</div>
<div class="footer">
  <p>จองวัคซีน Covid-19</p>
</div>
</body>
</html>

<script>
function putdata(){
  teldetail = $("#teldetail").val();
 
		$.ajax({
        type:"POST",
        url:'{{URL::to("bookdetail/index")}}', 
        data:{
          teldetail: teldetail,
          _token:"{{ csrf_token() }}"
          },success:function(result){
		   alert(result.message);
           window.location.reload();
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

  function detail_tel(tel){
        $('#teltxt').val(tel);

      }

function detail(tel){

tel = $("#teldetail").val(tel);
  
      $.ajax({
      type:"POST",
      url:'{{URL::to("bookdetail/getDetailtel")}}',
      data:{
        tel: tel,
        _token:"{{ csrf_token() }}"
            },success:function(result){
              alert(result.message);
              window.location.reload();

            },fail:function(result,status,error){
              alert(result.message)
            },error:function(result,status,error){
              console.log(result);
              console.log(status);
              console.log(error);
              alert(result.responseJSON.message)
            }
      });
      
}    
</script>
