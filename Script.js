function LoginSuccess() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var loading = document.getElementById("loading");
  $.ajax({
    url: "http://140.121.196.20:7779/CPS/php/login.php",
    type: "POST",
    data: {
      STUID: username,
      PASSWORD: password
    },
    dataType: "json",
    beforeSend: function() {
      loading.style.display = "block";
      var loadingGif = document.createElement("img");
      loadingGif.setAttribute("id", "loadingGif");
      loadingGif.setAttribute("src", "./hourglass.gif");
      //<img id="loadingGif" src="./hourglass.gif">
      loading.appendChild(loadingGif);
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