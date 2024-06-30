function myFunction() {
    var x = document.getElementById("topnav");
    if (x.className === "navigations") {
      x.className += " responsive";
    } else {
      x.className = "navigations";
    }
  }