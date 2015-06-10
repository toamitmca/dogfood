

function base_url(){
  var pathArray = window.location.href.split( '/' );
  return pathArray[0]+"//"+pathArray[2]+"/"+pathArray[3]+"/";
}
