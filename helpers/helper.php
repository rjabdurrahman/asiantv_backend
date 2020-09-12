<?php 
// Convert youtube url to id
function youtubeVideoLinkToThumbnail($link){
  $parse1 =explode("v=",  $link)[1];
  $actural = explode("&", $parse1)[0];

  return "https://i3.ytimg.com/vi/".$actural."/mqdefault.jpg";
}
  
?>