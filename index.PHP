<!DOCTYPE html>
<html>
<head>
    <title>Reproductor IPTV</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="expires" content="-1" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <style>

body {
      margin: 0;
       background: #000000;
      font-family: 'arial', sans serif;
    }
    .contenedor {
      background: #000000;
      width: 50%;
      margin: 0 auto;
      padding: 10px 10px;
      text-align: justify;
    }
        #canal-list {
            float: left;
            width: 25%;
            padding: 20px;
        }
        #reproductor {
            float: right;
            width: 75%;
            padding: 20px;
        }
        .canal {
            margin-bottom: 10px;
            cursor: pointer;
        }



    
    .contenedor img {
      width: 100%;
    }
    
    @media (max-width:600px)  { 
      .contenedor {
        width: 90%;
      }
    }
    
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        padding-top: 15px;
        height: 0;
         overflow: hidden;
    }
    
    .video-container iframe {
        position: absolute;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    
    .topnav {
      overflow: hidden;
      background-color: #000000;
    }
    
    .topnav a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 12px;
    }
    
    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }
    
    .topnav a.active {
      background-color: #68C420;
      color: white;
    }
    
    .topnav .icon {
      display: none;
    }
    


.changeVideo {
  position: absolute;
background-color: black;
  top: 0px;
  left: 0px;

  opacity: 0;
  transition: opacity .3s ease;
  cursor: pointer;

  height: 100%;
    width:280px;
    border: 1 px transparent;
    font-family: 'GestaRegular', Arial, Helvetica, sans-serif;
    overflow: auto;

  /* Additional styles just to increase visual appeal */
  color: red;
  font-weight: bold;
  line-height: 25px;
  text-align: LEFT;
  /* End */
}

/* On hovering the video, show the button */
video:hover~.changeVideo {
  opacity: 1.5;

}

.changeVideo:hover {
  opacity: 1;
  color:#f5e9e9;
}






::-webkit-scrollbar{
  width: 10px;
}
::-webkit-scrollbar-track{

  border: 0ch transparent;

}


button {
margin: 0ch;
text-align: left;
text-decoration: none;
font-size: 12px;
cursor: pointer;
  font-weight: bold;
  width:120px;
 position: absolute;
  background-color: transparent;
  outline: none;
text-decoration: aliceblue;
   border: solid gray;
    padding: 5px; color: rgb(238, 231, 231);
      border-radius: 2px;

}
button:focus {
  border: none;
  background-color: rgb(255, 9, 9);
}

button:hover {
background-color: rgb(243, 7, 7);

}

            .button {
 background-color: transparent;
  border: 3px solid Black;
  align:right;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  cursor: pointer;
    font-weight: bold;
    width: 115px;
 border: none;
  background-color: transparent;
  outline: none;
text-decoration: aliceblue;
   border: solid gray;
  padding: 5px; color: rgb(238, 231, 231);
      border-radius: 2px;
  }

  .alert {
      padding: 20px;
      background-color: #008345;
      color: #ffffff;
      opacity: 1;
      transition: opacity 0.6s;
      margin-bottom: 15px;
    }

    .alert.success {
      background-color: #04AA6D;
    }

    .alert.info {
      background-color: #2196F3;
    }

    .alert.warning {
      background-color: #948b8b;
    }

    .closebtn {
      margin-left: 15px;
      color: white;
      color: #c50e0e;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: red;
    }
        
    </style>
</head>
<body>


<div id="reproductor">

<div class="alert">
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
<strong>Atención !</strong> pega tu URL y puede ver tus canales la izquierda
<form method="post">
    <input type="text" value="http://www.m3u.cl/lista/AR.m3u" name="m3u_url"> : 
    <button type="submit"  name="load_m3u">Cargar lista </button>
</form>
   
      <script>
        function myFunction() {
          // Get the text field
          var copyText = document.getElementById("myInput");
        
          // Select the text field
          copyText.select();
          copyText.setSelectionRange(0, 99999); // For mobile devices
        
          // Copy the text inside the text field
          navigator.clipboard.writeText(copyText.value);
          
          // Alert the copied text
          alert("Copied the text: " + copyText.value);
        }
        </script>
    </div>

<p align="right">
        <input class="button" onclick="toggleFullscreen()" type="button" value="Fullscreen TV" /> </p>
     
        <div class="video-container">
     
     
     <iframe id="iframe" width="100%" height="100%" frameborder="0" scrolling="no" allowfullscreen="true" allow="autoplay; encrypted-media;" name="iframe" src=""></iframe>
      
</div>
    </div>

    <div class="changeVideo">
        <h2>Lista de canales</h2>
        
        <?php
        if(isset($_POST['m3u_url'])) {
            $m3u_url = $_POST['m3u_url'];
            $m3u = file_get_contents($m3u_url);
    
        $lineas = explode("\n", $m3u);
        foreach ($lineas as $linea) {
            if (strpos($linea, "#EXTINF") !== false) {
                $datos_canal = explode(",", $linea);
                $nombre_canal = $datos_canal[1];
                $url_canal = trim($lineas[array_search($linea, $lineas) + 1]);
                echo '<div class="canal" data-url="' . $url_canal . '">' . $nombre_canal . '</div>';
            }
        }    }
      

if(isset($_POST['filename'])) {
    $archivo = fopen('filename', 'r');
    $contenido = fread($archivo, filesize('filename'));

 
    
      
    
        $lineas = explode("\n", $contenido_m3u);
        foreach ($lineas as $linea) {
            if (strpos($linea, "#EXTINF") !== false) {
                $datos_canal = explode(",", $linea);
                $nombre_canal = $datos_canal[1];
                $url_canal = trim($lineas[array_search($linea, $lineas) + 1]);
                echo '<div class="canal" data-url="' . $url_canal . '">' . $nombre_canal . '</div>';
                fclose($archivo);   }
        }    }
        ?>

    </div>
 
    <script>
        var canales = document.getElementsByClassName("canal");
        for (var i = 0; i < canales.length; i++) {
            canales[i].addEventListener("click", function() {
                var url = this.getAttribute("data-url");

                document.getElementById("iframe").src = "m3u8player.html?url="+url;
            });
        }
    </script>

<script>function toggleFullscreen() {
  let elem = document.querySelector("iframe");

  if (!document.fullscreenElement) {
    elem.requestFullscreen().catch((err) => {
      alert(`Error attempting to enable fullscreen mode: ${err.message} (${err.name})`);
    });
  } else {
    document.exitFullscreen();
  }
}</script>
</body>
</html>




