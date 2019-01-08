function showDiv(elem){
  var elements = document.getElementsByClassName("test");
  for(var i=0; i<elements.length; i++) {
    if(elem.value == elements[i].id){
      for (var j = 0; j < elements.length; j++) {
        if(elements[j].id != elem.value){
            document.getElementById(elements[j].id).style.display = "none";
        }
      }
      document.getElementById(elem.value).style.display = "block";
    }
  }
}
