function LoginCheck()
{
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	$.ajax({
    url: "connect.php",
    type: "POST",
    data: {
      id: username,
      pw: password
    },
    dataType: "json",
    beforeSend: 
	function() {
      
    },
    complete: function() {
      loading.style.display = "none";
      document.getElementById("loadingGif").remove();
    },
    success: function(response) {
      console.log(response);

      if (response["isLogin"] == true) {
        changeUserName(username);
        document.getElementById("warning").style.display = "none";
        isLogin();
      } else {
        document.getElementById("warning").style.display = "block";
        showToast("±b¸¹©Î±K½X¿ù»~");
      }
    },
    error: function() {
      showToast("login error");
      console.log("login error");
    }
  });
}