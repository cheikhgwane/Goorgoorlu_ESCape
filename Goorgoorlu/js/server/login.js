////////////////////////:////////////////////////

 /// Here we set users connection ///////////////


////Getting values

var submiter = idGet('submit');
var signer = idGet('signer');

var username = idGet('username');
var pword = idGet('pword');
var checkoption = idGet('remember');



// if (typeof submiter !== 'undefined' || typeof submiter !== null) 
//  {
   
//    submiter.addEventListener('click' , function()
// 	{

//        username = username.value;
//        pword = pword.value;
//        checkoption = checkoption.value;
	    
// 	    if(username.trim()!="" && pword.trim()!="")
// 		 {


// 		   var dataString="username="+username+"&pword="+pword+"&action=signin";
 
//            // Gajax("http://localhost/goorgoorlu/server/login.php" , dataString);
//              Xhr("http://localhost/goorgoorlu/server/login.php" , dataString);




//         }       

// 	});

//  }


if (typeof signer != 'undefined' || typeof signer != null) 
 {

  signer.addEventListener('click' , function()
	{

       username = username.value;
       pword = pword.value;
       typeOpt = idGet('type').value;
       addrOpt = idGet('addr').value;

     
       sname = idGet('sname').value;
       name = idGet('name').value;
       num= idGet('num').value;


	    
	    if(username.trim()!="" && pword.trim()!="")
		 {


		   var dataString="username="+username+"&pword="+pword+"&num="+num+
		   "&sname="+sname+"&name="+name+"&type="+typeOpt+"&addr="+addrOpt+"&action=signup";
 
           // Gajax("http://localhost/goorgoorlu/server/login.php" , dataString);
            var res = Xhr("http://localhost/goorgoorlu/server/login.php" , dataString);
            
             // if (res==true)
             //  {
             //    window.location.href = "http://stackoverflow.com"; 
             //  }
             


        }       

	});

}

